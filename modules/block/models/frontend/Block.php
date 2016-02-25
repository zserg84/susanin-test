<?php
/**
 * Created by PhpStorm.
 * User: sz
 * Date: 25.02.16
 * Time: 15:15
 */

namespace modules\block\models\frontend;

class Block extends \modules\block\models\Block
{

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirectory()
    {
        if($this->directory_active)
            return parent::getDirectory();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        if($this->image_active)
            return parent::getImage();
    }

    public function getText(){
        if($this->text_active)
            return $this->text;
    }

    public function attributeLabels(){
        return array_merge(parent::attributeLabels(), [
            'directory.name' => 'Наименование директории'
        ]);
    }
} 