<?php

function qodr_summary(){
	$summary_json=json_decode(qodr_filegetcontents(URL_REMOTE."route.php?go=landing_json&k=".API_KEY),true);
	if(is_array($summary_json)){
		$summary='';
		foreach ($summary_json as $k => $v) {
			$summary.="$k=$v\n";
		}
	}
	$html="";
	$html.="<h1>QODR Summary</h1>";
	$html.="<form id='form_summary'>
		<h2>Edit Summary</h2>
		<span>view url : <a target='_blank' href='".URL_REMOTE."'>".URL_REMOTE."</a></span><br>
		<input type='hidden' name='action' value='upload_summary_ajax'>
		<textarea name='summary' style='width:30%;height:350px;'>$summary</textarea><br>
		<input class='btn btn-primary' type='button' value='upload' onclick='return ajax_upload_summary();'/>
		<pre id='notif_summary'></pre>
	</form>
	";
	$html.='<script type="text/javascript">
    	function ajax_upload_summary(){
    		jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : jQuery("#form_summary").serialize(),
			    method : "POST", 
			    success : function( response ){  jQuery("#notif_summary").html(response);},
			    error : function(error){ console.log(error) }
			  });
			  return false;
    	}</script>';
	echo ($html);
}

add_action( 'wp_ajax_upload_summary_ajax', 'qodr_upload_summary_ajax' );
add_action( 'wp_ajax_nopriv_upload_summary_ajax', 'qodr_upload_summary_ajax' );

function qodr_upload_summary_ajax(){
	
	$summary_arr=explode("\n",$_POST['summary']);
	if (is_array($summary_arr)) {
		foreach ($summary_arr as $baris) {
			$arr=explode("=",$baris);
			if (trim($arr[0])!='') {
				$dt_arr[trim($arr[0])]=trim($arr[1]);
			}
		}
		$dt_json['summary']=json_encode($dt_arr);
	}
	// echo "<pre>".print_r($arr,1)."</pre>";
	$url=URL_REMOTE.'route.php?go=landing_update&k='.API_KEY; 
	// die('dasdasd');
	die(qodr_curl_post($dt_json,$url));
}
?>