<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->

  <script src="https://use.typekit.net/jvi0csq.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>
 
  <link rel="stylesheet" type="text/css" href="<?php echo  get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css'; ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo  get_template_directory_uri() . '/admin.css'; ?>">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


<?php if(is_single()) { ?>


<?php } ?>


<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>


<!-- TYPEKIT -->


<!-- FACEBOOK SDK -->


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=573967432759585";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>




<header>




<div class="container">

<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <a href="/" class="logo">
        <img src="/wp-content/themes/remix/images/remix-magazine-logo.png" alt="Remix Magazine" class="img-responsive">
      </a>
    </div>
    <div class="col-md-9">
      <div class="advert-temp">
        <a href="http://goo.gl/4LKGMQ" target="_blank">
          <img src="http://remixmagazine.com/wp-content/uploads/2016/03/CONVERSE_CTASII_camo_720x80-1.jpg" class="img-responsive">
        </a>
      </div>
    </div>
  </div>
</div>

    <section id="toolbar-section">
      <div class="toolbar">
        <div class="container">
          <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'menu-remix')); ?>
        </div>
      </div>
    </section>

    <!-- Right Menu -->
    <div class="right-menu-wrap">
      <div class="slider-content">
      <span class="icon-facebook"><i class="fa fa-facebook fa-3x"></i></span>
       <span class="icon-instagram"><i class="fa fa-instagram fa-3x"></i></span>
        <span class="icon-twitter"><i class="fa fa-twitter fa-3x"></i></span>
      <span class="icon-subscribe"><i class="fa fa-envelope fa-3x"></i></span>
        <div class="mailer-wrap">
          <h3>Join The Mailer</h3>
          <form action="http://remix.us2.list-manage.com/subscribe/post?u=7f9be996e2c6cb5ef2d2df5fb&amp;id=acc14b56d6" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="">
            <div class="mc-field-group">
              <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email Address">
            </div>
            <div class="mc-field-group">
              <input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="First Name">
            </div>
            <div id="mce-responses" class="clear">
              <div class="response" id="mce-error-response" style="display:none"></div>
              <div class="response" id="mce-success-response" style="display:none"></div>
            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;"><input type="text" name="b_7f9be996e2c6cb5ef2d2df5fb_acc14b56d6" value=""></div>
            <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn"></div>
            <p class="smalltext">We hate spam too. Unsubscribe at any time.</p>
          </form>
        </div>
      </div>
    </div>
    
        <!-- Left Menu -->
    <div class="left-menu-wrap">
      <div class="slider-content">
      <span class="icon-subscribe"><i class="fa fa-bars fa-3x"></i></span>
        <div class="main-search">
          <?php //include ('wp-content/themes/remix/inc/search.html'); ?>
        </div>
       <?php echo wp_nav_menu ( array("menu" => 'secondary') ); ?>
      </div>
    </div>
    
</div>
</header>

