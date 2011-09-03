<?php
// $Id: template.php,v 1.16.2.2 2009/08/10 11:32:54 goba Exp $

/**
* Registers overrides for various functions.
*
* In this case, overrides three user functions
*/

/*
 Override or insert variables into the node templates.
*
* @param $vars
*   An array of variables to pass to the theme template.
* @param $hook
*   The name of the template being rendered ("node" in this case.)
*/
function phptemplate_preprocess_node(&$vars, $hook) {
  $node = $vars['node'];
  $node_id = ($node->tnid > 0) ? $node->tnid : $node->nid;
  $vars['template_file'] = 'node-'. $node_id;
  
  if(in_supplier_portal()) {
    $node_type = $vars['node']->type;
    if(strpos($node_type, "supplier_page") == 0) {
      $vars['template_files'][] = 'node-'. str_replace("supplier_page", "page", $node_type);
    }      
  }
}

function get_base_node_path_alias() {
  $base_path_alias = '';
  $url_array = explode('/', $_GET['q']);
  if($url_array && (count($url_array) > 1) && (strcmp($url_array[0], 'node') == 0) && is_numeric($url_array[1])) {
    $base_node = node_load($url_array[1]);
    
    $base_node_id = $base_node->nid;
    if($base_node->tnid != 0) {
      $base_node_id = $base_node->tnid;
    }
    
    $base_path_alias = explode('/', drupal_get_path_alias('node/'.$base_node_id));
  }
  
  return $base_path_alias;
}

function phptemplate_preprocess_page(&$vars, $hook) {
  $path = explode('/', drupal_get_path_alias($_GET['q']));
  if (strcmp($path[0], 'supplier') == 0) {
    $vars['template_files'][] = 'page-supplier';
  }
}

function gfscanada_preprocess_search_block_form(&$vars, $hook) {
  // Modify elements of the search form
  $vars['form']['search_block_form']['#title'] = t('Site Search');

  // Set a default value for text inside the search box field.
  $vars['form']['search_block_form']['#value'] = locale('Enter Keywords');

  // Change the text on the submit button
  $vars['form']['submit']['#value'] = locale('GO');
  
  // Rebuild the rendered version (search form only, rest remains unchanged)
  unset($vars['form']['search_block_form']['#printed']);
  unset($vars['form']['submit']['#printed']);
  $vars['search']['search_block_form'] = drupal_render($vars['form']['search_block_form']);
  $vars['search']['submit'] = drupal_render($vars['form']['submit']);

  // Collect all form elements to make it easier to print the whole form.
  $vars['search_form'] = implode($vars['search']);
}

// Override theme_button
function phptemplate_button($element) {
  // Make sure not to overwrite classes.
  if (isset($element['#attributes']['class'])) {
    $element['#attributes']['class'] = 'form-'. $element['#button_type'] .' '. $element['#attributes']['class'];
  }
  else {
    $element['#attributes']['class'] = 'form-'. $element['#button_type'];
  }
  // We here wrap the output with a couple span tags
  return '<span class="button_all"><span><input type="submit" '. (empty($element['#name']) ? '' : 'name="'. $element['#name'] .'" ')  .'id="'. $element['#id'].'" value="'. check_plain($element['#value']) .'" '. drupal_attributes($element['#attributes']) ." /></span></span>\n";
}
function gfscanada_date_all_day_label() {
  return '';
}

function in_supplier_portal() {
  $path = explode('/', drupal_get_path_alias($_GET['q']));
  return (strcmp($path[0], 'supplier') == 0);
}

function get_link_href($link_url) {
  return (preg_match("/^http/", $link_url) > 0 ? "" : "/") . $link_url;
}

function load_page_exhibit_from_node_id($node_id, $use_small_image = false) {
  $exhibit_node = node_load( array("nid" => $node_id));
  return get_exhibit_html($exhibit_node, $use_small_image);
}

function get_exhibit_html($exhibit_node, $use_small_image = false) {
  return theme_render_template('/sites/all/themes/gfscanada/exhibit_partial.tpl.php', array('exhibit_node' => $exhibit_node, 'use_small_image' => $use_small_image));
}

/**
* Default theme function for all filter forms.
*/
function gfscanada_preprocess_views_exposed_form(&$vars) {
  $form = &$vars['form'];

  foreach ($form['#info'] as $id => $info) {
    $widget = new stdClass;
    // set up defaults so that there's always something there.
    $widget->label = $widget->operator = $widget->widget = NULL;

    $widget->id = $form[$info['value']]['#id'];
    if (!empty($info['label'])) {
      $widget->label = $info['label'];
    }
    if (!empty($info['operator'])) {
      $widget->operator = drupal_render($form[$info['operator']]);
    }
    // here's where you replace the terms with translated terms
    $options = array();
    if($form[$info['value']]['#options']) {
      
      foreach($form[$info['value']]['#options'] as $key=>$option) {
        if(strcmp('All', $key) == 0) {
          $options[$key]= t($option);                
        } else {
          $options[$key]= tt('taxonomy:term:'. $key .':name', $option);
        }
      }
    }
    unset($form[$info['value']]['#printed']);
    $form[$info['value']]['#options'] = $options;

    //end modification
    $widget->widget = drupal_render($form[$info['value']]);
    $vars['widgets'][$id] = $widget;
  }

}