<?php 

$post_id = $_GET['article'];


if($_POST) :
 
  $update = Articles:: update_articles($_POST, $post_id);

endif;

$article = Articles::read_articles($post_id);



?>


<div class="remix-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
			  <div class="remix-sections">
				<form action="<?php echo '/wp-admin/admin.php?page=article-collection-edit.php&article=' . $article->ID; ?>" method="post">
				  <h1><?php echo $article->title; ?></h1>
				  <?php include ('form.php'); ?>
				</form>
			</div>
		</div>
		</div>
	</div>
</div>




<?php

 $latest = Collection::get_latest_articles($article->collection_type, $article->collection_count);

 $category = Collection::get_latest_from_catgories();

 $latest_from_cat = Collection::get_category_latest("fashion", $article->collection_count);


?>