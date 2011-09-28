<?php
?>

<body onload="initialize()">


<div id="sitecontainer">


<div id="header">

<div id="vintagelogo">
     <a href="/" title="Go to Homepage"><span></span></a>

</div>
 

<div id="navigation">
    <?php if ($main_menu): ?>
      <div id="main-menu" class="navigation">
        <?php print theme('links__system_main_menu', array(
          'links' => $main_menu,
          'attributes' => array(
            'id' => 'main-menu-links',
            'class' => array('links'),
          ),
          'heading' => array(
            'text' => t('Main menu'),
            'level' => 'h2',
            'class' => array('element-invisible'),
          ),
        )); ?>
      </div> <!-- /#main-menu -->
    <?php endif; ?>
</div>

</div>

<?php if ($messages): ?>
<div id="messages">
      <?php print $messages; ?>
</div> <!-- /.section, /#messages --> 
  <?php endif; ?>


 <div class="container-12">
 <div class="grid-7 node-body alpha">
 
 <?php print render($tabs); ?>

<?php print render($page['content']); ?>

</div>
 <div class="grid-5 page_slider">
  
   <?php if ($page['page_rotator']): ?>
      <?php print render($page['page_rotator']); ?>
  <?php endif; ?>
  
   </div> 
      <?php if ($page['wine_list']): ?>
         <div class="grid-12 alpha omega wine-list">
      <?php print render($page['wine_list']); ?>
       </div>
  <?php endif; ?>

   <?php if ($page['menu_left']): ?>
   <div class="grid-6 alpha menu-list">
      <?php print render($page['menu_left']); ?>
      </div>
  <?php endif; ?>

   <?php if ($page['menu_right']): ?>
   <div class="grid-6 omega menu-list">
      <?php print render($page['menu_right']); ?>
      </div>
  <?php endif; ?>
  
  

   <?php if ($page['day_menu_left']): ?>
     <div class="grid-12 alpha omega menu-divider"></div>
   <div class="grid-6 alpha breakfast">
      <?php print render($page['day_menu_left']); ?>
      </div>
  <?php endif; ?>
  
    <?php if ($page['day_menu_right']): ?>
   <div class="grid-6 omega brunch">
      <?php print render($page['day_menu_right']); ?>
      </div>
  <?php endif; ?>
  

</div>

<div class="grid-12"
</div>

<div id="sub_node_box">
<div class="container-12">
<div class="grid-12">
<div class="grid-6 alpha specials">
 
  <div class="block_titles"><h1>specials</h1></div>
     <?php if ($page['specials']): ?>
      <?php print render($page['specials']); ?>
  <?php endif; ?>
  
 </div>
 
 <div class="grid-6 omega upcoming">
 
	<div class="block_titles"><h1>upcoming</h1></div>
   <?php if ($page['upcoming_events']): ?>
      <?php print render($page['upcoming_events']); ?>
  <?php endif; ?>
  
 </div>
 
</div>
 
 </div>
  </div>

 
<div class="footer">

<div class="container-12">

<div class="grid-12">
 
 <div class="grid-4 alpha"> 
 
 <?php if ($page['footer_firstcolumn']): ?>
      <?php print render($page['footer_firstcolumn']); ?>
  <?php endif; ?>
  
  </div>
 <div class="grid-4"> 

 <?php if ($page['footer_secondcolumn']): ?>
      <?php print render($page['footer_secondcolumn']); ?>
  <?php endif; ?>
  
  </div>
  <div class="grid-4 omega"> 
  
  <?php if ($page['footer_thirdcolumn']): ?>
      <?php print render($page['footer_thirdcolumn']); ?>
  <?php endif; ?>
  
  
 </div></div>

</div>

</body>
</html>