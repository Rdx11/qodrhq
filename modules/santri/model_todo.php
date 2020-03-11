<?php
function qodr_deadline_santri(){
	$url=URL_REMOTE."route.php?go=rekap-deadline-santri-json&k=".API_KEY;
	$dt=qodr_filegetcontents($url);
	$deadline=json_decode($dt,true);
	return $deadline;
}

function qodr_add_todo(){
	qodr_log_tg("add todo ".json_encode($_POST));
	foreach ($_POST as $k => $v) {
    	$$k=qodr_clean($v);
    }
    if (isset($_POST)) {
    	$sql="INSERT INTO santri_todo(id,santri_id,tgl,do,deadline,last_update,molor,status) 
    			VALUES('','$santri_id','".date('Y-m-d')."','$do','$deadline','".date('Y-m-d')."','0','$status')";
    	qodr_sql($sql);
    	qodr_sql("UPDATE trigger_rekap SET meta_val='on' WHERE  meta_key='rekap_deadline_santri'");
    	$n='Saved Successfully.';
    }else{
    	$n='Save Akun failed..';
    }
	wp_die($n);
}

function qodr_get_todo(){
	$uid=$_POST['uid'];
	$dt=qodr_sql("SELECT * FROM santri_todo WHERE santri_id='$uid' ORDER BY id desc");
	echo detail_todo_view($dt);
	wp_die();
}

function qodr_del_todo(){
	qodr_log_tg("del todo ".json_encode($_POST));
	$id='';
	if (isset($_POST)) {
		$id=$_POST['id'];
		qodr_sql("DELETE FROM santri_todo WHERE id='$id'");
	}
	wp_die($id);
}

function qodr_update_todo(){
	qodr_log_tg("update todo ".json_encode($_POST));
	$id=qodr_clean($_POST['id']);
	$val=qodr_clean($_POST['val']);
	$kolom=qodr_clean($_POST['kolom']);
	if ($kolom=='molor') {
		qodr_sql("UPDATE santri_todo SET molor='$val' WHERE id='$id'");
	}
	if ($kolom=='status') {
		qodr_sql("UPDATE santri_todo SET status='$val' WHERE id='$id'");
	}
	if ($kolom=='deadline') {
		qodr_sql("UPDATE santri_todo SET deadline='$val' WHERE id='$id'");
	}
	$notif="$kolom &rarr; $val";
	qodr_sql("UPDATE trigger_rekap SET meta_val='on' WHERE  meta_key='rekap_deadline_santri'");
	wp_die('Update '.$notif.' Successfully.');
}
?>
