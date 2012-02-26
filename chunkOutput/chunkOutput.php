<?php
//Query zusammenstellen, um Resources auszulesen
$c = $modx->newQuery('modResource');
$c->where(array(
   'parent' => 4,
   'deleted' => false,
   'hidemenu' => false,
   'published' => true
));
$c->sortby('menuindex','ASC');
$c->limit(3);

//Resources auslesen
$resources = $modx->getCollection('modResource',$c);

//output
$output = "";
foreach($resources as $item) {
	
	//Array zusammenstellen mit den Informationen, welche
	//auch im Chunk zur Verfügung stehen sollen
	$array = array ();
	$array ['pagetitle'] = $item->pagetitle;
	$array ['content'] = $item->content;
	
	//Chunk über die API anfordern
	$chunk = $modx->getObject('modChunk',array('name' => 'unserChunk'));
	
	//Inhalt renderen
	$output .= $chunk->process ($array);
  
}

return $output;

?>