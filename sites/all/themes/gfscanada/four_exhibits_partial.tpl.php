<div class="exhibit-holder alpha grid-9 omega">	
  <div class="first exhibit">
    <div class="exhibit-count-4">
      <?php print load_page_exhibit_from_node_id($node_with_four_exhibits->field_exhibit_one[0]['nid'], true); ?>
    </div>
  </div>
  
  <div class="exhibit">
    <div class="exhibit-count-4">
      <?php print load_page_exhibit_from_node_id($node_with_four_exhibits->field_exhibit_two[0]['nid'], true); ?>
    </div>
  </div>
  
  <div class="exhibit">
    <div class="exhibit-count-4">
      <?php print load_page_exhibit_from_node_id($node_with_four_exhibits->field_exhibit_three[0]['nid'], true); ?>
    </div>
  </div>
  
  <div class="last exhibit">
    <div class="exhibit-count-4">
      <?php print load_page_exhibit_from_node_id($node_with_four_exhibits->field_exhibit_four[0]['nid'], true); ?>
    </div>
  </div>
</div>