<?php

class SiteController extends Controller
{
        public $layout='//layouts/column2';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CaptchaExtendedAction',
                                // if needed, modify settings
                                'mode'=>CaptchaExtendedAction::MODE_DEFAULT,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			//'page'=>array(
				//'class'=>'CViewAction',
			//),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
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

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->config->get('ADMIN_EMAIL'),$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Спасибо, что связались с нами. Мы ответим так быстро, как только сможем.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        public function actionRegistration()
	{    
            if (Yii::app()->user->isGuest)
            {
                $model=new RegistrationForm;
                $newUser = new User;

                // if it is ajax validation request
                if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
                {
                        echo CActiveForm::validate($model);
                        Yii::app()->end();
                }

                // collect user input data
                if(isset($_POST['RegistrationForm']))
                {
                    $model->attributes=$_POST['RegistrationForm'];

                    if ($model->validate()) {
                            $newUser->username = $model->username;
                            $newUser->password = $model->password;
                            $newUser->email = $model->email;
                            $newUser->url = $model->url;
                            $newUser->role = 4;
                            $newUser->status = 0;
                            $newUser->activationKey = substr(md5(uniqid(rand(), true)), 0, rand(10, 15));

                            if($newUser->save()) {
                                $this->sendActivationKey($newUser);
                                Yii::app()->user->setFlash('registration','На Вашу почту отправлен ключ активациии.');
				$this->refresh();
                            }
                            else 
                                throw new CHttpException(403, 'Ошибка добавления в базу данных.');
                    }
                    else 
                        throw new CHttpException(403, 'Ошибка добавления в базу данных.');

                }
                // display the register form
                $this->render('registration',array('model'=>$model));
            }
            else    $this->redirect(Yii::app()->user->returnUrl);
	}
        
        protected function sendActivationKey($model) {
           $name=Yii::app()->name;
			$mail=Yii::app()->config->get('ADMIN_EMAIL');
            $subject='=?UTF-8?B?'.base64_encode('Код активации аккаунта на сайте '.Yii::app()->name).'?=';
            $message = 'Для активации аккаунта перейдите по ссылке: '.$this->createAbsoluteUrl('/')
                    .'/site/activation/'.$model->activationKey;
			$headers="From: $name <$mail>\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";
            mail($model->email,$subject,$message,$headers);
        }
        
        function actionActivation() {
            if(!empty($_GET['key'])) {
                $user = User::model()->find('activationKey = :activationKey',
                        array(':activationKey' => $_GET['key']));

                //  Проверяем существует ли пользователь с данным кодом активации
                if(!empty($user)) {
                    if($user->status == '1') {
                        $this->render('message', array('breadcrumb'       => 'Активация аккаунта',
                                                           'messageTitle'  => 'Активация аккаунта',
                                                           'messageText'  => 'Аккаунт уже активирован!'));
                    } else {
                        $user->status = '1';
                        $user->save();

                        $this->render('message', array('breadcrumb'       => 'Активация аккаунта',
                                                           'messageTitle' => 'Активация аккаунта',
                                                           'messageText'  => 'Аккаунт успешно активирован!'));
                    }
                } else {

                    // Если нет такого ключа то выводим сообщение об ошибке
                    throw new CHttpException(403, 'Такого пользователя не существует.');
                }
            } else {

                // Если не передан ключ активации, редиректим обратно
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        
        public function actionPage() {
            if(empty($_GET['view']))
                Yii::app()->runController('post/index');
            $model = Page::model()->findByUrl($_GET['view']);
            // if page is not found, then run a controller with that name
            if ($model === NULL)
                    Yii::app()->runController($_GET['view']);
            else
            {
                $this->pageTitle = $model->title;
                $this->description = $model->description;
                $this->keywords = $model->keywords;
                $this->render('pages/page', array('model'=>$model));
            }
	}
}