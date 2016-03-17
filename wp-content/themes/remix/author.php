<?php 

get_header();

?>

<div class="container">

 <div class="col-md-3">

 	<div class="user-profile-image">
 		  <div class="avatar"><?php echo get_avatar($author, 260 ); ?></div>
 	</div>
 </div>

 <div class="col-md-6">

    <h2><?php echo get_the_author_meta('user_nicename', $author); ?></h2>
    
    <p><?php echo get_user_meta($author, 'description')[0]; ?></p>
 	
 </div>


</div>


<?php 

get_footer(); 

?>