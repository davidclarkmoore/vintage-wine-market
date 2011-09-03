<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">
   <div class="alpha grid-9 omega">
  <?php print $picture ?>

  <?php if ($page == 0): ?>
    <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
  <?php endif; ?>

  <?php print $node->content['body']['#value']; ?>
    <div id="product_main_image">
      <div class="drop-shadow">
        <div class="drop-shadow-outer">
          <div class="drop-shadow-inner">
            <img class="main_image" src="/sites/default/files/imagecache/product_main_image/<?php print $node->field_product_main_image[0]['filename']; ?>" alt="<?php print $node->field_product_main_image[0]['data']['alt']; ?>" title="<?php print $node->field_product_main_image[0]['data']['title'] ?>" />
          </div>
        </div>
      </div>
    </div>
 
  <?php for($i=0; $i < count($node->field_subcategory_title); $i ++): ?>
    <div class="subcategory_item">
      <div><b><?php print $node->field_subcategory_title[$i]['value'] ?></b></div>
      <?php print $node->field_subcategory_description[$i]['value'] ?>
    </div>
  <?php endfor; ?>
   
    <?php print theme_render_template('/sites/all/themes/gfscanada/two_exhibits_partial.tpl.php', array('node_with_two_exhibits' => $node)); ?>

  </div>
</div>