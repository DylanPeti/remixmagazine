<?php 


$car_items = array(
	get_cat_ID("fashion"), 
	get_cat_ID("beauty"), 
	get_cat_ID("Culture"),
	get_cat_ID("Lifestyle"),
	get_cat_ID("#soulsundaysessions"),
	get_cat_ID("#notatourist")
	);


$testing = array(implode(',',$car_items));


$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'include'                  => $testing[0],
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'taxonomy'                 => 'category',
	'pad_counts'               => false 

); 

$categories = get_categories( $args );

?>

<section id="article-3" class="black">

 <div class="container">
	<div class="article-collection">

	<?php foreach ($categories as $article) : ?>


		<article class="article">
	
		 <span class="article-tag"><?php echo $article->name; ?></span>
		 <div class="article_image remix-img" style="background-image: url(<?php echo remix_thumbnail_url($article->name, 'cat') ?>)"></div>
		 <div class="article_exerpt"></div>

		</article>

    <?php endforeach; ?>
  
	</div>
</div>
</section>









