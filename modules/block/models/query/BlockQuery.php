<?php

namespace modules\block\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Block]].
 *
 * @see \common\models\Block
 */
class BlockQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Block[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Block|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active(){
        $this->andWhere([
            'block.active' => 1
        ]);
        return $this;
    }

    public function getByAlias($alias){
        $this->andWhere([
            'block.alias' => $alias
        ]);
        return $this;
    }
}