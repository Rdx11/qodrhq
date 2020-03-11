<?php


qodr_hook_wpajax('change_sync'); // model_sync -> qodr_change_sync()

function qodr_sync(){
	// qodr_sql("UPDATE trigger_rekap SET meta_val='on' WHERE  meta_key='rekap_santri_tahfidz'");
	$dt['res_sync_all']='';
	if (isset($_GET['filter']) and $_GET['filter']=='sync-all') {
		$dt['res_sync_all']=qodr_sync_all();
	}

	$dt['list_sync']=qodr_list_sync();
	$view=qodr_sync_view($dt);
	wp_die($view);
}

?>