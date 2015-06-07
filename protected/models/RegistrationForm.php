<?php

class RegistrationForm extends CFormModel
{
	public $username;
	public $password;
        public $email;
        public $url;
        public $verifyCode;
        
	public function rules()
	{
		return array(
                    array('username, password, email', 'required'),
                    array('email','email'),
                    array('username, email', 'unique', 'className' => 'User'),
                    array('username', 'length', 'max'=>25),
                    array('password', 'length', 'max'=>15, 'min'=>6),
                    array('email, url', 'length', 'max'=>128),
                    array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	public function attributeLabels()
	{
		return array(
                        'username'=>'Имя пользователя',
                        'password'=>'Пароль',
                    	'email'=>'E-mail',
                        'url'=>'Сайт',
                        'verifyCode'=>'Проверочный код',
		);
	}
        
}


