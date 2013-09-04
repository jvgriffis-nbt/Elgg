<?php
/**
 * WeatherBlur User Obs Widget
 */
 
 
 
 //BIG TODO--need to figure out pagination, right now its going to list all the obs in a column
 
$num = $vars['entity']->num_display;



$content = elgg_get_entities(array(
        'type_subtype_pair'	=>	array('object' => 'observation'),
		'limit' => $num,
        'owner_guid' => $vars['entity']->owner_guid,
		'pagination' => TRUE
    ));

$list = '';
if (is_array($content) && count($content) > 0) {
?>
<ul class="obs-listing">
<?php foreach ($content as $item) 
{ ?>
	<li class="obs">
    <div class="obs_container">
        <a href="<?php echo elgg_get_site_url(); ?>observation/<?php echo $item->get("agg_id"); ?>">
            <img class="obs_image" src='<?php echo elgg_get_site_url(); ?>_graphics/wb-small-data-icons.png'>
			<p class="obs_inv">For <?php print wbuserobs_get_my_inv($item->get("agg_id")); ?></p>
            <p class="obs_date">On <?php echo date('F nS, Y g:i:s A', $item->get('time_created') + (3600 * (1 - date('I', $item->time_created)))); ?></p>
        </a>
    </div>
</li>
<?php
	print elgg_view('observations/list_item', array('entity'=>$item)); 
} ?>
</ul>
<?php print $nav;
}
if ($content) {

} else {
	echo "No Observations";
}
