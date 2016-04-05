<?php /* Template Name: Contributors */ ?>

<?php

get_header(); 

?>

<div class="contributors-section">
<div class="container">
<h2><?php the_title(); ?></h2>
		<div class="toolbar">
			<span class="crumbs">
				<?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
			</span>
		</div>

		<?php

    $remix_team = array('tim@remix.co.nz', 
                        'steven@remix-magazine.com', 
                        'isabelle+amber@remixmagazine.com',
                        'isabelle+isaac@remixmagazine.com',
                        'isabelle+julia@remixmagazine.com',
                        'isabelle+katherine@remixmagazine.com',
                        'isabelle+natalie@remixmagazine.com',
                        'isabelle@remix.co.nz', 
                        'isabelle+millie@remixmagazine.com',
                        'isabelle+jupiterproject@remixmagazine.com'
                        );

    foreach($remix_team as $item) :  ?>

    <?php

    $user = get_user_by('email', $item); 

    ?>

      <div class="col-md-2">
                 <div class="user-profile-card">
                 <a href="<?php echo get_author_posts_url($user->data->ID); ?>">

                 <?php 

                 $args = array(
                  'size' => 136,  
                  'force_default'  => false,
                  );
             
               $args = get_avatar_data( $user->data->ID, $args);

               $url = get_wp_user_avatar_src($user->data->ID);


                  ?>

                     <div class="single-avatar" style="background-image: url(<?php echo $url ?>)"></div>
                     <p class="name"><?php echo $user->display_name ?></p>


                 </div>
                  
                 </div>




    <?php endforeach; ?> 



  <?php
           $blogusers = get_users( 'blog_id=1&orderby=rand&role=author' );

           foreach ( $blogusers as $user ) { ?>

           <?php $name = $user->data->display_name; ?>


       

       <?php if(in_array($user->user_email, $remix_team)) : continue; endif;   ?>
      
       

   
                 <div class="col-md-2">
                 <div class="user-profile-card">
                 <a href="<?php echo get_author_posts_url($user->data->ID); ?>">

                 <?php 

                 $args = array(
                  'size' => 136,
                  'force_default'  => false,
                  );
             
               $args = get_avatar_data( $user->data->ID, $args);

               $url = get_wp_user_avatar_src($user->data->ID);


                  ?>

                     <div class="single-avatar" style="background-image: url(<?php echo $url ?>)"></div>
                     <p class="name"><?php echo $user->display_name ?></p>


                 </div>
                 	
                 </div>




           
          <?php } ?>


</div>
</div>

<?php 

get_footer(); 

?>