<?php 

$culture_cat = get_cat_ID("Culture");

$category = get_category($culture_cat);


?>

<article class="article-editors-choice">

    	<div class="article-img" style="background-image: url(<?php echo remix_thumbnail_url($category->name, 'cat') ?>)">
      	</div>
	
		 <div class="article_exerpt">
		 <?php $cat_class = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $category->name)); ?>
		 <span class="article-tag <?php echo $cat_class; ?>"><?php echo $category->name; ?></span>
		 	<h2><?php echo remix_post_title($category->name); ?></h2>
		 	<span class="author"><?php echo remix_post_author($category->name); ?></span>
		 	<ul class="entypo-icons">
             <li class="entypo-facebook"></li>
             <li class="entypo-twitter"></li>
            </ul>

		 </div>

</article> 


