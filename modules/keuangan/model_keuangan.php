<?php
// echo "<pre>".print_r($rekap_keuangan_bulanan['raw'],1)."</pre>";
function qodr_rekap_keuangan_bulanan($filter){
	if (!empty($filter)) {
		$thn=$filter['tahun'];
		$cabang = $filter['cabang'];
	}else{
		$thn=date('Y-');
		$cabang=get_user_meta(get_current_user_id(),"cabang_sekarang",1);
	}
	if ($cabang=='all') {
		$db=qodr_sql("SELECT * FROM rekap_keuangan_bulanan WHERE bulan like '$thn%' order by bulan,cabang_id");
	}else{
		$db=qodr_sql("SELECT * FROM rekap_keuangan_bulanan WHERE bulan like '$thn%' and cabang_id = '".$cabang."'  order by bulan,cabang_id");
	}
 
	foreach ($db as $k => $v) {
		$bulan=date("F Y",strtotime($v['bulan']));
		$dt[$bulan][]=$v;
	}
	foreach ($dt as $bulan => $v1) {
		$total[$bulan]['rab']=0;
		$total[$bulan]['kas']=0;
		$total[$bulan]['terkumpul']=0;
		$total[$bulan]['pengeluaran_real']=0;
		foreach ($v1 as $k2 => $v2) {
			$total[$bulan]['rab']+=$v2['rab'];
			$total[$bulan]['kas']+=$v2['kas'];
			$total[$bulan]['terkumpul']+=$v2['terkumpul'];
			$total[$bulan]['pengeluaran_real']=$v2['pengeluaran_real'];
		}
	}
	$res['summary']=$total;
	$res['raw']=$dt;
	return $res;
}

function qodr_update_rekap_keuangan_bulanan(){
	// echo "<pre>".print_r($_POST,1)."</pre>";
	qodr_log_tg("update keuangan ".json_encode($_POST));
	qodr_sql("UPDATE rekap_keuangan_bulanan SET $_POST[kolom]='$_POST[nilai]' WHERE id='$_POST[id]'");
	die(number_format($_POST['nilai']));
}
?>