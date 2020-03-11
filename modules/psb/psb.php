<?php

function qodr_psb(){
	if (!empty($_GET['action']) and $_GET['action']=='reload') {
		qodr_sync_all();
	}
	if (!empty($_GET['status'])) {
		$filter['status']=$_GET['status'];
	}else{
		$filter['status']='seed';
	}
	if (!empty($_GET['cabang'])) {
		$filter['cabang']=$_GET['cabang'];
	}else{
		$filter['cabang']='hq';
	}
	// echo '<pre>'.print_r(qodr_data_psb(''),1).'</pre>';
	// die();
	$dt['rekap_status_psb']=json_decode(qodr_rekap_status_psb(),true);
	$dt['data_psb']=qodr_data_psb($filter);
	$view=qodr_psb_view($dt);
	wp_die($view);
}

qodr_hook_wpajax('detail_psb'); // model_psb -> qodr_detail_psb()
qodr_hook_wpajax('update_psb'); // model_psb -> qodr_update_psb()
qodr_hook_wpajax('delete_psb'); // model_psb -> qodr_delete_psb()


?>