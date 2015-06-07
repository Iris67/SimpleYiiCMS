<?php

/**
 * This is the model class for table "{{page}}".
 *
 * The followings are the available columns in table '{{page}}':
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $content
 * @property integer $position
 * @property integer $visible
 * @property string $description
 * @property string $keywords
 */
class Page extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{page}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('url, title, content, position, visible, description, keywords', 'required'),
			array('position, visible', 'numerical', 'integerOnly'=>true),
			array('url, title', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, url, title, content, position, visible, description, keywords', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'url' => 'Url',
			'title' => 'Заголовок',
			'content' => 'Содержание',
			'position' => 'Позиция',
			'visible' => 'Видимость',
                        'description' => 'Мета-описание',
                        'keywords' => 'Ключевые слова',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('visible',$this->visible);
                $criteria->compare('description',$this->description, true);
                $criteria->compare('keywords',$this->keywords, true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Page the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function findByUrl($url) {
            return $this->find('url=:url',array(':url'=>$url));
	}
	
	public function getMenu() {
        $criteria = new CDbCriteria;
        $criteria->order = 'position ASC';            
        $rows = $this->findAll($criteria);            
        $menu = array();
        $menu[] = array(
            'label'       => 'Главная',
            'url'           => array('post/index'),
            'itemOptions' => array('class' => 'listItem'),
            'linkOptions' => array('class' => 'listItemLink', 'title' => 'Главная')
        );
	$menu[] = array(
            'label'       => 'Связаться с нами',
            'url'           => array('site/contact'),
            'itemOptions' => array('class' => 'listItem'),
            'linkOptions' => array('class' => 'listItemLink', 'title' => 'Связаться с нами'),
                                'visible' => Yii::app()->config->get('USE_CONTACT_FORM'),
        );
			
        foreach($rows as $row) {
            $menu[] = array(
                'label'       => $row['title'],
                //'url'     => array('site/page&view='.$row['url']),
                //'url'     => array('site/page/'.$row['url']),
                'url'     => array('site/page', 'view' => $row['url']),
				'itemOptions' => array('class' => 'listItem'),
                'linkOptions' => array('class' => 'listItemLink', 'title' => $row['title']),
				'visible' => $row['visible'],
            );
        }
        return $menu;
    }
}
