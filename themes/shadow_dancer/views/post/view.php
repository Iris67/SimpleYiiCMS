<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Записи'=>array('index'),
	$model->title,
);
?>

<div class="post">
    <div class="title">
	<?php echo CHtml::encode($model->title); ?>
    </div>
    <div class="author">
	Автор: <?php echo $model->author->username . ' Опубликовано: ' . date('j.m.Y H:i',$model->create_time); ?>
    </div>
    <div class="content">
        <?php echo $model->content;?>
    </div>
    <div class="nav">
        <b>Тэги:</b>
		<?php echo implode(', ', $model->tagLinks); ?>
        <br/>
        <?php echo "Комментарии ({$model->commentCount})"; ?>
        <br/>
        Последние изменения: <?php echo date('j.m.Y H:i',$model->update_time); ?>
    </div>
</div>

<div id="comments">
    <?php if($model->commentCount>=1): ?>
        <h3>
            <?php echo 'Комментарии (' . $model->commentCount . '):'; ?>
        </h3>
 
        <?php $this->renderPartial('_comments',array(
            'post'=>$model,
            'comments'=>$model->comments,
        )); ?>
    <?php endif; ?>
    
    <h3>Оставить комментарий</h3>
 
    <?php if(Yii::app()->user->hasFlash('commentSubmitted')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
        </div>
    <?php else: ?>
        <?php $this->renderPartial('/comment/_form',array(
            'model'=>$comment,
        )); ?>
    <?php endif; ?>
       
</div>
