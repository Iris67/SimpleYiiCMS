<?php

Yii::import('zii.widgets.CPortlet');
 
class BackendMenu extends CPortlet
{
    public function init()
    {
        $this->title=CHtml::link(Yii::app()->user->name,array('default/index'));
        parent::init();
    }
 
    protected function renderContent()
    {
        $this->render('backendMenu');
    }
}

