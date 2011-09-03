<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">

<?php print $picture ?>

<?php if ($page == 0): ?>
  <h1><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h1>
<?php endif; ?>

  <div class="alpha grid-9 omega">
    <div class="division_section">
      <div id="division_main_image">
        <div class="drop-shadow">
          <div class="drop-shadow-outer">
            <div class="drop-shadow-inner">
              <img class="main_image" src="/sites/default/files/imagecache/product_main_image/<?php print $node->field_division_main_image[0]['filename']; ?>" alt="<?php print $node->field_division_main_image[0]['data']['alt']; ?>" title="<?php print $node->field_division_main_image[0]['data']['title'] ?>" />
            </div>
          </div>
        </div>
      </div>
      <?php if ($title): ?>
        <h1 class="title" id="division-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print $node->content['body']['#value']; ?>
    </div>
    
    <?php if($node->field_services[0]['view']): ?>
    <div class="division_section">
      <h2 class="field-label"><?php print t('Services'); ?></h2>
      <div class="field-item"><?php print $node->field_services[0]['view'] ?></div>
    </div>
    <?php endif; ?>

    <?php if($node->field_product_offering_body[0]['view'] || ($node->field_product_offering_item_titl && $node->field_product_offering_item_titl[0]['value'])): ?>
      <div class="division_section">
        <h2 class="field-label"><?php print t('Product Offerings'); ?></h2>
        <?php print $node->field_product_offering_body[0]['view'] ?>

        <?php for($i=0; $i < count($node->field_product_offering_item_titl); $i ++): ?>
          <?php if($node->field_product_offering_item_titl[$i]['value']): ?>
            <div class="division_item">
              <div class="division_item_image">
                  <div class="drop-shadow">
                    <div class="drop-shadow-outer">
                      <div class="drop-shadow-inner">
                        <?php $should_link_image = ($node->field_product_offering_link[$i]['url'] && 
                                                    !($node->field_product_offering_link_2[$i]['url'] || 
                                                    $node->field_product_offering_link_3[$i]['url'])) ?>
                      <?php if($should_link_image): ?>
                        <a target="_blank" href="<?php print get_link_href($node->field_product_offering_link[$i]['url']); ?>">
                      <?php endif; ?>
                        <img src="/sites/default/files/imagecache/division_link_image/<?php print $node->field_product_offering_item_img[$i]['filename']; ?>" alt="<?php print $node->field_product_offering_item_img[$i]['data']['alt']; ?>" title="<?php print $node->field_product_offering_item_img[$i]['data']['title'] ?>" />
                      <?php if($should_link_image): ?>
                        </a>
                      <?php endif; ?>
                      </div>
                    </div>
                  </div>
              </div>
              <h3><?php print $node->field_product_offering_item_titl[$i]['value']; ?></h3>
              <?php print $node->field_product_offering_item_desc[$i]['value'] ?>
              &nbsp;<a target="_blank" href="<?php print get_link_href($node->field_product_offering_link[$i]['url']); ?>"><?php print $node->field_product_offering_link[$i]['title']; ?></a>.
               <?php if($node->field_product_offering_link_2[$i]['url']): ?>
                &nbsp;<a target="_blank" href="<?php print get_link_href($node->field_product_offering_link_2[$i]['url']); ?>"><?php print $node->field_product_offering_link_2[$i]['title']; ?></a>.
                <?php endif; ?>
                <?php if($node->field_product_offering_link_3[$i]['url']): ?>
                &nbsp;<a target="_blank" href="<?php print get_link_href($node->field_product_offering_link_3[$i]['url']); ?>"><?php print $node->field_product_offering_link_3[$i]['title']; ?></a>.
              <?php endif; ?>
            </div>
          <?php endif; ?>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
 
    <?php if($node->field_publication_description[0]['view'] || ($node->field_publication_item_title && $node->field_publication_item_title[0]['value'])): ?>
     <div class="division_section">
       <h2 class="field-label"><?php print t('Publications'); ?></h2>
       <?php print $node->field_publication_description[0]['view'] ?>

       <?php for($i=0; $i < count($node->field_publication_item_title); $i ++): ?>
         <?php if($node->field_publication_item_title[$i]['value']): ?>
           <div class="division_item">
             <div class="division_item_image">
                 <div class="drop-shadow">
                   <div class="drop-shadow-outer">
                     <div class="drop-shadow-inner">
                       <?php $should_link_image = ($node->field_publication_item_link[$i]['url'] && 
                                                   !($node->field_publication_item_link_2[$i]['url'] || 
                                                   $node->field_publication_item_link_3[$i]['url'])) ?>
                   <?php if($should_link_image): ?>
                     <a target="_blank" href="<?php print get_link_href($node->field_publication_item_link[$i]['url']); ?>">
                   <?php endif; ?>
                       <img src="/sites/default/files/imagecache/division_link_image/<?php print $node->field_publication_item_image[$i]['filename']; ?>" alt="<?php print $node->field_publication_item_image[$i]['data']['alt']; ?>" title="<?php print $node->field_publication_item_image[$i]['data']['title'] ?>" />
                   <?php if($should_link_image): ?>
                     </a>
                   <?php endif; ?>
                     </div>
                   </div>
                 </div>
             </div>
             <h3><?php print $node->field_publication_item_title[$i]['value'] ?></h3>
             <?php print $node->field_publication_item_desc[$i]['value'] ?>
             &nbsp;<a target="_blank" href="<?php print get_link_href($node->field_publication_item_link[$i]['url']); ?>"><?php print $node->field_publication_item_link[$i]['title']; ?></a>.
             <?php if($node->field_publication_item_link_2[$i]['url']): ?>
             &nbsp;<a target="_blank" href="<?php print get_link_href($node->field_publication_item_link_2[$i]['url']); ?>"><?php print $node->field_publication_item_link_2[$i]['title']; ?></a>.
             <?php endif; ?>
             <?php if($node->field_publication_item_link_3[$i]['url']): ?>
             &nbsp;<a target="_blank" href="<?php print get_link_href($node->field_publication_item_link_3[$i]['url']); ?>"><?php print $node->field_publication_item_link_3[$i]['title']; ?></a>.
           <?php endif; ?>
           </div>
         <?php endif; ?>
       <?php endfor; ?>
     </div>
   <?php endif; ?>

    <?php if($node->field_online_ordering_link[0]['view']): ?>
      <div class="division_section">
        <h2 class="field-label">Online Ordering</h2>
        <div class="field-item"><?php print $node->field_online_ordering_link[0]['view'] ?></div>
      </div>
    <?php endif; ?>

    <?php if($node->field_careers[0]['view']): ?>
    <div class="division_section">
      <h2 class="field-label">Careers</h2>
      <div class="field-item"><?php print $node->field_careers[0]['view'] ?></div>
    </div>
    <?php endif; ?>
    
    <?php if($node->field_contact_division[0]['view']): ?>
    <div class="division_section">
      <h2 class="field-label"><?php print t('Contact Division'); ?></h2>
      <div class="field-item"><?php print $node->field_contact_division[0]['view'] ?></div>
    </div>
    <?php endif; ?>
 
    <?php print theme_render_template('/sites/all/themes/gfscanada/two_exhibits_partial.tpl.php', array('node_with_two_exhibits' => $node)); ?>
  </div>
</div>