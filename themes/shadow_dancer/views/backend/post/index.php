<?php
$this->breadcrumbs=array(
    'Записи'=>array('index')
);
?>

<?php if(!empty($_GET['tag'])): ?>
<h1>Записи с тегом <i><?php echo CHtml::encode($_GET['tag']); ?></i></h1>
<?php endif; ?>

<h1>Управление записями</h1>

<p><?php echo CHtml::link('Добавить новую запись',array('post/create')); ?></p>

<p>
Вы можете использовать операторы (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) при поиске.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
        'itemsCssClass'=>'item-class',
	'id'=>'post-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'summaryText' => "Записи {start}&mdash;{end} из {count}",
        'emptyText' => 'Записи не найдены',
        'pager'=>array(
            'header'=>'Навигация: '
        ),
	'columns'=>array(
		'title',
		'create_time' => array(
                    'name'=>'create_time',
                    'value'=>'date("j.m.Y H:i",$data->create_time)',
                    //'filter'=>false,
                ),
                'update_time' => array(
                    'name'=>'update_time',
                    'value'=>'date("j.m.Y H:i",$data->update_time)',
                    //'filter'=>false,
                ),
		'status'=>array(
                    'name'=>'status',
                    'value'=>'Lookup::item("PostStatus",$data->status)',
                    'filter'=> Lookup::items("PostStatus"),
                ),
                'tags',
		'category_id'=>array(
                    'name'=>'category_id',
                    'value'=>'$data->category->title',
                    'filter'=> Category::showAll(),
                ),
                'author_id'=>array(
                    'name'=>'author_id',
                    'value'=>'$data->author->username',
                    'filter'=> User::showAll(),
                ),
		array(
                    'class'=>'CButtonColumn',
                    'header' => 'Операции',
		),
	),
)); ?>
