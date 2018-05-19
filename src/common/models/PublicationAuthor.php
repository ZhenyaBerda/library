<?php

namespace common\models;

use common\queries\PublicationAuthorQuery;
use Yii;

/**
 * This is the model class for table "publication_author".
 *
 * @property int $id
 * @property int $author_id
 * @property int $publication_id
 *
 * @property Author $author
 * @property Publication $publication
 */
class PublicationAuthor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publication_author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'publication_id'], 'required'],
            [['author_id', 'publication_id'], 'integer'],
            [['author_id', 'publication_id'], 'unique', 'targetAttribute' => ['author_id', 'publication_id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
            [['publication_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publication::class, 'targetAttribute' => ['publication_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'publication_id' => 'Publication ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublication()
    {
        return $this->hasOne(Publication::className(), ['id' => 'publication_id']);
    }

    /**
     * @inheritdoc
     * @return PublicationAuthorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PublicationAuthorQuery(get_called_class());
    }

}
