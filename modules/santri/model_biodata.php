<?php
function qodr_filter_btn(){
	$url=URL_REMOTE."route.php?go=filter-santri-json&k=".API_KEY;
	$curl=qodr_filegetcontents($url);
	$db=json_decode($curl,true);
	$filter_arr=array('all','hq','semarang','pekalongan','magelang','magetan','andalus','hafidz','psb','santri','magang','cuti','tugas_belajar','alumni','dropout','ngilang');
	foreach ($filter_arr as $k => $v) {
		if (empty($db[$v])) {
			$db[$v]=0;
		}
	}
	return $db;
}

function qodr_umur_santri(){
	$santri=qodr_sql("SELECT uid,tgl_join FROM santri");

	foreach ($santri as $k => $v) {
		if ($v['tgl_join']=='0000-00-00') {
			$umur[$v['uid']]['umur']='';
			$umur[$v['uid']]['tgl_join']='';
			continue;
		}
		$datetime1 = new DateTime($v['tgl_join']);
		$datetime2 = new DateTime(date("Y-m-d"));
		$interval = $datetime1->diff($datetime2);
		$diff=$interval->format('%a');
		$total_hari=$diff;
		$thn=floor($total_hari/365);
		$bln=floor(($total_hari%365)/30.5);
		$hari=floor(($total_hari%365)%30.5);
		if ($thn==0) {$thn='';}else{$thn=$thn."thn ";}
		if ($bln==0) {$bln='';}else{$bln=$bln."bln ";}
		if ($hari==0) {$hari='';}else{$hari=$hari."hari";}
		$umur[$v['uid']]['umur']=$thn.$bln.$hari;
		$umur[$v['uid']]['tgl_join']=date("dMy",strtotime($v['tgl_join']));
	}
	return $umur;

}

function qodr_add_santri(){
	qodr_log_tg("add santri ".json_encode($_POST));
	$cek=qodr_sql("SELECT count(uid) as jml FROM santri WHERE uid='$_POST[uid]'");
	if (isset($_POST) and $_POST['uid']!='') {
		if ($cek[0]['jml']==0) {
			foreach ($_POST as $k => $v) {
				if ($k=='action') {continue;}
				$v=qodr_clean($v);
				$kolom_arr[]="$k";
				$val_arr[]="'$v'";
			}
			$kolom=implode(",",$kolom_arr);
			$val=implode(",",$val_arr);
			qodr_sql("INSERT INTO santri($kolom) VALUES($val)");
			$n="Biodata $_POST[uid] <b style='color:green;'>berhasil</b> tersimpan.";
			
			$tahfidz=qodr_sql("SELECT * FROM tahfidz");
			foreach ($tahfidz as $k => $v1) {
				$tgl=date('Y-m-d');
				$values_arr[]="('','$_POST[uid]','$v1[no]','$tgl','belum')";
			}
			$values=implode(",", $values_arr);
			qodr_sql("INSERT INTO santri_tahfidz VALUES$values");
			$n.="<br>Tahfidz $_POST[uid] <b style='color:green;'>berhasil</b> tersimpan.";

			qodr_sql("UPDATE trigger_rekap SET meta_val='on' WHERE  meta_key='rekap_persen_biodata'");
			qodr_sql("UPDATE trigger_rekap SET meta_val='on' WHERE  meta_key='rekap_santri_tahfidz'");
			
		}else{
			$n="Santri <b style='color:red;'>sudah terdaftar</b> sebelumnya.";
		}
	}else{
		$n="<b style='color:red;'>Uid wajib diisi.</b>";
	}
	wp_die($n);
}

