<?php


function qodr_rekap_santri_tahfidz(){
	$url=URL_REMOTE."route.php?go=tahfidz-rekap-json&show_santri=all&k=".API_KEY;
	$rekap_tahfidz_json=qodr_filegetcontents($url);
	$rekap_santri_tahfidz=json_decode($rekap_tahfidz_json,true);
	return $rekap_santri_tahfidz;
}

function qodr_warna_hafidz($jml){
	if (empty($jml)) {
		$jml=0;
	}
	if ($jml==48) {
		$hafidz="success";
	}elseif ($jml<=22) {
		$hafidz="danger";
	}else{
		$hafidz="warning";
	}
	return $hafidz;
}


function qodr_update_tahfidz(){
	qodr_log_tg("update tahfidz ".json_encode($_POST));
	if ($_POST['hafal']=='sudah') {$hafal="belum";}else{$hafal="sudah";}
	if ($_POST['warna']=='success') {$warna="danger";}else{$warna="success";}
	qodr_sql("UPDATE santri_tahfidz SET tgl='".date('Y-m-d')."',hafal='$hafal' WHERE id='$_POST[id]'");
	$json['hafal']=$hafal;
	$json['warna']=$warna;

	qodr_sql("UPDATE trigger_rekap SET meta_val='on' WHERE  meta_key='rekap_santri_tahfidz'");
	wp_die(json_encode($json));
}

function qodr_get_tahfidz(){
	$uid=$_POST['uid'];
	$dt=qodr_sql("select st.*,t.nama as nama_surat from santri_tahfidz st join tahfidz t 
		on st.no_surat=t.no 
		where santri_id='$uid' order by no asc");
	$hafal=0;
	foreach ($dt as $k => $v) {
		if ($v['hafal']=='sudah') {
			$warna[$k]="success";
			$hafal++;
		}else{
			$warna[$k]="danger";
		}
	}

	$view['data']=$dt;
	$view['warna']=$warna;
	$view['hafal']=$hafal;
	$view['blm_hafal']=48-$hafal;
	$view['uid']=$uid;
	echo detail_tahfidz_view($view);
	wp_die();
}