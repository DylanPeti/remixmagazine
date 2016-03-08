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
<?php $cat_class = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $latest_categories[0]->name)); ?>
 <article class="article-latest remix-img">
 <a href="<?php echo get_the_permalink($recent_post[0]->ID); ?>">

        <span class="article-latest-tag">THE LATEST FROM REMIX</span>
        <div class="article-latest-img remix-img" style="background-image: url(<?php echo remix_thumbnail_url($recent_post[0]) ?>)"></div>
        <div class="article-latest-exerpt">
        <span class="article-tag <?php echo $cat_class; ?>"><?php echo $latest_categories[0]->name; ?></span>
            <div class="article-latest-content">
               <h2><?php echo $recent_post[0]->post_title; ?></h2>
        	   <?php  echo wp_trim_words($recent_post[0]->post_excerpt, 30); ?>
        	</div>
             
              <span class="article-latest-author"><?php echo remix_post_author($recent_post[0]->title); ?></span>
           
            <ul class="entypo-icons">
             <div class="social-btn" id="fbshare" data-share="<?php echo $link ?>,<?php echo $title ?>,<?php echo $image ?>">
               <li class="entypo-facebook"></li>
              </div>
              <div class="social-btn"><li class="entypo-twitter"></li></div>
            </ul>



        </div>
 </a>  
 </article>

<?php include('editors-choice.php'); ?>

</section>




