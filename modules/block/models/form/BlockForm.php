<?php
/**
 * Created by PhpStorm.
 * User: sz
 * Date: 24.02.16
 * Time: 17:11
 */

namespace modules\block\models\form;


use common\components\ImageBehavior;
use modules\block\models\Block;

class BlockForm extends Block
{

    public $image = null;
    public $image_active = 1;
    public $text_active = 1;
    public $directory_active = 1;

    public function rules() {
        return array_merge(parent::rules(),[
                ['image', 'file', 'mimeTypes'=> ['image/png', 'image/jpeg', 'image/gif'], 'wrongMimeType'=>'Невернй формат изображения'],
            ]
        );
    }

    public function behaviors()
    {
        return [
            'imageBehavior' => [
                'class' => ImageBehavior::className(),
            ]
        ];
    }
} 