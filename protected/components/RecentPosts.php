<?php
Yii::import('zii.widgets.CPortlet');

class RecentPosts extends CPortlet
{   
    public $title='Недавние записи';
    public $maxPosts=10;
    
    public function getRecentPosts()
    {
        return Post::model()->findRecentPosts($this->maxPosts);
    }
 
    protected function renderContent()
    {
        $this->render('recentPosts');
    }
}
