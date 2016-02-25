<?php
/**
 * Created by PhpStorm.
 * User: sz
 * Date: 24.02.16
 * Time: 17:01
 */

namespace modules\block\models\search;


use modules\block\models\Block;
use yii\data\ActiveDataProvider;

class BlockSearch extends Block
{
    private $_categoryName;

    public function rules(){
        return [
            [['name', 'alias', 'created_at', 'active', 'categoryName'], 'safe'],
        ];
    }

    public function attributeLabels(){
        return array_merge(parent::attributeLabels(), [
            'categoryName' => 'Категория',
        ]);
    }

    public function search($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'block.name', $this->name]);
        $query->andFilterWhere(['like', 'block.alias', $this->alias]);
        $query->andFilterWhere(['like', 'block.active', $this->active]);
        if($this->_categoryName){
            $query->andFilterWhere(['=', 'block.category_id', $this->_categoryName]);
        }

        return $dataProvider;
    }

    public function getCategoryName(){
        if($this->_categoryName)
            return $this->_categoryName;
        $category = $this->category;
        if(!$category)
            return null;
        return $category->name;
    }

    public function setCategoryName($value){
        $this->_categoryName = $value;
    }
} 