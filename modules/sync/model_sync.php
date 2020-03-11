<?php

function qodr_change_sync(){
	qodr_log_tg("change sync ".json_encode($_POST));
	if ($_POST['val']=='on') {
		$check="<span class='btn-sm btn-success' onclick='return change_sync(this,\"".$_POST['key']."\",\"off\");'> up to date</span>";
		qodr_sql("UPDATE trigger_rekap SET meta_val='off' WHERE meta_key='".$_POST['key']."'");
	}else{
		$check="<span class='btn-sm btn-danger' onclick='return change_sync(this,\"".$_POST['key']."\",\"on\");'> out of date</span>";
		qodr_sql("UPDATE trigger_rekap SET meta_val='on' WHERE meta_key='".$_POST['key']."'");
	}
	wp_die($check);
}

function qodr_list_sync(){
	$db=qodr_sql("SELECT * FROM trigger_rekap");
	return $db;
}

function qodr_sync_all(){
	$url=URL_REMOTE."route.php?go=generate-json&k=".API_KEY;
	$res=qodr_filegetcontents($url);
	return $res;
}

?>