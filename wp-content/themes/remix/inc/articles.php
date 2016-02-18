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
    <?php $cat_class = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $article->name)); ?>
      <article class="article">
      	<div class=" article-img" style="background-image: url(<?php echo remix_thumbnail_url($article->name, 'cat') ?>)">
      	</div>
		 <div class="article_exerpt">
		  	<span class="article-tag <?php echo $cat_class; ?>"><?php echo $article->name; ?></span>
		 	<h2><?php echo remix_post_title($article->name); ?></h2>
		 	<span class="author"><?php echo remix_post_author($article->name); ?></span>
		 	<ul class="entypo-icons">
             <li class="entypo-facebook"></li>
             <li class="entypo-twitter"></li>
            </ul>

		 </div>

      </article>

    <?php endforeach; ?>
  
	</div>
</div>
</section>









