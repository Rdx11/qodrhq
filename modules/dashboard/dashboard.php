<?php

function qodr_dashboard(){
	$view['script']=qodr_script_dashboard_view();
	
	$url=URL_REMOTE."route.php?go=nowhere&k=".API_KEY;
	$html=qodr_filegetcontents($url);
	// die($html);
	$dt['user_id']=get_current_user_id();
	$user_info = get_userdata($dt['user_id']);
	$dt['uid'] = $user_info->user_login;
	$dt['nickname'] = $user_info->user_nicename;
	$dt['email'] = $user_info->user_email;
	$dt['cabang_sekarang']=get_user_meta($dt['user_id'],'cabang_sekarang',true); 
	$render=qodr_dashboard_view($dt,$view);
	wp_die($render);
}