<?php foreach($comments as $comment): ?>
<div class="comment" id="c<?php echo $comment->id; ?>">

	<div class="author">
		<?php echo $comment->author; ?> сказал(а):
	</div>

	<div class="time">
		<?php echo date('j.m.Y H:i',$comment->create_time); ?>
	</div>

	<div class="content">
		<?php echo nl2br(CHtml::encode($comment->content)); ?>
	</div>

</div><!-- comment -->
<?php endforeach; ?>

