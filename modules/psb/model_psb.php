<?php

function qodr_rekap_status_psb(){
	$url=URL_REMOTE."route.php?go=rekap-status-psb-json&k=".API_KEY;
	$dt=qodr_filegetcontents($url);
	return $dt;
}

function qodr_data_psb($filter){
	if (!empty($filter['status'])) {
		$where="status_daftar='".$filter['status']."'";
	}else{
		$where="1=1";
	}
	if (!empty($filter['cabang'])) {
		$where.=" and cabang_id='".$filter['cabang']."'";
	}
	$db=qodr_sql("SELECT * FROM psb WHERE $where");
	return $db;
}

function qodr_detail_psb(){
	$id=$_POST['id'];
	$db=qodr_sql("SELECT * FROM psb WHERE id='$id'");
	if (!empty($db)) {
		$dt=$db[0];
	}
	$view=qodr_detail_psb_view($dt);
	die($view);	
}
function qodr_update_psb(){
	qodr_log_tg("update psb ".json_encode($_POST));
	$id=$_POST['id'];
	$ket=$_POST['ket'];
	$status_daftar=$_POST['status_daftar'];
	qodr_sql("UPDATE psb SET ket='$ket',status_daftar='$status_daftar' WHERE id='$id'");
	qodr_sql("UPDATE trigger_rekap SET meta_val='on' WHERE  meta_key='rekap_status_psb'");
	die('Update successfully');
}
function qodr_delete_psb(){
	qodr_log_tg("del psb ".json_encode($_POST));
	$id=$_POST['id'];
	qodr_sql("DELETE FROM psb WHERE id='$id'");
	qodr_sql("UPDATE trigger_rekap SET meta_val='on' WHERE  meta_key='rekap_status_psb'");
	die('Delete successfully');
}
?>