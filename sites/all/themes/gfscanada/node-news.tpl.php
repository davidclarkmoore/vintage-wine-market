<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">
  <?php print $picture ?>

<?php if ($page == 0): ?>
  <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
<?php endif; ?>

  <?php print theme_render_template('/sites/all/themes/gfscanada/news_and_events_partial.tpl.php', array('node' => $node, 'taxonomy' => $taxonomy, 'terms' => $terms)); ?>

</div>