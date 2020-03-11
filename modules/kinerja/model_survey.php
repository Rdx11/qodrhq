<?php
function qodr_rekap_survey($tgl,$cabang){
	$db=qodr_sql("SELECT tgl,survey_key,survey_val,count(santri_id) as jml,group_concat(santri_id) as siapa FROM santri_survey WHERE cabang_id='$cabang' and tgl like '$tgl' group by survey_key,survey_val");
	if (is_array($db)) {
	foreach ($db as $k => $v) {
			$dt[$v['survey_key']][]=$v;
		}
		return $dt;
	}
   }	
function qodr_siapa_saja(){
	$tgl=$_POST['tgl'];
	$survey_key=$_POST['key'];
	$survey_val=$_POST['value'];
	$db=qodr_sql("SELECT group_concat(santri_id) as santri FROM santri_survey WHERE tgl like '$tgl' and survey_key='$survey_key' and survey_val='$survey_val'");
	if (!empty($db[0]['santri'])) {
		wp_die('&rarr;'.$db[0]['santri']);
	}else{
		wp_die(false);
	}
}

function qodr_convert_tgl(){
	$action = $_POST['action'];
	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];
	$table = $_POST['table'];

	$sql = "UPDATE $table SET tgl = '$tgl_akhir' WHERE tgl = '$tgl_awal'";
	$db = qodr_sql($sql);

	echo $sql;
	die();
	
}
function qodr_tanggal_survey($cabang){
	$sql = "SELECT tgl from santri_survey WHERE cabang_id='".$cabang."' group by tgl order by tgl desc limit 5";
	$tgl_db=qodr_sql($sql);
    // echo "a<pre>".print_r($tgl_db,1)."</pre>";
	$tgl='';
    foreach ((array)$tgl_db as $k => $v) {
        $tgl_sekarang='';
        if (isset($_GET['tgl'])) {
            if ($_GET['tgl']==$v['tgl']) {
                $tgl_sekarang='color:green;font-weight:bold;';
            }else{
                $tgl_sekarang='';
            }
        }
        $tgl.='<a href=admin.php?page=qodr-kinerja&tgl='.$v['tgl'].'&tab=survey&cabang='.$cabang.' style="'.$tgl_sekarang.'" >'.date("dMy",strtotime($v['tgl'])).'</a> | ';
	}

	$tgl=substr($tgl,0,-2);
	return $tgl;
}
function qodr_tgl_survey_terakhir(){
	$tgl_db=qodr_sql("SELECT tgl from santri_survey group by tgl order by tgl limit 1");
	return $tgl_db[0]['tgl'];
}
