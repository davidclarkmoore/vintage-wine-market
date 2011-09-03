<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
?>

<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">

<?php print $picture ?>

<?php if ($page == 0): ?>
  <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
<?php endif; ?>

  <?php if ($submitted): ?>
    <span class="submitted"><?php print $submitted; ?></span>
  <?php endif; ?>

  <div class="content clear-block">
		<div class = "job_table">
			<?php 
				$job_category = db_fetch_array(db_query('SELECT name, td.tid FROM term_node as tn LEFT JOIN term_data as td on tn.tid = td.tid WHERE nid = '.$node->nid.' AND td.vid = 5 LIMIT 0, 1'));
				$job_category = i18ntaxonomy_translate_term_name($job_category['tid'], $job_category['name']);
				$job_division = db_fetch_array(db_query('SELECT name, td.tid FROM term_node as tn LEFT JOIN term_data as td on tn.tid = td.tid WHERE nid = '.$node->nid.' AND td.vid = 4 LIMIT 0, 1'));
				$job_division = i18ntaxonomy_translate_term_name($job_division['tid'], $job_division['name']);
			?>
			<table>
        <tr><td colspan="2"><?php print ' &larr; ' . multilink_filter('process', 0, 3, '[528:'.t('back to jobs').']'); ?></td></tr>
				<tr><td><h3><?php print $node->content['field_job_reqnumb']['field']['#title']?></h3></td><td><?php print $node->field_job_reqnumb[0]['view'] ?></td></tr>
				<tr><td><h3><?php print t('Job Category'); ?></h3></td><td><?php print $job_category; ?></td></tr>
				<tr><td><h3><?php print $node->content['field_job_postdate']['field']['#title']?></h3></td><td><?php print $node->field_job_postdate[0]['view'] ?></td></tr>
				<tr><td><h3><?php print $node->content['field_job_expiredate']['field']['#title']?></h3></td><td><?php print $node->field_job_expiredate[0]['view'] ?></td></tr>
				<tr><td><h3><?php print $node->content['field_job_type']['field']['#title']?></h3></td><td><?php print $node->field_job_type[0]['view'] ?></td></tr>
				<tr><td><h3>Division</h3></td><td><?php print $job_division ?></td></tr>
				<tr><td><h3><?php print $node->content['field_job_location']['field']['#title']?></h3></td><td><?php print $node->field_job_location[0]['view'] ?></td></tr>
			</table>
		</div>
		<div class = "job_actions">
			<?php if($node->field_hide_apply[0]['value'] != 'yes' ) { ?>
			  <span class="button_all"><span><a class="job_action" href=<?php print ('"/'.$node->language.'/job-seeker/apply/'.$node->nid.'">'.t('Apply Now')); ?></a></span></span>
			<?php } ?>
		</div>
		<div class = "job_description">
			<h3><?php print t($node->content['#content_extra_fields']['body_field']['label']); ?></h3>
			<?php print $node->content['body']['#value'] ; ?>
			<?php if($node->field_hide_apply[0]['value'] != 'yes') { ?>
			  <span class="button_all"><span><a class="job_action" href=<?php print ('"/'.$node->language.'/job-seeker/apply/'.$node->nid.'">'.t('Apply Now')); ?></a></span></span>
      <?php } ?>
		</div>
  </div>
</div>
<?php 
$ip_address = $_SERVER["REMOTE_ADDR"] ;
$result = db_result(db_query('SELECT count_id FROM gfs_jobs_count WHERE nid = '.$node->nid.' AND ip_address = "'.$ip_address.'"' ));
if(!$result){
db_query("INSERT INTO {gfs_jobs_count} (nid, ip_address) VALUES ('%d', '%s')", $node->nid, $ip_address) ; 
}

?>

