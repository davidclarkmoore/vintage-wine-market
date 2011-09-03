<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
?>
<?php global $language; ?>

<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">
<?php print $picture ?>

<?php if ($page == 0): ?>
  <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
<?php endif; ?>

  <?php if ($submitted): ?>
    <span class="submitted"><?php print $submitted; ?></span>
  <?php endif; ?>

  <div class="content clear-block">
    <?php print $content ?>
 	<?php if($language->language == 'fr'): ?>
 	  <iframe frameborder="0" height="512px" width="100%" src="/sites/all/themes/gfscanada/service-area-fr/service-areas.html" ></iframe> 	  
 	<?php else: ?>
 	  <iframe frameborder="0" height="512px" width="100%" src="/sites/all/themes/gfscanada/service-area/service-areas.html" ></iframe>
  <?php endif; ?>
  </div>
</div>
