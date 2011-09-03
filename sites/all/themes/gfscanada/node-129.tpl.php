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
    
    <?php print views_embed_view('product_category','page_1'); ?>
 
    <?php print theme_render_template('/sites/all/themes/gfscanada/two_exhibits_partial.tpl.php', array('node_with_two_exhibits' => $node)); ?>
  </div>
</div>