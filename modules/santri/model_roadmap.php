<?php

function qodr_save_nilai_roadmap(){
	qodr_log_tg("update nilai ".json_encode($_POST));
	$santri_id=$_POST['santri_id'];
	$roadmap_id=$_POST['roadmap_id'];
	$nilai=$_POST['nilai'];
	$cek=qodr_sql("SELECT count(id) as jml from santri_roadmap WHERE santri_id='$santri_id' and roadmap_id='$roadmap_id'");
	if ($cek[0]['jml']>0) {
		$sql="UPDATE santri_roadmap SET nilai='$nilai' WHERE santri_id='$santri_id' and roadmap_id='$roadmap_id'";
	}else{
		$sql="INSERT INTO santri_roadmap VALUES('','$santri_id','$roadmap_id','$nilai')";
	}
	qodr_sql($sql);
	$r='saved.';
	wp_die($r);
}

function qodr_roadmap_tree($santri_id){
	
	$url=URL_REMOTE."route.php?go=master-roadmap-json&k=".API_KEY;
	$curl=qodr_filegetcontents($url);
	$db=json_decode($curl,true);
	//$db=qodr_sql("SELECT * from roadmap order by urut desc");
	$nilai=qodr_sql("SELECT roadmap_id,nilai from santri_roadmap WHERE santri_id='$santri_id'");
	if (empty($nilai)) {
		$nilai=array();
	}
	foreach ($nilai as $k => $v) {
		$nilai_arr[$v['roadmap_id']]=$v['nilai'];
	}
	// echo "<pre>".print_r($nilai_arr,1)."</pre>";
	foreach ($db as $k => $r) {
		$dt[$r['bapak']][$r['id']]=$r;
		// echo $r['nilai']."<br>";
		if (isset($nilai_arr[$r['id']])) {
			$nilai=$nilai_arr[$r['id']];
			$class_nilai='link-nilai';
		}else{
			$nilai='';
			$class_nilai='';
		}
		
		$z[]=array(
			'id'=>$r['id'],
			'href' => $r['link'].'"  class="link '.$class_nilai.'" data-id="'.$r['id'].'" data-nilai="'.$nilai.'" onclick="return form_update_roadmap_santri(this,\''.$santri_id.'\','.$r['id'].',\''.$r['folder'].'\');',
		    'hrefTarget' => $r['link_target'],
		    'text' => $r['teks'],
		    'isActive' => $r['aktif'],
		    'isExpanded' => $r['ekspand'],
		    'isFolder' => $r['folder'],
		    'tooltip' => $r['tooltip'],
		    'bapak' => $r['bapak']
		);
	}
	// echo "<pre>".print_r($z,1)."</pre>";
	return qodr_tree(0,$z);
}


function qodr_tree($bapak,$dt){
	$arr=array();
	foreach ($dt as $v1) {
		if ($v1['bapak']==$bapak) {
			$anak=qodr_tree($v1['id'],$dt);
			if ($anak) {
				$v1['children']=$anak;
			}
			$arr[]=$v1;
		}
	}
	return $arr;
}

?>