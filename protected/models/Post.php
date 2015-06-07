<?php

/**
 * This is the model class for table "{{post}}".
 *
 * The followings are the available columns in table '{{post}}':
 * @property integer $id
 * @property string $title
 * @property string $introcontent
 * @property string $content
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $status
 * @property integer $tags
 * @property integer $category_id
 * @property integer $author_id
 */
class Post extends CActiveRecord
{
    
        const STATUS_DRAFT=1;
        const STATUS_PENDING_APPROVAL=2;
        const STATUS_APPROVED=3;
        private $_oldTags;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{post}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, status, category_id', 'required'),
			array('status, category_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
                        array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/',
                            'message'=>'В тегах можно использовать только буквы.'),
                        array('tags', 'normalizeTags'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, content, update_time, create_time, status, category_id, author_id', 'safe', 'on'=>'search'),
		);
	}
        
        public function normalizeTags($attribute,$params)
        {
            $this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
        }
        
        public function getTagLinks()
	{
		$links=array();
		foreach(Tag::string2array($this->tags) as $tag)
			$links[]=CHtml::link(CHtml::encode($tag), array('post/index', 'tag'=>$tag));
		return $links;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'category'=>array(self::BELONGS_TO,'Category','category_id'),
                    'author'=>array(self::BELONGS_TO,'User','author_id'),
                    'comments' => array(self::HAS_MANY, 'Comment', 'post_id',
                        'condition'=>'comments.status='.Comment::STATUS_APPROVED,
                        'order'=>'comments.create_time DESC'),
                    'commentCount' => array(self::STAT, 'Comment', 'post_id',
                        'condition'=>'status='.Comment::STATUS_APPROVED),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название',
			'content' => 'Содержание',
			'create_time' => 'Дата создания',
                        'update_time' => 'Дата изменения',
			'status' => 'Статус',
                        'tags' => 'Теги',
			'category_id' => 'Категория',
                        'author_id' => 'Автор',
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
                               
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
                $criteria->compare('tags',$this->tags,true);
		$criteria->compare('category_id',$this->category_id);
                $criteria->compare('author_id',$this->author_id);
                
                if(!Yii::app()->user->checkAccess('editor'))
                {
                    $criteria->addCondition('author_id ='.Yii::app()->user->id,'AND');
                }
                
                if(!empty($this->create_time))
                {
                    list($day,$month,$year) = explode(".",$this->create_time);
                    $daystart= mktime(0,0,0,(int)$month,(int)$day,(int)$year);
                    $dayend= mktime(23,59,59,(int)$month,(int)$day,(int)$year);
                    $criteria->addCondition($daystart.'<=create_time AND create_time<='.$dayend);
                }
                
                if(!empty($this->update_time))
                {
                    list($day,$month,$year) = explode(".",$this->update_time);
                    $daystart= mktime(0,0,0,(int)$month,(int)$day,(int)$year);
                    $dayend= mktime(23,59,59,(int)$month,(int)$day,(int)$year);
                    $criteria->addCondition($daystart.'<=update_time AND update_time<='.$dayend);
                }
                
                if(isset($_GET['tag']))
                    $criteria->addSearchCondition('tags',$_GET['tag']);
                
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
	 * @return Article the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function beforeSave()
        {
            if(parent::beforeSave())
		{
                    if($this->isNewRecord)
                    {
                            $this->create_time=$this->update_time=time();
                            $this->author_id=Yii::app()->user->id;
                    }
                    else
                            $this->update_time=time();
                    
                    $p = new CHtmlPurifier;
                    $p->options = array(
                        'HTML.SafeObject'=>true,
                        'Output.FlashCompat'=>true,
                        'AutoFormat.AutoParagraph' => true,
                        //'HTML.Allowed'=>'p,ul,li,b,i,a[href],pre',
                        'AutoFormat.Linkify'=>true,
                        'HTML.Nofollow'=>true,
                        'Core.EscapeInvalidTags'=>true,
                    );
                    $this->introcontent = $p->purify($this->word_trim($this->content, 100));
                    return true;
		}
		else
                    return false;
        }
        
        public function findRecentPosts($limit=10)
        {
            $criteria=array(
                'condition'=>'status='.self::STATUS_APPROVED,
                'order'=>'create_time DESC',
                'limit'=>$limit,
            );
            return $this->findAll($criteria);
        }
        
        protected function afterDelete()
        {
            parent::afterDelete();
            Comment::model()->deleteAll('post_id='.$this->id);
            Tag::model()->updateFrequency($this->tags, '');
        }
        
        protected function afterSave()
        {
            parent::afterSave();
            Tag::model()->updateFrequency($this->_oldTags, $this->tags);
        }
        
        protected function afterFind()
        {
            parent::afterFind();
            $this->_oldTags=$this->tags;
        }
        
        public function addComment($comment)
        {
            if(Yii::app()->config->get('COMMENT_NEED_APPROVAL') && Yii::app()->user->isGuest)
                $comment->status=Comment::STATUS_PENDING;
            else
                $comment->status=Comment::STATUS_APPROVED;
            $comment->post_id=$this->id;
            return $comment->save();
        }
        
        public function getUrl()
	{
            return Yii::app()->createUrl('post/view', array(
                    'id'=>$this->id,
                    'title'=>$this->title,
            ));
	}
        
        public function word_trim($string, $count)
	{
	  $words = explode(' ', $string);
	  if (count($words) > $count){
		array_splice($words, $count);
		$string = implode(' ', $words);
		$string .= '...';
	  }
	  return $string;
	}
}
