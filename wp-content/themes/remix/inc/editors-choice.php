<?php 

$culture_cat = get_cat_ID("Culture");

$category = get_category($culture_cat);


?>

<article class="article-editors-choice article-img" style="background-image: url(<?php echo remix_thumbnail_url($category->name, 'cat') ?>)">
	
		 <span class="article-tag"><?php echo $category->name; ?></span>
		 <div class="article_exerpt">
		 	<h6><?php echo $category->name ?></h6>
		 	<p>Lorem Ipsum is simply dummy text of the printing and typesetting...</p>

		 </div>

</article> 