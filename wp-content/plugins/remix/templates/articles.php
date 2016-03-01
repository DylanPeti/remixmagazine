<?php 

if($_POST) :
// $save = Articles::create_articles($_POST);


$save = Articles::update_articles($_POST, $_POST['id']);

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
 
<?php $options = array(); ?>


 <?php switch ($article->page) {
   case 'Home':

   $submit = "update_home";

   $options[] = "the_latest_posts";
   $options[] = "the_latest_from_categories";
     
     break;

   case 'Category':

    $submit = "update_category";

   $options[] = "the_latest_posts";
   $options[] = "the_latest_from_this_category";
   
   break;

   case 'Blog':

    $submit = "update_blog";
   
   $options[] = "the_latest_posts";
   $options[] = "related_articles";
     
  break;
   
   default:
     # code...
     break;
 }

 $counts = array(); 
 $counts[] = "4";
 $counts[] = "8";
 $counts[] = "12";
 $counts[] = "16";


 ?>
       
   <form action="http://remixmagazine.dev/wp-admin/admin.php?page=remix-articles.php" method="post">
            <div class="col-md-12">
  

            <div class="remix-sections article-collection">

            <div class="col-md-3">
              
    

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

          <?php $set_option = $article->collection_type; ?>

           <div class="col-md-3">
             <div class="form-group">
                <label for="sel1">Post Type</label>
                <select name="collection_type" class="form-control" id="sel1" selected="selected">
                 <?php foreach ($options as $option) : ?>
                       <option class="article-option" value="<?php echo $option ?>" <?php echo ($set_option == $option ? "selected" : ""); ?>><?php echo ucwords(str_replace("_", " ", $option)); ?></option>
                 <?php endforeach; ?>
                </select>
            </div>
              </div>

           <?php $set_count = $article->collection_count; ?>

              <div class="col-md-3">
             <div class="form-group">
              <label for="sel1">How many Posts</label>
                <select name="collection_count" class="form-control" id="sel1" selected="selected">
          
                 <?php foreach($counts as $count) : ?>
              <option class="count" value="<?php echo $count; ?>" <?php echo ($set_count == $count ? "selected" : ""); ?>><?php echo $count; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
              </div>


             <input type="hidden" name="id" value="<?php echo $article->ID; ?>">

            <div class="col-md-3">
               <input href="#" name="<?php echo $submit; ?>" class="btn-update" type="submit" value="Update">
            </div>  

            </div>





         
             </div>
             </form>
   
 <?php endforeach; ?>


          </div>

      </div>
     
    </div>

 



   </div>
</div>