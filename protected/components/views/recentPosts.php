<ul>
 <?php foreach($this->getRecentPosts() as $post): ?>
    <div>
    <li><?php echo CHtml::link(CHtml::encode($post->title),
            array('post/view', 'id'=>$post->id, 'title'=>$post->title)); ?></li>
    </div>
  <?php endforeach; ?>
</ul>

