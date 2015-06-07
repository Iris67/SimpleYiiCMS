<?php

class DefaultController extends Controller
{
    public function actionIndex()
    {
            $this->render('index');
    }
    
    public function filters()
    {
        return array(
                'accessControl',
        );
    }
    
    public function accessRules()
    {
        return array(
            array('allow',
                'roles'=>array('admin','subscriber'),
            ), 
            array('deny',  // deny all users
                'users'=>array('*'),
            ),       
        );
    }
    
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
}