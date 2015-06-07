<?php
$this->breadcrumbs=array(
    'Страницы'=>array('index')
);
?>

<h1>Управление страницами</h1>

<p><?php echo CHtml::link('Добавить новую страницу',array('page/create')); ?></p>

<p>
Вы можете использовать операторы (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) при поиске.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
        'itemsCssClass'=>'item-class',
	'id'=>'page-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'summaryText' => "Страницы {start}&mdash;{end} из {count}",
        'emptyText' => 'Страницы не найдены',
        'pager'=>array(
            'header'=>'Навигация: '
        ),
	'columns'=>array(
		'id',
		'url',
		'title',
		'content',
		'position',
		'visible'=>array(
                    'name'=>'visible',
                    'value'=>'($data->visible==0)?"Не видна":"Видна"',
                    'filter'=> array(0=>"Не видна",1=>"Видна"),
                ),
		/*
		'description',
		'keywords',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
