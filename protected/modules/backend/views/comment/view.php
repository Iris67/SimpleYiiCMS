<?php
$this->breadcrumbs=array(
    'Комментарии'=>array('index'),
    $model->id,
);
?>

<h1>Просмотр комментария</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                'content',
		'status'=>array(
                    'name'=>'status',
                    'value'=>Lookup::item("CommentStatus",$model->status),
                    'filter'=> Lookup::items("CommentStatus"),
                ),
		'create_time' => array(
                    'name'=>'create_time',
                    'value'=>date("j.m.Y H:i",$model->create_time),
                    'filter'=>false,
                ),
		'author',
		'email',
		'url',
		'post_id'=>array(
                    'name'=>'post_id',
                    'value'=>$model->post->title,
                    'filter'=>$model->post->title,
                ),
	),
)); ?>
