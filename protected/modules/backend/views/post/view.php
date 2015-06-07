<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Записи'=>array('index'),
	$data->title,
);
?>

<div class="post">
    <div class="title">
	<?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
    </div>
    <div class="author">
	Автор: <?php echo $data->author->username . ' Опубликовано: ' . date('j.m.Y H:i',$data->create_time); ?>
    </div>
    <div class="content">
        <?php echo $data->content;?>
    </div>
    <div class="nav">
        <b>Тэги:</b>
		<?php echo implode(', ', $data->tagLinks); ?>
        <br/>
        <?php echo "Комментарии ({$data->commentCount})"; ?>
        <br/>
        Последние изменения: <?php echo date('j.m.Y H:i',$data->update_time); ?>
    </div>
</div>
