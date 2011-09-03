<div class="posted">
<?php print t('posted ') . format_date($node->created, 'custom', variable_get('date_format_gfs_date', '')); ?>
<?php 
  // Get the term for type of news or event
  foreach (taxonomy_node_get_terms_by_vocabulary($node, 3) as $term) {
    print " | ".i18ntaxonomy_translate_term_name($term->tid, $term->name);
  }
?>
</div>

<?php if($node->field_news_image[0]['filename']): ?>
<div id="news_main_image">
  <div class="drop-shadow">
    <div class="drop-shadow-outer">
      <div class="drop-shadow-inner">
        <img class="main_image" src="/sites/default/files/imagecache/news_event_main/<?php print $node->field_news_image[0]['filename']; ?>" alt="<?php print $node->field_news_image[0]['data']['alt']; ?>" title="<?php print $node->field_news_image[0]['data']['title'] ?>" />
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<?php print $node->content['body']['#value']; ?>

<?php print multilink_filter('process', 0, 3, "[529:".locale('Back to News and Events')." »]"); ?>