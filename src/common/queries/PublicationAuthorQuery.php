<?php

namespace common\queries;

use common\models\PublicationAuthor;


/**
 * This is the ActiveQuery class for [[PublicationAuthor]].
 *
 * @see PublicationAuthor
 */
class PublicationAuthorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PublicationAuthor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PublicationAuthor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
