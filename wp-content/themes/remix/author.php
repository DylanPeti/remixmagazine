<?php 

get_header();


?>

<div class="container">

 <div class="col-md-3">

 	<div class="user-profile-image">
 		  <div class="avatar"><?php echo get_avatar(get_the_author_meta('ID'), 260 ); ?></div>
 	</div>
 </div>

 <div class="col-md-6">

<h2><?php echo get_the_author(); ?></h2>

<p><?php echo get_the_author_meta('description'); ?></p>
 	

 </div>


</div>


<?php 

get_footer(); 

?>