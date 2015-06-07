<?php
$this->breadcrumbs=array(
    'Категории'=>array('index'),
    'Изменение',
);
?>

<h1>Изменить категорию "<?php echo $model->title; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>