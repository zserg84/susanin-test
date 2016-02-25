<?php

namespace modules\block\models;

use common\models\Directory;
use common\models\Image;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "block".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property integer $category_id
 * @property integer $created_at
 * @property integer $active
 * @property string $text
 * @property integer $image_id
 * @property integer $directory_id
 * @property integer $text_active
 * @property integer $image_active
 * @property integer $directory_active
 *
 * @property Directory $directory
 * @property Category $category
 * @property Image $image
 * @property BlockCategory[] $blockCategories
 * @property Category[] $categories
 */
class Block extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'category_id'], 'required'],
            [['category_id', 'created_at', 'image_id', 'directory_id', 'text_active', 'image_active', 'directory_active', 'active'], 'integer'],
            [['text'], 'string'],
            [['name', 'alias'], 'string', 'max' => 255],
            [['directory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Directory::className(), 'targetAttribute' => ['directory_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'alias' => 'Алиас',
            'category_id' => 'Категория',
            'created_at' => 'Время создания',
            'text' => 'Текст',
            'image_id' => 'Картинка',
            'directory_id' => 'Наименование директории',
            'text_active' => 'Активный текст',
            'image_active' => 'Активная картинка',
            'directory_active' => 'Активная директория',
            'image' => 'Картинка',
            'active' => 'Активность',
        ];
    }

    public function behaviors(){
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false,
            ]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirectory()
    {
        return $this->hasOne(Directory::className(), ['id' => 'directory_id']);
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
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockCategories()
    {
        return $this->hasMany(BlockCategory::className(), ['block_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('block_category', ['block_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \modules\block\models\query\CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \modules\block\models\query\BlockQuery(get_called_class());
    }
}
