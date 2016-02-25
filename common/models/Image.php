<?php

namespace common\models;

use common\components\ImageAsset;
use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $ext
 * @property string $comment
 * @property integer $create_time
 * @property integer $sort
 *
 * @property Block[] $blocks
 */
class Image extends \yii\db\ActiveRecord
{

    private $_path;
    private $_url = '/web/img/';

    public function init() {
        $this->_path = Yii::getAlias('@statics').'/web/img/';
        return parent::init();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'sort'], 'integer'],
            [['ext'], 'string', 'max' => 4],
            [['comment'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ext' => 'Ext',
            'comment' => 'Comment',
            'create_time' => 'Create Time',
            'sort' => 'Sort',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlocks()
    {
        return $this->hasMany(Block::className(), ['image_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\ImageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ImageQuery(get_called_class());
    }

    public function beforeSave() {
        if (!$this->id) {
            $this->create_time = time();
        }
        return parent::beforeSave(true);
    }


    public function beforeDelete() {
        $file = $this->getPath();
        if (file_exists($file) and is_file($file)) {
            @unlink($file);
        }

        return parent::beforeDelete();
    }

    private function getGroupFolder() {
        if ($this->id) {
            $id = $this->id;
        } else {
            $maxId = Yii::$app->db->createCommand('SELECT MAX(id) FROM `image`')->queryScalar();
            $id = $maxId + 1;
        }
        return ceil($id / 1000);
    }

    private function getPathDir() {
        $path = $this->_path.$this->getGroupFolder().'/';
        if (!file_exists($path) or !is_dir($path)) {
            mkdir($path, 0777, true);
        }
        return $path;
    }

    public function getPath() {
        if (!$this->id) return false;
        return $this->getPathDir().$this->id.'.'.$this->ext;
    }

    /**
     * @var string $file
     * @var string $ext
     * @return Image|false
     */
    public static function GetByFile($file, $ext) {
        $image = new Image();

        $image->ext = $ext;
        $image->save();
        $path = $image->getPathDir();
        $destination = $path.$image->id.'.'.$image->ext;
        if (move_uploaded_file($file, $destination)) {
            $image->save();
            chmod($destination, 0755);
            return $image;
        }
        $image->delete();
        return false;
    }

    public function getSrc() {
        if (!$this->id or !$this->ext)
            return false;

        $groupFolder = $this->getGroupFolder();

        $view = Yii::$app->getView();
        $path = ImageAsset::register($view);
        $path = $path->imgSrc($this->id.'.'.$this->ext, $this->_url.$groupFolder);

        return $path;
    }
}
