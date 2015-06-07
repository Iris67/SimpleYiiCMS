<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The followings are the available columns in table '{{comment}}':
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property string $author
 * @property string $email
 * @property string $url
 * @property integer $post_id
 * @property integer $author_id
 */
class Comment extends CActiveRecord
{
        const STATUS_PENDING=1;
        const STATUS_APPROVED=2;
        public $verifyCode;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('author, email','required', 'on'=> 'guest'),
                        array('content','required'),
			array('author', 'length', 'max'=>25),
			array('email, url', 'length', 'max'=>128),
                        array('email','email'),
                        array('url','url'),
                        array('status','safe'),
                        array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!Yii::app()->user->isGuest || !CCaptcha::checkRequirements()),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, content, status, create_time, author, email, url, post_id, author_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'auth_author'=>array(self::BELONGS_TO,'User','author_id'),
                    'post'=>array(self::BELONGS_TO,'Post','post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'content' => 'Комментарий',
			'status' => 'Статус',
			'create_time' => 'Время создания',
			'author' => 'Автор',
			'email' => 'Email',
			'url' => 'Сайт',
			'post_id' => 'Запись',
			'author_id' => 'Author_id',
                        'verifyCode' => 'Код проверки',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                
                $criteria->with = array(
                    'post' => array(
                        'select' => array('title','author_id')
                    ),
                );
                
                $criteria->together = true;
                
                if(!empty($this->post_id)){
                    $criteria->addSearchCondition( 
                        new CDbExpression( 'post.title' ),  
                        $this->post_id 
                        );
                }
                
		$criteria->compare('id',$this->id);
		$criteria->compare('t.content',$this->content,true);
		$criteria->compare('t.status',$this->status);
		//$criteria->compare('t.create_time',$this->create_time);
		$criteria->compare('t.author',$this->author,true);
		$criteria->compare('t.email',$this->email,true);
		$criteria->compare('t.url',$this->url,true);
		//$criteria->compare('post_id',$this->post_id);
		$criteria->compare('t.author_id',$this->author_id);

                //$criteria->order = 'create_time DESC';
                if(!empty($this->create_time))
                {
                    list($day,$month,$year) = explode(".",$this->create_time);
                    $daystart= mktime(0,0,0,(int)$month,(int)$day,(int)$year);
                    $dayend= mktime(23,59,59,(int)$month,(int)$day,(int)$year);
                    $criteria->addCondition($daystart.'<=t.create_time AND t.create_time<='.$dayend);
                }
                
                if(!Yii::app()->user->checkAccess('editor'))
                {
                    $criteria->addCondition('t.author_id ='.Yii::app()->user->id,'AND');
                    $criteria->addCondition('post.author_id ='.Yii::app()->user->id,'OR');
                }
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'defaultOrder'=>'t.create_time DESC',
                            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        protected function beforeSave()
        {
            if(parent::beforeSave())
            {
                if($this->isNewRecord)
                    $this->create_time=time();
                    if(!Yii::app()->user->isGuest)
                    {
                        $this->author_id=Yii::app()->user->id;
                        $this->author=$this->auth_author->username;
                    }
                return true;
            }
            else
                return false;
        }
        
        public function getUrl($post=null)
	{
            if($post===null)
                    $post=$this->post;
            return $post->url.'#c'.$this->id;
	}

	public function getAuthorLink()
	{
            if(!empty($this->url))
                return CHtml::link(CHtml::encode($this->author),$this->url);
            elseif(!empty($this->auth_author->url))
                return CHtml::link(CHtml::encode($this->author),$this->auth_author->url);
            else
                return CHtml::encode($this->author);
	}
        
        public function findRecentComments($limit=10)
	{
            return $this->with('post')->findAll(array(
                    'condition'=>'t.status='.self::STATUS_APPROVED,
                    'order'=>'t.create_time DESC',
                    'limit'=>$limit,
            ));
	}
}
