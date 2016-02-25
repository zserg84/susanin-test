<?php

namespace modules\block\models;

use Yii;

/**
 * This is the model class for table "block_category".
 *
 * @property integer $block_id
 * @property integer $category_id
 *
 * @property Category $category
 * @property Block $block
 */
class BlockCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'block_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['block_id', 'category_id'], 'required'],
            [['block_id', 'category_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'block_id' => 'Block ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlock()
    {
        return $this->hasOne(Block::className(), ['id' => 'block_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\BlockCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \modules\block\models\query\BlockCategoryQuery(get_called_class());
    }
}
