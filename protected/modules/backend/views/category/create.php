<?php
$this->breadcrumbs=array(
    'Категории'=>array('index'),
    'Добавление',
);
?>

<h1>Добавить категорию</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>