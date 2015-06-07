<?php
$this->breadcrumbs=array(
    'Общие настройки'=>array('index')
);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm'); ?>

    <p class="configTitle">Общие настройки:</p>

    <div class="configRow">Название сайта</div>
    <div class="configRow">
        <?php echo $form->textField($models[0], "[0]value", array('size'=>60, 'maxlength'=>255)); ?>
        <?php echo $form->error($models[0],'[0]value'); ?>
    </div>

    <div class="configRow">Почта администратора</div>
    <div class="configRow">
        <?php echo $form->textField($models[1], "[1]value", array('size'=>60, 'maxlength'=>255)); ?>
        <?php echo $form->error($models[1],'[1]value'); ?>
    </div>

    <p class="configTitle">Тема:</p>
    <div class="configRow">
        <?php
            echo $form->radioButtonList($models[2], "[2]value",
                    array(  1 => 'Стандартная',
                            2 => 'Shadow dancer'),
                    array( 'separator'=>'<br>',
                              'labelOptions'=> array('style' => 'display: inline')
            ));
        ?>
    </div>

    <p class="configTitle">Контактная форма:</p>
    <div class="configRow">
        <?php echo $form->checkBox($models[3], "[3]value"); ?>
        <?php echo 'использовать'; ?>
    </div>
    
    <p class="configTitle">Комментарии нуждаются в подтверждении:</p>
    <div class="configRow">
        <?php echo $form->checkBox($models[4], "[4]value"); ?>
        <?php echo 'да'; ?>
    </div>

    <p class="configTitle">Портлеты:</p>

    <div class="configRow">
        <?php echo $form->checkBox($models[5], "[5]value"); ?>
        <?php echo 'Недавние комментарии'; ?>
    </div>
            <div class="configRowHint">
                <?php echo 'Количество:'; ?>
                <?php echo $form->textField($models[9], "[9]value", array('size'=>2, 'maxlength'=>2)); ?>
            </div>
    
    <div class="configRow">
        <?php echo $form->checkBox($models[6], "[6]value"); ?>
        <?php echo 'Недавние записи'; ?>
    </div>
            <div class="configRowHint">
                <?php echo 'Количество:'; ?>
                <?php echo $form->textField($models[10], "[10]value", array('size'=>2, 'maxlength'=>2)); ?>
            </div>
    
    <div class="configRow">
        <?php echo $form->checkBox($models[7], "[7]value"); ?>
        <?php echo 'Категории'; ?>
    </div>
    
    <div class="configRow">
        <?php echo $form->checkBox($models[8], "[8]value"); ?>
        <?php echo 'Облако тегов'; ?>
    </div>
            <div class="configRowHint">
                <?php echo 'Количество:'; ?>
                <?php echo $form->textField($models[11], "[11]value", array('size'=>2, 'maxlength'=>2)); ?>
            </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Применить'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
