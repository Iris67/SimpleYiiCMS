<?php
Yii::import('zii.widgets.CPortlet');

class Categories extends CPortlet
{
    public function init()
    {
        $this->title='Категории';
        parent::init();
    }
 
    public function getCategories()
    {
        return Category::model()->findCategories();
    }
 
    protected function renderContent()
    {
        $this->render('categories');
    }
}


