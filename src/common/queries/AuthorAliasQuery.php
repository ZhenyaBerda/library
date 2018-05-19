<?php

namespace common\queries;

/**
 * This is the ActiveQuery class for [[\common\models\AuthorAlias]].
 *
 * @see \common\models\AuthorAlias
 */
class AuthorAliasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * Поиск по всему имени
     * @param $firstName
     * @param $lastName
     * @param $middleName
     * @return $this
     */
    public function byFullName($firstName, $lastName, $middleName)
    {
        return $this->andWhere([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'middleName' => $middleName,
        ]);
    }

    /**
     * Поиск по фамилии
     * @param $lastName
     * @return $this
     */
    public function byLastName($lastName)
    {
        return $this->andWhere(['lastName' => $lastName]);
    }


    /**
     * @inheritdoc
     * @return \common\models\AuthorAlias[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\AuthorAlias|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
