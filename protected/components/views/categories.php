<ul>
 <?php foreach($this->getCategories() as $category): ?>
    <div>
    <li><?php echo CHtml::link(CHtml::encode($category->title),
            array('category/index', 'id'=>$category->id, 'title'=>$category->title)); ?></li>
    </div>
  <?php endforeach; ?>
</ul>