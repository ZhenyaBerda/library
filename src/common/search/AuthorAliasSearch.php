<?php

namespace common\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AuthorAlias;

/**
 * AuthorAliasSearch represents the model behind the search form of `common\models\AuthorAlias`.
 */
class AuthorAliasSearch extends AuthorAlias
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'language_id', 'created_at', 'updated_at'], 'integer'],
            [['firstName', 'lastName', 'middleName'], 'safe'],
        ];
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($author_id, $params)
    {
        $query = AuthorAlias::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'author_id' => $author_id,
            'language_id' => $this->language_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'middleName', $this->middleName]);

        return $dataProvider;
    }
}
