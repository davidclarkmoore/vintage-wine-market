<?php
function views_exp_views_query_alter(&$view, &$query) {
  if(strpos($query->orderby[0]['field'], 'wine_glass_price') !== false) {
    $field = $query->orderby[0]['field'];
    array_unshift($query->orderby, array(
      'field' => "ISNULL($field)",
      'direction' => 'ASC',
    ));
  }
}
?>