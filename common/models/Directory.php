<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "directory".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Block[] $blocks
 */
class Directory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'directory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование директории',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlocks()
    {
        return $this->hasMany(Block::className(), ['directory_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\DirectoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\DirectoryQuery(get_called_class());
    }
}
