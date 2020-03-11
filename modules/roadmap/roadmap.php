<?php

function qodr_roadmap(){
	if (!empty($_GET['action']) and $_GET['action']=='reload') {
		qodr_sync_all();
	}
	$tree=qodr_roadmap_master_tree();
	$json_tree=json_encode($tree);
	$json_tree=str_replace('"true"', 'true', $json_tree);
	$json_tree=str_replace('"false"', 'false', $json_tree);
	$dt['json_tree']=$json_tree;
	$view=qodr_roadmap_master_view($dt);
	wp_die($view);
}

qodr_hook_wpajax('add_roadmap'); // model_roadmap -> qodr_add_roadmap()
qodr_hook_wpajax('update_roadmap'); // model_roadmap -> qodr_update_roadmap()
qodr_hook_wpajax('del_roadmap'); // model_roadmap -> qodr_del_roadmap()