function qodr_rekap_biodata_santri($filter){ 
	// $filter_arr=array('alumni','all','psb','dropout','cuti','ngilang','magang','tugas-belajar','andalus','semarang','magelang','magetan','hq','pekalongan','hafidz');

	$where="status_santri='santri'";
	if ($filter=='all') {$where="cabang_sekarang!='qodrbee'";}
	if ($filter=='hafidz') {$where="uid in (select santri_id from (SELECT santri_id,count(id) as jml FROM `santri_tahfidz` where hafal='sudah' group by santri_id) a where jml=48)";}
	if ($filter=='santri_magang') {$where="status_santri='santri_magang'";}
	if ($filter=='santri_belajar') {$where="status_santri='santri_belajar'";}
	if ($filter=='alumni') {$where="status_santri='alumni'";}
	if ($filter=='pkl') {$where="status_santri='pkl'";}
	if ($filter=='dropout') {$where="status_santri='dropout'";}
	if ($filter=='cuti') {$where="status_santri='cuti'";}
	if ($filter=='ngilang') {$where="status_santri='ngilang'";}
	if ($filter=='magang') {$where="status_santri='magang'";}
	if ($filter=='tugas-belajar') {$where="status_santri='tugas-belajar'";}
	if ($filter=='andalus') {$where="cabang_sekarang='andalus'";}
	if ($filter=='semarang') {$where="cabang_sekarang='semarang'";}
	if ($filter=='magelang') {$where="cabang_sekarang='magelang'";}
	if ($filter=='magetan') {$where="cabang_sekarang='magetan'";}
	if ($filter=='hq') {$where="cabang_sekarang='hq'";}
	if ($filter=='pekalongan') {$where="cabang_sekarang='pekalongan'";}
	if ($filter=='samarinda') {$where="cabang_sekarang='samarinda'";}
	$santri=qodr_sql("SELECT * FROM santri where $where order by uid"); 
	$url=URL_REMOTE."route.php?go=rekap-persen-biodata-json&k=".API_KEY;

	$dt=qodr_filegetcontents($url);
	$rekap_persen_biodata_santri=json_decode($dt,true);
	$data=[];
	foreach ($santri as $k => $v) {
		if (isset($rekap_persen_biodata_santri[$v['uid']])) {
			$data[$v['uid']]=$rekap_persen_biodata_santri[$v['uid']];
		}
	}
	return $data;
}


function qodr_warna_deadline($deadline){
	// if (empty($deadline['status'])) {
	// 	$deadline['status']='plan';
	// }
	$datetime1 = new DateTime($deadline['deadline']);
	$datetime2 = new DateTime(date("Y-m-d"));
	$interval = $datetime1->diff($datetime2);
	$diff=$interval->format('%R%a');
	$warna_deadline='default';
	if ($deadline['status']=='done') {
		$warna_deadline='success';
	}elseif ($deadline['status']=='failed') {
		$warna_deadline='danger';
	}elseif ($deadline['status']=='proses') {
		if ($diff=='-1' or $diff=='-2' or $diff=='-3') {
			$warna_deadline='warning';
		}
		if (substr($diff,0,1)=='+') {
			$warna_deadline='danger';
		}
	}else{

	}
	return $warna_deadline;
}

function qodr_warna_persen_biodata($persen){
	if ($persen==100) {
		$warna='success';
	}elseif($persen<=99 and $persen>=50){
		$warna='warning';
	}else{
		$warna='danger';
	}
	return $warna;
}

function qodr_get_biodata(){
	$uid=$_POST['uid'];
	$dt=qodr_sql("SELECT * FROM santri WHERE uid='$uid'");
	// echo "<pre>".print_r($dt,1)."</pre>";
	$cabang=qodr_sql("SELECT id FROM cabang");
	$table=qodr_detail_biodata_view($dt,$cabang);
	
	wp_die($table);
}

function qodr_update_biodata(){
	qodr_log_tg("update biodata santri ".json_encode($_POST));
	foreach ($_POST as $k => $v) {
		if ($k=='action' or $k=='uid' or $k=='last_update') {continue;}
		$v=qodr_clean($v);
		$set_arr[]="$k='$v'";
	}
	$set_string=implode(",",$set_arr);
	qodr_sql("UPDATE santri SET $set_string WHERE uid='$_POST[uid]'");
	//update jadi on agar sinkron lagi rekapnya
	qodr_sql("UPDATE trigger_rekap SET meta_val='on' WHERE  meta_key='rekap_persen_biodata'");
	wp_die('Update Successfull.');
}

function qodr_cabang_santri(){
	$dt=qodr_sql("SELECT uid,cabang_sekarang FROM santri");
	foreach ($dt as $k => $v) {
		$cabang_sekarang[$v['uid']]=$v['cabang_sekarang'];
	}
	return $cabang_sekarang;
}
?>