<?php

function qodr_get_tahsin(){
	$uid=$_POST['uid'];
	$dt=qodr_sql("SELECT * FROM santri_tahsin
		where santri_id='$uid' order by tgl asc");
	echo qodr_detail_tahsin_view($dt,$uid);
	wp_die();
}

function qodr_add_tahsin(){
	qodr_log_tg("add tahsin ".json_encode($_POST));
	$uid=$_POST['uid'];
	$nilai=$_POST['nilai'];
	$keterangan=$_POST['keterangan'];
	$dt=qodr_sql("INSERT INTO santri_tahsin(santri_id,nilai,keterangan) VALUES('$uid','$nilai','$keterangan')");
	wp_die($uid);
}

function qodr_del_tahsin(){
	qodr_log_tg("add del ".json_encode($_POST));
	$id=$_POST['id'];
	$dt=qodr_sql("DELETE FROM santri_tahsin WHERE id='$id'");
	wp_die($id);
}


function qodr_rekap_santri_tahsin(){
	$url=URL_REMOTE."route.php?go=rekap-santri-tahsin-json&show_santri=all&k=".API_KEY;
	$json=qodr_filegetcontents($url);
	$array=json_decode($json,true);
	return $array;
}

function qodr_warna_tahsin($nilai){
	if (empty($nilai)) {
		$nilai=0;
	}
	if ($nilai==100) {
		$wrna="success";
	}elseif ($nilai<=50) {
		$wrna="danger";
	}else{
		$wrna="warning";
	}
	return $wrna;
}
