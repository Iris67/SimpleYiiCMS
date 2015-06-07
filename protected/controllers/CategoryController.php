<?php

class CategoryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionIndex($id)
	{
//		$this->render('view',array(
//			'model'=>$this->loadModel($id),
//		));
            
            $criteria = new CDbCriteria(array(
                'condition' => 'status=:postStatus AND category_id =:id',
                'order' => 'create_time DESC',
                'params' => array(':postStatus' => Post::STATUS_APPROVED, ':id'=>$id),
            ));
                       
            $dataProvider=new CActiveDataProvider('Post', array(
                'criteria'=>$criteria,
            ));
            $this->render('index',array(
                    'dataProvider'=>$dataProvider,'model'=>$this->loadModel($id),
            ));
	}
        
        public function actionView($id)
	{
            Yii::app()->runController('post/view',array('id'=>$id));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Category the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
