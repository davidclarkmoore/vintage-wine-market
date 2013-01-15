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

<div class="reservations_widget_box">
<script type="text/javascript" src="http://www.opentable.com/frontdoor/default.aspx?rid=51451&restref=51451&bgcolor=F6F6F3&titlecolor=0F0F0F&subtitlecolor=0F0F0F&btnbgimage=http://www.opentable.com/frontdoor/img/ot_btn_red.png&otlink=FFFFFF&icon=dark&mode=tall&hover=1"></script><a href="http://www.opentable.com/vintage-enoteca-reservations-los-angeles?rtype=ism&restref=51451" class="OT_ExtLink">Vintage Enoteca Reservations</a>
</div>
</div>

<?php if ($messages): ?>
<div id="messages">
      <?php print $messages; ?>
</div> <!-- /.section, /#messages --> 
  <?php endif; ?>


 <div class="container-12">
 
 
 <?php print render($tabs); ?>
<h1><?php print $title; ?></h1>

<?php print render($page['content']); ?>

</div

<div id="sub_node_box">
<div class="container-12">
<div class="grid-12 alpha omega">
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