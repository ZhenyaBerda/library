<?php

namespace common\queries;

/**
 * This is the ActiveQuery class for [[\common\models\Journal]].
 *
 * @see \common\models\Journal
 */
class JournalQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * Поиск по названию
     * @param $title
     * @return $this
     */
    public function byTitle($title)
    {
        return $this->andWhere(['title' => $title]);
    }

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
     * @return \common\models\Journal[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Journal|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
