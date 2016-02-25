<?php
/**
 * Created by PhpStorm.
 * User: sz
 * Date: 24.02.16
 * Time: 14:18
 */

namespace modules\block\models\search;

use modules\block\models\Category;
use yii\data\ActiveDataProvider;

class CategorySearch extends Category
{
    private $_parentCategory;

    public function rules(){
        return [
            [['name', 'parentCategory', 'active'], 'safe'],
        ];
    }

    public function attributeLabels(){
        return array_merge(parent::attributeLabels(), [
            'parentCategory' => 'Родитель',
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
        $query->andFilterWhere(['=', 'category.id', $this->name]);
        $query->andFilterWhere(['=', 'category.active', $this->active]);
        if($this->_parentCategory){
            $query->andFilterWhere(['=', 'category.parent_id', $this->_parentCategory]);

        }

        return $dataProvider;
    }

    public function getParentCategory(){
        if($this->_parentCategory)
            return $this->_parentCategory;
        $parent = $this->parent;
        if(!$parent)
            return null;
        return $parent->name;
    }

    public function setParentCategory($value){
        $this->_parentCategory = $value;
    }
}