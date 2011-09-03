<?php
/**
* Override or insert variables into the node templates.
*
* @param $vars
*   An array of variables to pass to the theme template.
* @param $hook
*   The name of the template being rendered ("node" in this case.)
*/
function Vintage2_preprocess_node(&$vars, $hook) {
  $node = $vars['node'];
  $vars['template_file'] = 'node-'. $node->nid;
}
     


?>