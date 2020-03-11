<?php
function qodr_kinerja(){
//USERLOGIN
$user_cabang=get_user_meta(get_current_user_id(),'cabang_sekarang',1);
//ENDUSERLOGIN
	qodr_log_tg("Akses Kinerja");
	$view['script']=qodr_script_kinerja_view();
	if (isset($_GET['tgl'])) {
		$filter['tgl']=$_GET['tgl'];
	}else{
		$filter['tgl']=qodr_tgl_survey_terakhir();
	}
	if (isset($_GET['action']) and $_GET['action']=='del') {
		qodr_kinerja_del($_GET['id']);
		unset($_GET['id']);
	}
	if ($user_cabang!='hq') {
		$dt['rekap_survey']=qodr_rekap_survey($filter['tgl'], $user_cabang);
		$dt['tanggal_rapat']=qodr_tanggal_rapat($user_cabang);
		$dt['tanggal_survey']=qodr_tanggal_survey($user_cabang);
		$dt['summary_table']=qodr_summary_table_view($user_cabang);
	}else{
		isset($_GET['cabang']) ? $cabang = $_GET['cabang'] : $cabang = 'hq';
		$dt['rekap_survey']=qodr_rekap_survey($filter['tgl'],$cabang);
		$dt['tanggal_rapat']=qodr_tanggal_rapat($cabang);
		$dt['tanggal_survey']=qodr_tanggal_survey($cabang);
		$dt['summary_table']=qodr_summary_table_view($cabang);
	}
	$view['rekap_survey']=qodr_kinerja_survey_pekanan_view($dt);	
	//$dt['tanggal_rapat']=qodr_tanggal_rapat();
	$dt['kinerja_pengurus']=qodr_kinerja_pengurus()['program'];
	$dt['kinerja_summary']=qodr_kinerja_pengurus()['summary'];
	$view['program_kerja']=qodr_kinerja_program_kerja_view($dt['kinerja_pengurus'],$dt['kinerja_summary'],$dt['tanggal_rapat']);
	$view['summary']=qodr_kinerja_summary_view($dt);
	$render=qodr_kinerja_view($dt,$view);
	wp_die($render);
}
qodr_hook_wpajax('siapa_saja'); // model_survey -> qodr_siapa_saja()
qodr_hook_wpajax('save_kinerja_pengurus'); // model_survey -> qodr_siapa_saja()
qodr_hook_wpajax('lock_kinerja'); // model_survey -> qodr_siapa_saja()
qodr_hook_wpajax('summary_chart');	 // model_survey -> qodr_siapa_saja()
qodr_hook_wpajax('summary_table'); // model_survey -> qodr_siapa_saja()
qodr_hook_wpajax('convert_tgl'); // model_survey -> qodr_siapa_saja()