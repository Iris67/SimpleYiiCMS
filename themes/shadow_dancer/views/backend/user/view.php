<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	$model->username,
);
?>

<h1>Профиль пользователя <?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
        'cssFile'=>Yii::app()->theme->baseUrl.'/css/detailview.css',
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'email',
		'url',
		'role'=>array(
                    'name'=>'role',
                    'value'=>Lookup::item("UserRole",$model->role),
                    'filter'=> Lookup::items("UserRole"),
                ),
		'status'=>array(
                    'name'=>'status',
                    'value'=>($model->status==0)?"Не актив.":"Актив.",
                    'filter'=> array(0=>"Не актив.",1=>"Актив."),
                ),
	),
)); ?>

<p><?php echo CHtml::link('Изменить профиль',array('user/update','id'=>Yii::app()->user->id)); ?></p>
