<ul>
    <?php if(Yii::app()->user->checkAccess('indexConfig')){
            echo '<li>'.CHtml::link('Общие настройки',array('config/index')).'</li>';
              }?>
    <?php if(Yii::app()->user->checkAccess('readCategory')){
                echo '<li>'.CHtml::link('Категории',array('category/index')).'</li>';
              }?>
    <?php if(Yii::app()->user->checkAccess('indexPost')){
                echo '<li>'.CHtml::link('Записи',array('post/index')); 
              }?>
    <?php if(Yii::app()->user->checkAccess('indexPage')){
            echo '<li>'.CHtml::link('Страницы',array('page/index')); 
              }?>
    <?php if(Yii::app()->user->checkAccess('indexComment')){
                echo '<li>'.CHtml::link('Комментарии',array('comment/index')).'</li>';
              }?>
    <?php if(Yii::app()->user->checkAccess('indexTag')){
                echo '<li>'.CHtml::link('Тэги',array('tag/index')).'</li>';
              }?>
    <?php if(Yii::app()->user->checkAccess('indexUser')){
                echo '<li>'.CHtml::link('Пользователи',array('user/index')).'</li>';
              }?>
    <?php 
          echo '<li>'.CHtml::link('Профиль',array('user/view','id'=>Yii::app()->user->id)).'</li>';
              ?>
</ul>
