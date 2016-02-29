<?php

get_header(); 
    

  $active_items = array(); 

  foreach($articles_read as $item) {
  	$active_items[] = get_post( $item->post_id );
  }
   

 foreach ($active_items as $dog) {
 
?>

<div class="hero" style="background-image: url(<?php echo remix_thumbnail_url('', 'post', $dog->ID) ?>)">
	<div class="container">
		<div class="article_exerpt">
			<span class="article-tag">Category</span>
			<h2><?php echo $dog->post_title; ?></h2>
			<p><strong><a href=""> READ FULL ARTICLE</strong></a></p>
			<span class="author"><?php echo $dog->post_author; ?></span>
		 	<ul class="entypo-icons">
	         <li class="entypo-facebook"></li>
	         <li class="entypo-twitter"></li>
	        </ul>
		</div>
	</div> 
</div>

<?php } ?>



<?php $filter =  Collection::filter_posts("home"); ?>

<section id="article-section" class="black">

 <div class="container">
	<div class="article-collection">

	<?php foreach ($filter as $article) : ?>

    <?php $cat_class = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $article['title'])); ?>
      <article class="article">
      	<div class="article-img" style="background-image: url(<?php echo "'" . $article['image'] . "'" ?>)">
      	</div>
		 <div class="article_exerpt">
		  	<span class="article-tag <?php echo strtolower($article['category']); ?>"><?php echo $article['category']; ?></span>
		 	<h2><?php echo substr($article['title'], 0, 52); ?></h2>
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


<?php 
   
    get_section('carousel'); 


get_footer(); 





