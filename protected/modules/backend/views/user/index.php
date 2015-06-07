<?php
$this->breadcrumbs=array(
    'Пользователи'=>array('index')
);
?>

<h1>Управление пользователями</h1>

<p>
Вы можете использовать операторы (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) при поиске.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'summaryText' => "Пользователи {start}&mdash;{end} из {count}",
        'emptyText' => 'Пользователи не найдены',
        'pager'=>array(
            'header'=>'Навигация: '
        ),
	'columns'=>array(
		'id',
		'username',
		'email',
		'url',
		'role'=>array(
                    'name'=>'role',
                    'value'=>'Lookup::item("UserRole",$data->role)',
                    'filter'=> Lookup::items("UserRole"),
                ),
		'status'=>array(
                    'name'=>'status',
                    'value'=>'($data->status==0)?"Не актив.":"Актив."',
                    'filter'=> array(0=>"Не актив.",1=>"Актив."),
                ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
