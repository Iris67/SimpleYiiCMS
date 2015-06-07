<?php
/* @var $this PostController */
/* @var $data Post */
?>

<div class="post">
    <div class="title">
	<?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id, 'title'=>$data->title)); ?>
    </div>
    <div class="author">
	Автор: <?php echo $data->author->username . ' Опубликовано: ' . date('j.m.Y H:i',$data->create_time); ?>
    </div>
    <div class="content">
        <?php echo $data->introcontent;?>
    </div>
    <div class="readmore">
		<?php echo CHtml::link('Читать далее &#8594', array('view', 'id'=>$data->id, 'title'=>$data->title)); ?>
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