<?php

function qodr_keuangan(){
	//user_cabang
	$user_cabang=get_user_meta(get_current_user_id(),"cabang_sekarang",1);
	//enduser_cabang
	if (empty($_GET['tahun'])) {
		$tahun=date('Y');
	}else{
		$tahun=$_GET['tahun'];
	}
	if ($user_cabang != 'hq') {
		$filter['tahun']=$tahun;
	    $filter['cabang'] = $user_cabang;
	    $dt['rekap_keuangan_bulanan']=qodr_rekap_keuangan_bulanan($filter);
	    $dt['cabang']= $user_cabang;
		$view=qodr_keuangan_view($dt);
		wp_die($view);
	}else{
		isset($_GET['cabang']) ? $cabang = $_GET['cabang'] : $cabang = 'hq';
	    $filter['tahun']=$tahun;
	    $filter['cabang'] = $cabang;
	    $dt['rekap_keuangan_bulanan']=qodr_rekap_keuangan_bulanan($filter);
	    $dt['cabang']= $cabang;
	    $view=qodr_keuangan_view($dt);
	    wp_die($view);
}
}

qodr_hook_wpajax('update_rekap_keuangan_bulanan'); // model_keuangan -> qodr_update_rekap_keuangan_bulanan()


?>