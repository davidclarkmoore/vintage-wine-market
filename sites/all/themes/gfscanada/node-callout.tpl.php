<div class="callout_main_content alpha grid-5">
  <?php $raw_url = $node->field_callout_link[0]['url']; ?>
  <?php $link_href = url($raw_url); ?>
  <div class="callout-bottom-shadow iefix">
    <span class="callout-side-shadow">
      <?php if($raw_url): ?>
        <a href="<?php print $link_href; ?>">
      <?php endif; ?>
        <img class="callout_image" src="/sites/default/files/imagecache/small_exhibit_image/<?php print $node->field_callout_image[0]['filename']; ?>" alt="<?php print $node->field_callout_image[0]['data']['alt']; ?>" title="<?php print $node->field_callout_image[0]['data']['title'] ?>" />
      <?php if($raw_url): ?>
        </a>
      <?php endif; ?>
    </span>
  </div>
    
  <?php if($raw_url): ?>
  <a class="callout_title_link" href="<?php print $link_href; ?>">
  <?php endif; ?>
    <div class="callout_title">
      <?php print check_plain($node->title); ?>
    </div>
  <?php if($raw_url): ?>
  </a>
  <?php endif; ?>

  <div class="callout_body">
    <?php print $node->content['body']['#value']; ?>
  </div>


</div>
<div class="grid-4 omega">
</div>

