<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
            <?php if(Yii::app()->config->get('USE_PORTLET_RECENT_COMMENTS'))
                    $this->widget('RecentComments', array(
                       'maxComments'=>Yii::app()->config->get('RECENT_COMMENTS_COUNT'),)); 
                  if(Yii::app()->config->get('USE_PORTLET_RECENT_POSTS'))
                    $this->widget('RecentPosts', array(
                       'maxPosts'=>Yii::app()->config->get('RECENT_POSTS_COUNT'),));
                  if(Yii::app()->config->get('USE_PORTLET_CATEGORIES'))
                    $this->widget('Categories');
                  if(Yii::app()->config->get('USE_PORTLET_TAG_CLOUD'))
                    $this->widget('TagCloud', array(
                       'maxTags'=>Yii::app()->config->get('TAGS_COUNT'),)); 
            ?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>