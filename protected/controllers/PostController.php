<?php

class PostController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        const STATUS_DRAFT=1;
        const STATUS_PENDING_APPROVAL=2;
        const STATUS_APPROVED=3;
        
        public function actions(){
            return array(
                'captcha'=>array(
                        'class'=>'CaptchaExtendedAction',
                        // if needed, modify settings
                        'mode'=>CaptchaExtendedAction::MODE_DEFAULT,
                ),
            );
        }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
            $post=$this->loadModel($id);
            $comment=$this->newComment($post);
//            if(Yii::app()->user->isGuest) {
//                $comment->scenario = 'guest';
//            }
            $this->pageTitle = $post->title;
            $this->description = strip_tags($post->introcontent);
            $this->keywords = $post->tags;
            $this->render('view',array(
                'model'=>$post,
                'comment'=>$comment,
            ));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
                $criteria=new CDbCriteria();
                $criteria->order = 'create_time DESC';
                $criteria->condition='status='.self::STATUS_APPROVED;
                $criteria->with='commentCount';
                if(isset($_GET['tag']))
                    $criteria->addSearchCondition('tags',$_GET['tag']);
                $dataProvider=new CActiveDataProvider('Post', array(
                    'criteria'=>$criteria,
                ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
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
        
        protected function newComment($post)
        {
            $comment=new Comment;
            if(Yii::app()->user->isGuest) {
                $comment->scenario = 'guest';
            }
            
//            if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
//            {
//                echo CActiveForm::validate($comment);
//                Yii::app()->end();
//            }
            
            if(isset($_POST['Comment']))
            {
                $comment->attributes=$_POST['Comment'];
                if($post->addComment($comment))
                {
                    if($comment->status==Comment::STATUS_PENDING)
                        Yii::app()->user->setFlash('commentSubmitted','Спасибо за ваш комментарий.
                            Он появится после утверждения.');
                    $this->refresh();
                }
            }
            return $comment;
        }
}