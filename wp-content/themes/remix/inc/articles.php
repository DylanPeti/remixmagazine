<?php 

$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => array(get_cat_ID("uncategorized"), get_cat_ID("win")),
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
