<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">
    <div id="brand_main_content" class="alpha grid-9">
      <?php print $picture ?>

      <?php if ($page == 0): ?>
        <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
      <?php endif; ?>
      <div class="alpha grid-5" style="float: left;">
        <div class="drop-shadow">
          <div class="drop-shadow-outer">
            <div class="drop-shadow-inner">
              <img class="brand_main_image" src="/sites/default/files/imagecache/brand_main_image/<?php print $node->field_main_image[0]['filename']; ?>" alt="<?php print $node->field_main_image[0]['data']['alt']; ?>" title="<?php print $node->field_main_image[0]['data']['title'] ?>" />
            </div>
          </div>
        </div>
      </div>
 
      <div class=""  style="">
        <div class="field-items">
          <div class="field-item">
            <img class="brand_logo_image" src="/sites/default/files/imagecache/brand_logo_image/<?php print $node->field_logo[0]['filename']; ?>" alt="<?php print $node->field_logo[0]['data']['alt']; ?>" title="<?php print $node->field_logo[0]['data']['title'] ?>" />
          </div>
        </div>
      
        <div class="field-items">
          <div class="alpha grid-4 field-item" style="float: left; text-align: center; font-weight: bold; padding-bottom: 10px;"><?php print $node->field_tagline[0]['view'] ?></div>
        </div>
      
        <?php print $node->content['body']['#value']; ?>
      </div>
      
      <?php print theme_render_template('/sites/all/themes/gfscanada/two_exhibits_partial.tpl.php', array('node_with_two_exhibits' => $node)); ?>
  </div>

</div>