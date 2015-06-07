<?php

class ConfigController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column2';

	public function actionIndex()
	{
            if(Yii::app()->user->checkAccess('indexConfig')){
		$models=Config::model()->findAll();
		if(isset($_POST['Config']))
		{
			$valid=true;
			foreach($models as $i=>$model)
			{
				if(isset($_POST['Config'][$i]))
					$model->attributes=$_POST['Config'][$i];
				$valid=$model->validate() && $valid;
			}
			if($valid)
			{
				foreach($models as $model)
					$model->save();
				$this->refresh();
			}
		}
		$this->render('index',array('models'=>$models));
            }
            else throw new CHttpException(403,'У вас недостаточно прав для выполнения указанного действия');
	}
		
}
