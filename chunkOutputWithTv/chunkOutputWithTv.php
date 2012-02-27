<?php
/*
   This software is part of a tutorial for modx revolution. You can find the tutorial at http://www.code-meets-design.de/?p=567
   Copyright (C) 2012  Christian Waldmann

   This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program.  If not, see <http://www.gnu.org/licenses/>
*/
//Creat a new query to specify which resources you want to load
$c = $modx->newQuery('modResource');
$c->where(array(
   'parent' => 4,
   'deleted' => false,
   'hidemenu' => false,
   'published' => true
));
$c->sortby('menuindex','ASC');
$c->limit(3);

//Load the Resources
$resources = $modx->getCollection('modResource',$c);

//output
$output = "";
foreach($resources as $item) {
	//Creat a new array with the values you want to
	//print out in the chunk
	$array = array ();
	$array ['pagetitle'] = $item->pagetitle;
	$array ['content'] = $item->content;
	
	//Get the Template Variablen
	$templateVars = $item->getMany('TemplateVars');
	
	foreach ($templateVars as $tv) {
		//Get the content of the TV
		$tvContent = $tv->getValue($item->get('id'));
		
		//add the content to the array for the chunk
		$array [$tv->get('name')] = $tvContent;
	}
	
	//Get the chunk
	$chunk = $modx->getObject('modChunk',array('name' => 'ourChunk'));
	
	//Process the chunk to get the output
	$output .= $chunk->process ($array);
  
}

return $output;


?>