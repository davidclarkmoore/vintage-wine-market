<?php
// $Id: page.tpl.php,v 1.1.2.1 2009/02/24 15:34:45 dvessel Exp $
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
  <head>
    <title><?php print $head_title; ?></title>
<!--[if IE 7]>
 <link rel="stylesheet" href="/sites/all/themes/gfscanada/ie7fix.css" type="text/css" media="screen" />
<![endif]-->
<!--[if IE 6]>
 <link rel="stylesheet" href="/sites/all/themes/gfscanada/ie6.css" type="text/css" media="screen" />
<![endif]-->

    <?php print $head; ?>
    <?php print $styles; ?>
    <?php print $scripts; ?>
    <script type="text/javascript" src="/sites/all/themes/gfscanada/js/global.js"></script>

<!--[if IE 6]>
 <link rel="stylesheet" href="/sites/all/themes/gfscanada/ie6.css" type="text/css" media="screen" />
 <script type="text/javascript" src="/sites/all/themes/gfscanada/js/iefix_png.js"></script>
 <script type="text/javascript" src="/sites/all/themes/gfscanada/js/iefix_classes.js"></script>
<![endif]-->
   <meta name="google-site-verification" content="MbLowmevdr67jafc4Dmlr3-45eyvwVQXiJ0KMBOMb1Q" />
   <meta name="msvalidate.01" content="086F6706324655BB6654C99AC5438933" />
   <META name="y_key" content="33e799d2c7a281b0" />
   <meta name="y_key" content="b46579c37cbb813e" />
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
    	    <?php if ($main_menu_links || $secondary_menu_links): ?>
          <div id="site-menu" class="">
            <?php print theme('nice_menus_primary_links', 'down', 1); ?>
            <?php print $secondary_menu_links; ?>
            <?php print locale('<a id="site_menu_homepage_link" href="/" class="iefix" title="Go to Homepage">GFS Canada</a>'); ?>
          </div>
          <?php endif; ?>
        </div>

      <?php if ($header): ?>
        <div id="header-region" class="region grid-16">
		       <?php print $header; ?>
		       <h1 id="front_header_welcome" class="iefix"><?php print locale('Welcome to GFS Canada') ?></h1>
        </div>
      <?php endif; ?>
      </div>

      <div class="grid-16 ie6_message" style="display: none;">
        <img src="/sites/all/themes/gfscanada/images/gfs-gordon-food-service.png" alt="Gordon Food Service Logo" />
        <h2>Welcome to GFS Canada!</h2>
        <p>Lorem ipsum <a href="#" title="">ordering</a></p>
        <p>
          This application requires some features your browser does not provide. Please use one of the following browsers:
        </p>
        <ul id='unsupported-browsers'>
          <li class='browser-ie8'>
            <a href='http://www.microsoft.com/windows/internet-explorer/default.aspx' title='Download this browser now'>Microsoft Internet Explorer 8</a>
          </li>
          <li class='browser-firefox'>
            <a href='http://www.mozilla.com/en-US/firefox/firefox.html' title='Download this browser now'>Mozilla Firefox</a>
          </li>
          <li class='browser-chrome'>
            <a href='http://www.google.com/chrome' title='Download this browser now'>Google Chrome</a>
          </li>
          <li class='browser-safari last'>
            <a href='http://www.apple.com/safari/' title='Download this browser now'>Apple Safari</a>
          </li>
        </ul>
        <p>
          If you are already using one of these browsers, please make sure you are using the latest version by checking for updates.
        </p>
      </div>

      <?php print $messages; ?>
      
      <div id="footer">
        <div id="footer-top-region-homepage" class="region grid-16 clear-block">
          <div class="homepage_callouts callout grid-16 alpha omega">
            <div id="callout_homepage_top_left_region">
              <?php print $callout_homepage_top_left; ?>
            </div>
            <div id="callout_homepage_bottom_left_region">
              <?php print $callout_homepage_bottom_left; ?>
            </div>
            <div id="callout_homepage_right_region">
              <?php print $callout_homepage_right; ?>
            </div>
          </div>
        </div>
    
        <div id="footer-region" class="region grid-16 clear-block">
          <?php print $footer; ?>
          <p class="copyright">&#169; <?php echo date('Y'); ?>  <?php print locale('GFS Canada Company, Inc. All Rights Reserved.'); ?></p>
          <?php print $footer_bottom; ?>
          <?php print locale('<a id="footer_us_homepage_link" href="http://www.gfs.com/" title="Go to GFS US"><img alt="Go to Gordon Food Service (US)." src="/sites/all/themes/gfscanada/images/GFSUSLogoImageChangeAsset.png"></img></a>'); ?>
          <br/>
        </div>
      </div>
    </div>

    <?php print $closure; ?>
  </body>
</html>