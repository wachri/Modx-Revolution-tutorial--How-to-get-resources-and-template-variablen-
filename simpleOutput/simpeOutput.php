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
$output = "<ul>";
foreach($resources as $item) {
  $output .= "<li>".$item->pagetitle."<li>";
}
$output .= "/<ul>";

return $output;
?>