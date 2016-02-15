<?php 

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


$recent_post = wp_get_recent_posts( $recent_posts, OBJECT); 

?>

<section id="latest-article-section" class="">

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