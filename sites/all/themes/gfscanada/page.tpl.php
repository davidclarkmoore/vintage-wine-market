<?php
// $Id: page.tpl.php,v 1.1.2.1 2009/02/24 15:34:45 dvessel Exp $
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <title><?php print $head_title; ?></title>

  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
<!--[if IE 8]>
 <link rel="stylesheet" href="/sites/all/themes/gfscanada/ie8.css" type="text/css" media="screen" />
<![endif]-->
<!--[if IE 7]>
 <link rel="stylesheet" href="/sites/all/themes/gfscanada/ie7fix.css" type="text/css" media="screen" />
<![endif]-->
<!--[if IE 6]>
 <link rel="stylesheet" href="/sites/all/themes/gfscanada/ie6.css" type="text/css" media="screen" />
 <script type="text/javascript" src="/sites/all/themes/gfscanada/js/iefix_png.js"></script>
 <script type="text/javascript" src="/sites/all/themes/gfscanada/js/iefix_classes.js"></script>
<![endif]-->
  <script type="text/javascript" src="/sites/all/themes/gfscanada/js/global.js"></script>
</head>

<body class="<?php print $body_classes; ?>">
  <div id="page" class="container-16 clear-block">

    <div id="site-header" class="clear-block">
      <div id="top-part-of-header" class="grid-16 clear-block">
        <div id="branding" class="">
          <?php print locale('<a href="/" title="Go to Homepage"><span></span><abbr title="Gordon Food Service">GFS</abbr>&mdash;Gordon Food Service</a>'); ?>
        </div>
        <div id="site-header-search" class="">
          <?php print $header_search; ?>
        </div>
        <div id="site-header-nav" class="">
          <?php print $header_top_nav; ?>
        </div>
        <div id="site-header-order-online" class="">
          <?php print $header_top_order_online; ?>
        </div>
        <div id="site-header-language" class="">
          <?php print $header_top_language; ?>
        </div>
        <div id="site-menu" class="">
          <?php print theme('nice_menus_primary_links', 'down', 1); ?>
          <?php print locale('<a id="site_menu_homepage_link" class="iefix" href="/" title="Go to Homepage">GFS Canada</a>'); ?>
        </div>
      </div>

    <?php if ($header): ?>
      <div id="header-region" class="region grid-16">
        <?php print $header; ?>
      </div>
    <?php endif; ?>
    </div>

    
    <div id="three-column-container" class="grid-16">
      <?php if ($left): ?>
      <div id="sidebar-left" class="column sidebar region alpha grid-3 omega">
        <?php print $left; ?>
      </div>
      <?php endif; ?>
  
      <?php if($left && $right) {        
        $main_sidebar_adjust_outer = "";  
        $main_sidebar_adjust_inner = "";
      }
      elseif ($left) {
        $main_sidebar_adjust_outer = "omega";
        $main_sidebar_adjust_inner = "container-padding-right";
      } 
      elseif ($right) {
        $main_sidebar_adjust_outer = "alpha";  
        $main_sidebar_adjust_inner = "container-padding-left";
      } 
      else {
        $main_sidebar_adjust_outer = "alpha omega";  
        $main_sidebar_adjust_inner = "container-padding-left container-padding-right";
      } ?>
      
      <div id="main" class="column <?php print ns('grid-16', $left, 3, $right, 4) . ' ' . $main_sidebar_adjust_outer ?>">
        <div id="main-inner" class="<?php print $main_sidebar_adjust_inner ?>" >
        <?php if ($tabs): ?>
			<?php 
				$path = explode('/', drupal_get_path_alias($_GET['q']));
				if($path[0] != 'job-seeker'){ ?>
          <div class="tabs"><?php print $tabs; ?></div>
			<?php } ?>
        <?php endif; ?>
        <?php print $messages; ?>
        <?php print $help; ?>
  		    <div class="content_top">
    		    <?php print $breadcrumb; ?>
    			  <?php if($printer_friendly){ print '<div class="printer_friendly" >'.$printer_friendly.'</div>' ;} ?>
  		    </div>
          <div id="main-content" class="region clear-block">
            <?php if ($title): ?>
              <h1 class="title" id="page-title"><?php print $title; ?></h1>
            <?php endif; ?>
        
            <?php print $content; ?>
          </div>

          <?php print $feed_icons; ?>
        </div>
      </div>


    <?php if ($right): ?>
    <div id="sidebar-right" class="column alpha sidebar region grid-4 omega">
      <?php print $right; ?>
    </div>
    <?php endif; ?>
  </div>

     <div id="footer" class="subpage-footer">
        <div id="footer-top-region" class="region grid-16 clear-block">
          <div class="standard-cross-sells-wrap-outer iefix">
            <div class="standard-cross-sells-wrap-inner iefix">
              <div class="standard-cross-sells callout iefix">
                <div id="callout_left_region">
                  <?php print $callout_left; ?>
                </div>
                <div id="callout_middle_region">
                  <?php print $callout_middle; ?>
                </div>
                <div id="callout_right_region">
                  <?php print $callout_right; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
    
        <div id="footer-region" class="region grid-16 clear-block">
          <?php print $footer; ?>
          <?php print locale('<a id="footer_us_homepage_link" href="http://www.gfs.com/" title="Go to GFS US"><img alt="Go to Gordon Food Service (US)." src="/sites/all/themes/gfscanada/images/GFSUSLogoImageChangeAsset.png"></img></a>'); ?>
          <p class="copyright">&#169; <?php echo date('Y'); ?>  <?php print locale('GFS Canada Company, Inc. All Rights Reserved.'); ?></p>
          <?php print $footer_bottom; ?>
        </div>
        <div style="clear: both"></div>
    </div>
  <?php print $closure; ?>
</body>
</html>