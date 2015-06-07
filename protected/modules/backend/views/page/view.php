<?php
$this->breadcrumbs=array(
	'Страницы'=>array('index'),
	$model->title,
);
?>

<h1>Просмотр страницы "<?php echo $model->title; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'url',
		'title',
		'content',
		'position',
		'visible'=>array(
                    'name'=>'visible',
                    'value'=>($model->visible==0)?"Не видна":"Видна",
                ),
		'description',
		'keywords',
	),
)); ?>
