<?php

namespace common\search;

use common\models\Author;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Publication;

/**
 * PublicationSearch represents the model behind the search form of `common\models\Publication`.
 */
class PublicationSearch extends Publication
{
    public $year_from;
    public $year_to;

    public $displayDoi = 0;
    public $displayScopus = 0;
    public $displayIsbn = 0;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'publisher_name'], 'string'],
            [['id', 'user_id', 'language_id', 'year', 'year_from', 'year_to', 'journal_id', 'scopus_id', 'wos_id', 'rinch_id', 'peer_reviewed_id', 'conference_id', 'created_at', 'updated_at'], 'integer'],
            [['scopus_number', 'doi_number', 'isbn'], 'safe'],
            ['authorListId', 'safe'],
            [['displayDoi', 'displayScopus', 'displayIsbn'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['year_from'] = 'Год от';
        $labels['year_to'] = 'Год до';
        $labels['displayDoi'] = 'Показать DOI';
        $labels['displayScopus'] = 'Показать Scopus ID';
        $labels['displayIsbn'] = 'Показать ISBN';
        return $labels;
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @return mixed
     */
    public function getAuthorListFullname()
    {
        $result = [];
        $authors = Author::findAll(['id' => $this->authorListId]);
        foreach ($authors as $author) {
            $result[$author->id] = $author->lastName . ' ' . $author->firstName . ' ' . $author->middleName;
        }
        return $result;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Publication::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->authorListId) {
            $query->leftJoin('publication_author pa', 'pa.publication_id = publication.id')
                ->where(['pa.author_id' => $this->authorListId])
                ->groupBy(['publication.id'])
                ->having('COUNT(pa.author_id) >=' . count($this->authorListId));
        }

        if ($this->year_from) {
            $query->andFilterWhere(['>=', 'year', $this->year_from]);
        }

        if ($this->year_to) {
            $query->andFilterWhere(['<=', 'year', $this->year_to]);
        }

        $columnsForFilter = ['language_id', 'journal_id', 'scopus_id', 'wos_id', 'rinch_id', 'peer_reviewed_id', 'conference_id'];

        foreach ($this->attributes as $attribute => $value) {
            if (in_array($attribute, $columnsForFilter) && $value) {
                $query->andFilterWhere([$attribute => $value]);
            }
        }

        if ($this->publisher_name) {
            $query->andFilterWhere(['like', 'publisher_name', $this->publisher_name]);
        }
        $query->andFilterWhere(['like', 'scopus_number', $this->scopus_number])
            ->andFilterWhere(['like', 'doi_number', $this->doi_number])
            ->andFilterWhere(['like', 'isbn', $this->isbn])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
