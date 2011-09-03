<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
?>

<div class="grid-7 alpha omega menu-body">

<h1><?php print ($title) ?></h1>

<?php print render($content['body']); ?> 

<?php

$block = block_load('user', 'login');     
$output = drupal_render(_block_get_renderable_array(_block_render_blocks(array($block))));       
print $output;
?>

</div>


 