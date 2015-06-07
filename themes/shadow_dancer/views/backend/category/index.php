<?php
$this->breadcrumbs=array(
    'Категории'=>array('index')
);
?>

<h1>Управление категориями</h1>

<p><?php echo CHtml::link('Добавить новую категорию',array('category/create')); ?></p>

<p>
Вы можете использовать операторы (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) при поиске.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
        'itemsCssClass'=>'item-class',
	'id'=>'category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'summaryText' => "Категории {start}&mdash;{end} из {count}",
        'emptyText' => 'Категории не найдены',
        'pager'=>array(
            'header'=>'Навигация: '
        ),
	'columns'=>array(
            'title',
            array(
		'class'=>'CButtonColumn',
                'template'=>'{update}{delete}',
                'header' => 'Операции',
            ),
	),
)); ?>
