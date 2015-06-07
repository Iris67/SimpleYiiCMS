<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?> | <?php echo Yii::app()->name; ?></title>
        <meta name="description" content="<?php echo CHtml::encode($this->description); ?>" />
        <meta name="keywords" content="<?php echo CHtml::encode($this->keywords); ?>" />
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
        <?php if(Yii::app()->user->isGuest):?>
            <p id="login">
                <?php
                    echo CHtml::link('Регистрация',array('/site/registration'));
                    echo ' / ';
                    echo CHtml::link('Вход',array('/site/login')); 
                ?></p>
        <?php else:?>
            <p id="login"> <?php echo CHtml::link('Backend',array('/backend')); ?></p>
            <p id="login"> <?php echo CHtml::link('Выход ('.Yii::app()->user->name.')',array('/site/logout')); ?></p>
        <?php endif?>
	<div id="mainmenu">
		<?php
			$this->widget('zii.widgets.CMenu', array(
				'items' => Page::model()->getMenu()
			));
		?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>