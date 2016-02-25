<?php

namespace modules\block\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\BlockCategory]].
 *
 * @see \common\models\BlockCategory
 */
class BlockCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\BlockCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\BlockCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}