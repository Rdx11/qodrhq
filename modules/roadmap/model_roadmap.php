<?php

function qodr_roadmap_master_tree(){	
	$url=URL_REMOTE."route.php?go=master-roadmap-json&k=".API_KEY;
	$curl=qodr_filegetcontents($url);
	$db=json_decode($curl,true);
	//$db=qodr_sql("SELECT * from roadmap order by urut desc");
	
	foreach ($db as $k => $r) {
		$dt[$r['bapak']][$r['id']]=$r;
		if (trim($r['teks'])=='') {
			$r['teks']='..';
		}
		$z[]=array(
			'id'=>$r['id'],
			'href' => $r['link'].'"  class="roadmap-item" onclick="return false;" onmouseover="return show_btn_action(this,'.$r['id'].','.$r['bapak'].','.$r['urut'].',\''.$r['link'].'\')" data-id="'.$r['id'],
		    'hrefTarget' => $r['link_target'],
		    'text' => $r['teks'],
		    'isActive' => $r['aktif'],
		    'isExpanded' => $r['ekspand'],
		    'isFolder' => $r['folder'],
		    'tooltip' => $r['tooltip'],
		    'bapak' => $r['bapak']
		);
	}
	return qodr_tree(0,$z);
}

function qodr_add_roadmap(){
	qodr_log_tg("add roadmap ".json_encode($_POST));
	$teks=$_POST['teks'];
	$bapak=$_POST['bapak'];
	qodr_sql("INSERT INTO roadmap(teks,bapak) VALUES('$teks','$bapak')");
	qodr_sql("UPDATE trigger_rekap SET meta_val='on' WHERE  meta_key='master_roadmap'");
	wp_die($teks);
}

function qodr_update_roadmap(){
	qodr_log_tg("update roadmap ".json_encode($_POST));
	$teks=$_POST['teks'];
	$id=$_POST['id'];
	$bapak=$_POST['bapak'];
	$urut=$_POST['urut'];
	$link=$_POST['link'];
	qodr_sql("UPDATE roadmap SET teks='$teks',urut='$urut',bapak='$bapak',link='$link' WHERE id='$id'");
	qodr_sql("UPDATE trigger_rekap SET meta_val='on' WHERE  meta_key='master_roadmap'");
	wp_die($teks);
}
function qodr_del_roadmap(){
	qodr_log_tg("del roadmap ".json_encode($_POST));
	$id=$_POST['id'];
	qodr_sql("DELETE FROM roadmap WHERE id='$id'");
	qodr_sql("UPDATE trigger_rekap SET meta_val='on' WHERE  meta_key='master_roadmap'");
	wp_die($id);
}