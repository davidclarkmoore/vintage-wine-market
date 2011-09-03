<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
?>

<div class="grid6">

<p>test node tpl</p>
 <?php if ($page['userlogin']): ?>
      <?php print render($page['userlogin']); ?>
  <?php endif; ?>
  
  </div>

