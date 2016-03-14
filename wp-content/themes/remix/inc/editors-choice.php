<?php 

$post = get_post(9767);

$category = get_the_category($post->ID);

$category = $category[0]->name;

?>

<article class="article-editors-choice">

    	<div class="article-img" style="background-image: url(<?php echo remix_thumbnail_url($post) ?>)">
      	</div>
	
		 <div class="article_exerpt">
		 <?php $cat_class = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $category)); ?>
		 <span class="article-tag <?php echo $cat_class; ?>"><?php echo $category; ?></span>
		 	<h2><?php echo $post->post_title; ?></h2>
		 	<ul class="entypo-icons">
             <li class="entypo-facebook"></li>
             <li class="entypo-twitter"></li>
            </ul>

		 </div>

</article> 


