<?php 


$car_items = array(
	get_cat_ID("fashion"), 
	get_cat_ID("beauty"), 
	get_cat_ID("Culture"),
	get_cat_ID("Lifestyle"),
	get_cat_ID("#soulsundaysessions"),
	get_cat_ID("#notatourist"),
	get_cat_ID("outandabout"),
	get_cat_ID("Research")

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

<section id="article-section" class="black">

 <div class="container">
	<div class="article-collection">

	<?php foreach ($categories as $article) : ?>


		<article class="article article-img" style="background-image: url(<?php echo remix_thumbnail_url($article->name, 'cat') ?>)">
	
		 <span class="article-tag"><?php echo $article->name; ?></span>
		 <div class="article_exerpt">
		 	<h6><?php echo $article->name ?></h6>
		 	<p>Lorem Ipsum is simply dummy text of the printing and typesetting...</p>

		 </div>

		</article>

    <?php endforeach; ?>
  
	</div>
</div>
</section>









