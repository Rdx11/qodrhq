<?php
/**
 * @package QODR
 * @version 1.7
 */
/*
Plugin Name: QODR
Plugin URI: http://wordpress.org/plugins/qodr/
Description: SI Management QODR,QODRBee.
Author: Usman Rubiantoro
Version: 0.1.1
Author URI: http://ztoro.com/
*/
include_once("summary.php");
$modules=scandir(__DIR__.'/modules');
$skip=array(".","..","index.html");
include_once("config/def.php");
include_once("config/fn.php");
foreach ($modules as $k => $module) {
	if (in_array($module,$skip)) {continue;}
    $files=scandir(__DIR__.'/modules/'.$module);
	foreach ($files as $k1 => $file) {
        if (in_array($file,$skip)) {continue;}
		if (substr($file,-4,4)!='.php') {continue;}
		if (substr($file,0,6)=='views_') {continue;}
		include_once("modules/".$module."/".$file);
	}
}
add_action('admin_menu', 'qodr_helper_menu',99 );
function qodr_helper_menu(){ 
    if($_SERVER['HTTP_HOST'] == 'localhost'){
        add_menu_page(  'QODR', 'QODR', 'manage_options', 'qodr-setting', 'qodr_dashboard','',90 );
        add_submenu_page( 'qodr-setting', 'Dashboard', 'Dashboard', 'manage_options', 'qodr-setting' ); 
        add_submenu_page( 'qodr-setting', 'Roadmap', 'Roadmap', 'manage_options', 'qodr-roadmap','qodr_roadmap' );
        add_submenu_page( 'qodr-setting', 'Landing Page', 'Landing Page', 'manage_options', 'qodr-summary', 'qodr_summary' );
        add_submenu_page( 'qodr-setting', 'PSB', 'PSB', 'manage_options', 'qodr-psb', 'qodr_psb' );
        add_submenu_page( 'qodr-setting', 'Santri', 'Santri', 'manage_options', 'qodr-santri', 'qodr_santri' );
        add_submenu_page( 'qodr-setting', 'Keuangan', 'Keuangan', 'manage_options', 'qodr-keuangan', 'qodr_keuangan' );
        add_submenu_page( 'qodr-setting', 'Kinerja', 'Kinerja', 'manage_options', 'qodr-kinerja', 'qodr_kinerja' );
        add_submenu_page( 'qodr-setting', 'Sync', 'Sync', 'manage_options', 'qodr-sync', 'qodr_sync' );
        add_submenu_page( 'qodr-setting', 'Doc', 'Doc', 'manage_options', 'qodr-doc', 'qodr_doc' );
    }else{
        add_menu_page(  'QODR', 'QODR', 'manage_qodr', 'qodr-setting', 'qodr_dashboard','',90 );
        add_submenu_page( 'qodr-setting', 'Dashboard', 'Dashboard', 'manage_qodr', 'qodr-setting' ); 
        add_submenu_page( 'qodr-setting', 'Roadmap', 'Roadmap', 'manage_qodr_roadmap', 'qodr-roadmap','qodr_roadmap' );
        add_submenu_page( 'qodr-setting', 'Landing Page', 'Landing Page', 'manage_qodr_landing', 'qodr-summary', 'qodr_summary' );
        add_submenu_page( 'qodr-setting', 'PSB', 'PSB', 'manage_qodr_psb', 'qodr-psb', 'qodr_psb' );
        add_submenu_page( 'qodr-setting', 'Santri', 'Santri', 'manage_qodr_santri', 'qodr-santri', 'qodr_santri' );
        add_submenu_page( 'qodr-setting', 'Keuangan', 'Keuangan', 'manage_qodr_keuangan', 'qodr-keuangan', 'qodr_keuangan' );
        add_submenu_page( 'qodr-setting', 'Kinerja', 'Kinerja', 'manage_qodr_kinerja', 'qodr-kinerja', 'qodr_kinerja' );
        add_submenu_page( 'qodr-setting', 'Sync', 'Sync', 'manage_qodr_sync', 'qodr-sync', 'qodr_sync' );
        add_submenu_page( 'qodr-setting', 'Doc', 'Doc', 'manage_options', 'qodr-doc', 'qodr_doc' );
        add_submenu_page( 'qodr-setting', 'Publikasi', 'Publikasi', 'manage_options', 'qodr-publikasi', 'qodr_publikasi' );
        add_submenu_page( 'qodr-setting', 'Monitoring Santri', 'Monitoring Santri', 'manage_options', 'qodr-monitoring-santri', 'qodr_monitoring_santri' );
    }  
}