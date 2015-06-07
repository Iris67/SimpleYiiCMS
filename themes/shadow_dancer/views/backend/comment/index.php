<?php
$this->breadcrumbs=array(
    'Комментарии'=>array('index')
);
?>

<h1>Управление комментариями</h1>

<p>
Вы можете использовать операторы (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) при поиске.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
        'itemsCssClass'=>'item-class',
	'id'=>'comment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'summaryText' => "Комментарии {start}&mdash;{end} из {count}",
        'emptyText' => 'Комментарии не найдены',
        'pager'=>array(
            'header'=>'Навигация: '
        ),
	'columns'=>array(
		'content' => array(
                    'name'=>'content',
                    'value' => 'mb_substr($data->content, 0, 20, "UTF-8")',
                ),
		'status'=>array(
                    'name'=>'status',
                    'value'=>'Lookup::item("CommentStatus",$data->status)',
                    'filter'=> Lookup::items("CommentStatus"),
                ),
		'create_time' => array(
                    'name'=>'create_time',
                    'value'=>'date("j.m.Y H:i",$data->create_time)',
                    //'filter'=>false,
                ),
		'author',
		'email',
		'url',
		'post_id'=>array(
                    'name'=>'post_id',
                    'value'=>'$data->post->title',
                ),
		//'author_id',
		
		array(
			'class'=>'CButtonColumn',
                        'header' => 'Операции',
		),
	),
)); ?>
