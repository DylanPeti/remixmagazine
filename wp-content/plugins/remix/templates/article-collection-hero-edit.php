<?php 

$collections = Collection::get_latest_articles('post', 3);

$articles_read = Articles::read_articles(null, "collection_type", 'hero');

if($_POST) : 


	if( $_POST['submit'] == "Remove" ) :
      
      $articles_delete = Articles::delete_articles($_POST['post_id']);

      $success = "Hero deleted";

    elseif( $_POST['submit'] == "Set" ): 

            $active_articles = 0;

            foreach($articles_read as $item) :

                if ($item->collection_status == 'active') :
                	
                	$active_articles++;

                endif;

            endforeach; 

           if ($active_articles < 3) :

              $articles_create = Articles::create_articles($_POST);

              $success = "Hero updated!"; 

           else :
      
              $error = "There are too many active slides. Try removing one"; 

           endif;

     endif;

endif;


$articles_read = Articles::read_articles(null, "collection_type", 'hero');

?>



<div class="remix-wrapper">
	<div class="container">
		
     <div class="title">
     	<h1>Hero Section</h1>
     </div>

     <?php if(isset($error)) : ?>
     <div class="row">
       <div class="col-md-12">
          <div class="error-msg">
          <?php echo $error; ?>
          </div>
        </div>

     </div>

     <?php endif; ?>

     <?php if(isset($success)) : ?>
     <div class="row">
       <div class="col-md-12">
          <div class="success-msg">
          <?php echo $success; ?>
          </div>
        </div>

     </div>

    <?php endif; ?>


	
	<div class="row">
		
    <?php $collection_article = array(); ?>

    <?php $do_not_duplicate = array();

        foreach ($articles_read as $item) { 
        
        	$do_not_duplicate[] = $item->post_id;
    
        }

      $collections = Collection::get_latest_articles('post', 10, $do_not_duplicate);


      $merge = array_merge($articles_read, $collections); 

     ?>

		<?php foreach ($merge as $article) :

        $author = (isset($article->post_author) ? get_the_author_meta('display_name', $article->post_author) : $article->collection_author);

        $title = (isset($article->post_title) ? $article->post_title : $article->title);

        $id = (isset($article->post_id) ? $article->post_id : $article->ID);

        $date = (isset($article->post_date) ? $article->post_date : $article->time);

        $status = (isset($article->collection_status) ? $article->collection_status : "inactive");

        $submit = ($status == "active" ? "Remove" : "Set");


    ?>


        <form action="http://remixmagazine.dev/wp-admin/admin.php?page=article-collection-hero-edit.php" method="post"> 
           <div class="col-md-6">

			   
				<div class="remix-sections">
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
								 <div class="details">
										
							      <div class="section-title"><h2 class="hero"><?php echo $id; ?></h2></div>
								  <div class="pointer"><i class="fa fa-long-arrow-right"></i></div>
								  <div class="status <?php echo $status; ?>"><p><?php echo $status; ?></p></div>
								 
										
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div>
							    <p><?php echo substr($title, 0, 60); ?></p>
								<p class="meta">Last updated: <?php echo $date; ?></p>
								<p class="meta">Author: <?php echo $author; ?></p>
										
										
									</div>
								</div>
							</div>
						</div>
                         
                      
                      <?php if ($status == "inactive") : ?>

						 <input type="hidden" name="title" value="<?php echo $title ?>">
						 <input type="hidden" name="collection_type" value="<?php echo 'hero'; ?>">
						 <input type="hidden" name="collection_author" value="<?php echo $author; ?>">
						 <input type="hidden" name="post_id" value="">
						 <input type="hidden" name="post_id" value="<?php echo $id ?>">
						 <input type="hidden" name="collection_count" value="<?php echo '1'; ?>">
						 <input type="hidden" name="collection_status" value="active">

					  <?php else: ?>


                          <input type="hidden" name="post_id" value="<?php echo $id ?>">
					  
					  <?php endif; ?>


						<div class="col-md-6">
							<div class="hero-image">

						    <div class="img" style="background-image: url(<?php echo remix_thumbnail_url('', 'post', $id) ?>)"></div>
						<input href="#" name="submit" class="btn-update" type="submit" value="<?php echo $submit; ?>">
						      </div>
							</div>
							
						</div>
					</div>
					</div>

			   </form>

               <?php endforeach; ?>



				
			
		</div>
		
	</div>
</div>