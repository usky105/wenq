<ul>
  	<?php  $ac = Yii::app()->getController()->id; ?>
	
	<li><?php echo CHtml::link('Manage Goods_Type',array('goodsType/admin')); ?></li>
	<li><?php echo CHtml::link('Manage Goods_Category',array('goodsCategory/admin')); ?></li>
	<li><?php echo CHtml::link('Manage Goods',array('Goods/admin')); ?></li>







	<li><?php echo CHtml::link('Create New AdminUser',array('AdminUser/create')); ?></li>
	<li><?php echo CHtml::link('Logout',array('site/logout')); ?></li>
</ul>