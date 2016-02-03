<?php 


get_header(); 

$count = 20; 


$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => array(get_cat_ID("uncategorized"), get_cat_ID("win")),
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false 

); 

$recent_posts = array(
    'numberposts' => 1,
    'offset' => 0,
    'category' => 0,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish',
    'suppress_filters' => true 

 );



$single_cat = array(
    'numberposts' => 20,
    'offset' => 0,
    'category' => get_cat_ID("Beauty"),
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish',
    'suppress_filters' => true 

 );



$categories = get_categories( $args );

$recent_post = wp_get_recent_posts( $recent_posts, OBJECT); 
$single_cats = wp_get_recent_posts($single_cat, OBJECT); 



?>

<header>
<div class="container">
    <div class="logo">
 
       <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
    </div>
    
</div>
</header>

<div class="hero"></div>

<div class="toolbar">
	<div class="container">
	  <div class="main-search">
		 <?php include ('wp-content/themes/remix/inc/search.html'); ?>
	  </div>
		<?php wp_nav_menu('remix'); ?>
	</div>
</div>

	
<section id="article-1" class="">

<div class="container">

<?php $latest_categories = get_the_category($recent_post[0]->ID); ?>
 <article class="article-latest remix-img" style="background-image: url(<?php echo remix_thumbnail_url('', 'post', $recent_post[0]->ID) ?>)">

        <span class="article-latest-tag">THE LATEST FROM REMIX</span>
        <div class="article-latest-exerpt">
        <span class="article-tag"><?php echo $latest_categories[0]->name; ?></span>
            <div class="article-latest-content">
               <h4><?php echo $recent_post[0]->post_title; ?></h4>
        	   <?php  echo wp_trim_words($recent_post[0]->post_excerpt, 30); ?>
        	</div>
        </div>
   
 </article>

 </section>

 <section id="article-2" class="orange">

	<?php carousel($single_cats); ?>

</section>

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

<section id="section-4" class="green">

	<?php carousel($single_cats); ?>


</section>





<?php get_footer(); ?>





