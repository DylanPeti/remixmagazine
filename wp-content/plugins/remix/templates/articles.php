<?php 

<<<<<<< HEAD

?>
<div class="admin-article">
   <div class="container">

   	  <h1>Article Collections</h1>
     
   	  <div class="article-collections">
   	  	<div class="col-md-6">
   	  		<div class="article-item">
   	  		  <span>Article ID</span>
   	  		  <h2>Collection Title: Remix One</h2>
   	  		  <h4>Collection Type: Latest articles</h4>
   	  		</div>
   	  	</div>
   	  	<div class="col-md-6">
   	  		<div class="article-item">
   	  			
   	  		</div>
   	  	</div>
   	  </div>
=======
if($_POST) :
$save = Articles::create_articles($_POST);
endif; 

$collection = Articles::read_articles();

?>
<div class="remix-wrapper">
   <div class="container">
    <div class="title">
   	  <h1>Article Collections</h1>
    </div>

  

  <div class="row">
    <div class="col-md-12">
          
          <div class="row">

<?php foreach($collection as $article) : ?>
              <a href="<?php echo '/wp-admin/admin.php?page=article-collection-edit.php&article=' . $article->ID; ?>">

            <div class="col-md-6">
            <div class="remix-sections">
              <div class="row">
                <div class="col-md-12">
                  <div class="details">
                    
                    <div class="section-title"><h2 class="hero"><?php echo $article->page ?></h2></div>
                    <div class="pointer"><i class="fa fa-long-arrow-right"></i></div>
                    <div class="status active"><p>active</p></div>
                    
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div>
                    <p>Count: <?php echo $article->collection_count; ?></p>
                    <p class="meta">Last updated: 3 Marc 2015</p>
                    <p class="meta">Author: Carl Thompson</p>
                    
                    
                  </div>
                </div>
              </div>
            </div>
            
             </div>
          </a>
 <?php endforeach; ?>


          </div>

      </div>
     
    </div>

 


>>>>>>> master
   </div>
</div>