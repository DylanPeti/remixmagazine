<?php

get_header(); 
    

  $active_items = array(); 

  foreach($articles_read as $item) {
  	$active_items[] = get_post( $item->post_id );
  }
   
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <div class="carousel-inner" role="listbox">

  

<?php
 $count = 0;
 foreach ($active_items as $dog) {
 $count++;
 if($count == 1) {
 	$active = "active";
 } else {
 	$active = '';
 }
?>

<div class="item <?php echo $active; ?>">
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
 </div>

<?php } ?>

  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>















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





