<?php 

get_header();

?>

<div class="container">

 <div class="col-md-3">

 	<div class="user-profile-image">
 		<?php $url = get_wp_user_avatar_src($author, 250); ?>

                     <div class="author-avatar" style="background-image: url(<?php echo $url ?>)"></div>
 	</div>
 </div>

 <div class="col-md-6">

    <h2><?php echo get_the_author_meta('display_name', $author); ?></h2>
    
    <p><?php echo get_user_meta($author, 'description')[0]; ?></p>

    <?php 

    $args = array( 'author' => $author, 'posts_per_page' => 30, 'status' => 'publish' );

    $posts = get_posts($args);


    ?>
 	
 </div>

<?php if(!empty($posts)) { ?>
 <section id="article-section" class="black">
  
  <div class="container">


     <div class="row">

        <div class="col-md-12">
            <h2 class="author-title">Articles by <?php echo get_the_author_meta('display_name', $author); ?></h2>
                                 <p><?php echo get_user_meta($author, 'description', true) ?></p>
        </div>
      </div>
   
    <div class="article-collection">

    
        <?php foreach($posts as $article) {
        	article($article);
        } ?>

    </div>
    </div>


    </section>
<?php } ?>

</div>


<?php 

get_footer(); 

?>