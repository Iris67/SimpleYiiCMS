<?php
$this->breadcrumbs=array(
    'Записи'=>array('index'),
    'Добавление',
);
?>

<h1>Добавить запись</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>