<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля с <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model); ?>

        <?php if(Yii::app()->user->isGuest):?>
            <div class="row">
                <?php echo $form->labelEx($model,'author'); ?>
                <?php echo $form->textField($model,'author',array('size'=>25,'maxlength'=>25)); ?>
                <?php echo $form->error($model,'author'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model,'email'); ?>
                <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
                <?php echo $form->error($model,'email'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model,'url'); ?>
                <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>128)); ?>
                <?php echo $form->error($model,'url'); ?>
            </div>
        <?php else:?>
            <h5> <?php echo 'Вы вошли как ' . Yii::app()->user->name; ?> </h5>
        <?php endif?>
        
	<div class="row">
            <?php echo $form->labelEx($model,'content'); ?>
            <?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'content'); ?>
	</div>
            
        <?php if(CCaptcha::checkRequirements() && Yii::app()->user->isGuest): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
                    <?php $this->widget('CCaptcha', array('buttonLabel' => '<br>Получить новый код')); ?>
                    <br /><?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Пожалуйста, введите символы с картинки.
		<br/>Символы не чувствительны к регистру.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
            </div>
        <?php endif; ?>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Отправить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->