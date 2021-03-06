<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $firstName
 * @property string $lastName
 * @property string $middleName
 * @property int $user_id
 * @property int $status_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class Author extends \yii\db\ActiveRecord
{
    const STATUS_NO_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'user_id'], 'required'],
            [['user_id', 'status_id', 'created_at', 'updated_at'], 'integer'],
            [['firstName', 'lastName', 'middleName'], 'string', 'max' => 191],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'Имя',
            'lastName' => 'Фамилия',
            'middleName' => 'Отчество',
            'user_id' => 'Добавил',
            'status_id' => 'Статус',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorAliases()
    {
        return $this->hasMany(AuthorAlias::class, ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationAuthors()
    {
        return $this->hasMany(PublicationAuthor::class, ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publication::className(), ['id' => 'publication_id'])->viaTable('publication_author', ['author_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\queries\AuthorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\queries\AuthorQuery(get_called_class());
    }

    public function beforeValidate()
    {
        if ($this->user_id == null) {
            $this->user_id = Yii::$app->user->id;
        }
        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName . ' ' . $this->middleName;
    }

    public function getShortFullName()
    {
        return $this->lastName  . ' ' . mb_substr($this->firstName, 0, 1) . '. ' . mb_substr($this->middleName, 0, 1) . '.';
    }
}
