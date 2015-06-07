<?php
$this->breadcrumbs=array(
    'Тэги'=>array('index')
);
?>

<h1>Просмотр тэгов</h1>

<p>
Вы можете использовать операторы (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) при поиске.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
        'itemsCssClass'=>'item-class',
	'id'=>'tag-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'summaryText' => "Тэги {start}&mdash;{end} из {count}",
        'emptyText' => 'Тэги не найдены',
        'pager'=>array(
            'header'=>'Навигация: '
        ),
	'columns'=>array(
		'name',
		'frequency',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'',
		),
	),
)); ?>
