<?php if($exhibit_node): ?>

  <?php
    $lang_neg = variable_get('language_negotiation', '');

    $link_url = $exhibit_node->field_exhibit_link[0]['url'];

    if(preg_match("/sites\/default\/files/", $link_url) > 0) {
      variable_set('language_negotiation', LANGUAGE_NEGOTIATION_NONE);
    }

    $link_href = url($link_url);
    $url_target = ((strcmp($exhibit_node->field_open_new_window[0]['value'], 'true') == 0) ? '_blank' : '');
    variable_set('language_negotiation', $lang_neg);
  ?>

  <div class="drop-shadow">
    <div class="drop-shadow-outer">
      <div class="drop-shadow-inner">
      <?php if($exhibit_node->field_exhibit_link[0]['url']): ?>
        <a href="<?php print $link_href; ?>" target="<?php print $url_target; ?>">
      <?php endif; ?>
        <?php if($use_small_image): ?>
          <img class="exhibit_image" src="/sites/default/files/imagecache/small_exhibit_image/<?php print $exhibit_node->field_exhibit_image[0]['filename']; ?>" alt="<?php print $exhibit_node->field_exhibit_image[0]['data']['alt']; ?>" title="<?php print $exhibit_node->field_exhibit_image[0]['data']['title'] ?>" />
        <?php else: ?>
          <img class="exhibit_image" src="/sites/default/files/imagecache/large_exhibit_image/<?php print $exhibit_node->field_exhibit_image[0]['filename']; ?>" alt="<?php print $exhibit_node->field_exhibit_image[0]['data']['alt']; ?>" title="<?php print $exhibit_node->field_exhibit_image[0]['data']['title'] ?>" />
        <?php endif; ?>
      <?php if($exhibit_node->field_exhibit_link[0]['url']): ?>
        </a>
      <?php endif; ?>
      </div>
    </div>
  </div>
  <h3>
  <?php if($exhibit_node->field_exhibit_link[0]['url']): ?>
    <a href="<?php print $link_href; ?>" target="<?php print $url_target; ?>">
  <?php endif; ?>
      <?php print $exhibit_node->title; ?>
  <?php if($exhibit_node->field_exhibit_link[0]['url']): ?>
    </a>
  <?php endif; ?>
  </h3>
  <?php print multilink_filter('process', 0, 3, $exhibit_node->body); ?>
  <?php if($exhibit_node->field_exhibit_link[0]['url']): ?>
    <a href="<?php print $link_href; ?>" class="indent" target="<?php print $url_target; ?>">
  <?php endif; ?>
    <?php print $exhibit_node->field_exhibit_link[0]['title']; ?>
  <?php if($exhibit_node->field_exhibit_link[0]['url']): ?>
    </a>
  <?php endif; ?>
<?php endif; ?>
