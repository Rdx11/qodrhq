<?php

function qodr_santri(){
	echo '<pre>'.print_r(get_user_meta(get_current_user_id(),'cabang_sekarang',true),1).'</pre>';
	
	
	if (isset($_GET['action']) and $_GET['action']=='reload') {
		qodr_sync_all();
	}
	if (isset($_GET['page2']) and $_GET['page2']=='santri-roadmap') {
		qodr_santri_roadmap();		
	}else{
		if (!empty($_GET['santri'])) {
			$filter=$_GET['santri'];
		}else{
			$filter='hq';
		}
		$dt['rekap_biodata']=qodr_rekap_biodata_santri($filter);
		$dt['rekap_santri_tahfidz']=qodr_rekap_santri_tahfidz();
		$dt['rekap_santri_tahsin']=qodr_rekap_santri_tahsin();
		$dt['cabang_sekarang']=qodr_cabang_santri();
		$dt['deadline_santri']=qodr_deadline_santri();
		$dt['umur_santri']=qodr_umur_santri();
		$dt['rekap_dzikir']=qodr_rekap_dzikir();
		$dt['filter_btn']=qodr_filter_btn();
		$view=qodr_santri_view($dt);
		wp_die($view);
	}
}

function qodr_santri_roadmap(){
	$santri_id=$_GET['santri_id'];
	$tree=qodr_roadmap_tree($santri_id);
	$json_tree=json_encode($tree);
	$json_tree=str_replace('"true"', 'true', $json_tree);
	$json_tree=str_replace('"false"', 'false', $json_tree);
	$dt['json_tree']=$json_tree;
	$view=qodr_santri_roadmap_view($dt);
	wp_die($view);
}

qodr_hook_wpajax('del_goal'); // model_goal -> qodr_del_goal()
qodr_hook_wpajax('get_goal'); // model_goal -> qodr_get_goal()
qodr_hook_wpajax('change_status_goal'); // model_goal -> qodr_change_status_goal()
qodr_hook_wpajax('get_tahsin'); // model_tahsin -> qodr_get_tahsin()
qodr_hook_wpajax('add_tahsin'); // model_tahsin -> qodr_add_tahsin()
qodr_hook_wpajax('del_tahsin'); // model_tahsin -> qodr_del_tahsin()
qodr_hook_wpajax('get_tahfidz'); // model_tahfidz -> qodr_get_tahfidz()
qodr_hook_wpajax('update_tahfidz'); // model_tahfidz -> qodr_update_tahfidz()
qodr_hook_wpajax('add_santri'); // model_biodata -> qodr_add_santri()
qodr_hook_wpajax('get_biodata'); // model_biodata -> qodr_get_biodata(uid)
qodr_hook_wpajax('update_biodata'); // model_biodata -> qodr_update_biodata(uid)
qodr_hook_wpajax('add_todo'); // model_todo -> qodr_add_todo()
qodr_hook_wpajax('get_todo'); // model_todo -> qodr_get_todo(uid)
qodr_hook_wpajax('update_todo'); // model_todo -> qodr_update_todo()
qodr_hook_wpajax('del_todo'); // model_todo -> qodr_del_todo(id)
qodr_hook_wpajax('save_nilai_roadmap'); // model_roadmap -> qodr_save_nilai_roadmap()