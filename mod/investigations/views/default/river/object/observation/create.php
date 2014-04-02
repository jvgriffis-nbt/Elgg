<?php
/**
 * Observation river view
 */

$object = $vars['item']->getObjectEntity();
$excerpt = strip_tags($object->description);
$excerpt = investigation_filter($excerpt);

$observation = get_entity($vars['item']->object_guid);
$agg_id = $observation->getMetaData("agg_id");

// setup collaborators

$results = elgg_get_entities_from_relationship(array(
    relationship => "collaborators",
    relationship_guid => object_guid
));

foreach($results as $result) {
    //setup links
};

$subject = $vars['item']->getSubjectEntity();
$subject_link = elgg_view('output/url', array(
	'href' => $subject->getURL(),
	'text' => $subject->name,
	'class' => 'elgg-river-subject',
	'is_trusted' => true,
));

/* add observation link */
$object_link = elgg_view('output/url', array(
	'href' => "observation/".$agg_id,
	'text' => elgg_echo('investigations:observation'),
	'class' => 'elgg-river-object',
	'is_trusted' => true,
));

$summary = elgg_echo("river:create:object:observation_with", array($subject_link, $object_link, $collaborators));

echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'message' => $excerpt,
	'summary' => $summary,
));