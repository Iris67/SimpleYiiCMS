<?php

class PostController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
            $model=$this->loadModel($id);
            $params=array('post'=>$model);
            if(Yii::app()->user->checkAccess('viewPost',$params)){
                $this->render('view',array(
                        'data'=>$model,
                ));
            } else {
                throw new CHttpException(403,'У вас недостаточно прав для выполнения указанного действия');
            }
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            if(Yii::app()->user->checkAccess('createPost')){
		$model=new Post;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
            }
            else throw new CHttpException(403,'У вас недостаточно прав для выполнения указанного действия');
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            $model=$this->loadModel($id);
            $params=array('post'=>$model);
            if(Yii::app()->user->checkAccess('updatePost',$params)){
                
                //if(Yii::app()->user->checkAccess('admin') || $model->author_id==Yii::app()->user->id){
                if(isset($_POST['Post']))
                {
                    $model->attributes=$_POST['Post'];
                    if($model->save())
                            $this->redirect(array('view','id'=>$model->id));
                }
                $this->render('update',array(
                        'model'=>$model,
                ));
            } else {
                throw new CHttpException(403,'У вас недостаточно прав для выполнения указанного действия');
            }
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            $model=$this->loadModel($id);
            $params=array('post'=>$model);
            if(Yii::app()->user->checkAccess('deletePost',$params)){
                $model->delete();
                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
            else throw new CHttpException(403,'У вас недостаточно прав для выполнения указанного действия');
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
            if(Yii::app()->user->checkAccess('indexPost')){
                $_SESSION['KCFINDER']['disabled'] = false; // enables the file browser in the admin
		$_SESSION['KCFINDER']['uploadURL'] = Yii::app()->baseUrl."/uploads/"; // URL for the uploads folder
		$_SESSION['KCFINDER']['uploadDir'] = Yii::app()->basePath."/../uploads/"; // path to the uploads folder                
                
                $model=new Post('search');
                $model->unsetAttributes();  // clear any default values
                if(isset($_GET['Post']))
                    $model->attributes=$_GET['Post'];

                $this->render('index',array(
                    'model'=>$model,
                ));
            }
            else throw new CHttpException(403,'У вас недостаточно прав для выполнения указанного действия');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Article the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Post::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Article $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionSuggestTags()
	{
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
		{
			$tags=Tag::model()->suggestTags($keyword);
			if($tags!==array())
				echo implode("\n",$tags);
		}
	}
}