<?php

namespace common\queries;

/**
 * This is the ActiveQuery class for [[\common\models\Publication]].
 *
 * @see \common\models\Publication
 */
class PublicationQuery extends \yii\db\ActiveQuery
{

    /**
     * Поиск по Id
     * @param $id
     * @return $this
     */
    public function byId($id)
    {
        return $this->andWhere(['id' => $id]);
    }

    /**
     * Только если ты владелец публикации
     * @return $this
     */
    public function onlyOwner()
    {
        if(\Yii::$app->user->identity->username == 'Admin') {
            return $this;
        }
        return $this->andWhere(['user_id' => \Yii::$app->user->id]);
    }

    /**
     * @inheritdoc
     * @return \common\models\Publication[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Publication|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
