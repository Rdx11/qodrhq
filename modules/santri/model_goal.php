<?php

function qodr_get_goal(){
	$uid=$_POST['uid'];
	$jangka=$_POST['jangka'];
	$dt=qodr_sql("SELECT * FROM santri_goal
		where santri_id='$uid' and jangka='$jangka' order by set_goal asc");
	echo qodr_detail_goal_view($dt,$uid);
	wp_die();
}

function qodr_change_status_goal(){
	qodr_log_tg("change status goal ".json_encode($_POST));
	$id=$_POST['id'];
	$status=$_POST['status'];
	$dt=qodr_sql("UPDATE santri_goal SET status='$status'
		where id='$id'");
	wp_die();
}

function qodr_del_goal(){
	qodr_log_tg("del goal ".json_encode($_POST));
	$id=$_POST['id'];
	$dt=qodr_sql("DELETE FROM santri_goal 
		where id='$id'");
	wp_die($id);
}