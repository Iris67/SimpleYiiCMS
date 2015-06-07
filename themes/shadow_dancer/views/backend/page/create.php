<?php
$this->breadcrumbs=array(
    'Страницы'=>array('index'),
    'Добавление',
);
?>

<h1>Добавить страницу</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>