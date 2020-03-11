<?php

function qodr_filegetcontents($url){
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	$contents = curl_exec($ch);
	// die($contents);
	if (curl_errno($ch)) {
	  echo curl_error($ch);
	  echo "\n<br />";
	  $contents = '';
	} else {
	  curl_close($ch);
	}

	if (!is_string($contents) || !strlen($contents)) {
		echo "Failed to get contents.";
		$contents = '';
	}
	//echo $url.'a';

	return $contents;
}


function qodr_curl_post($data,$url){
	qodr_write_log("qodr_curl_post -> $url");
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec($ch);
	$err = curl_error($ch);
	curl_close ($ch);
	if ($err) {
	  $n="cURL Error #:" . $err;
	  qodr_write_log("qodr_curl_post -> $n");
	} else {
	   $n=$server_output;
	}
	   // echo "$url<pre>".print_r($server_output,1)."</pre>"; 	
	return $n;
	// echo $n;
}

function qodr_hook_wpajax($action){
	add_action( 'wp_ajax_'.$action, 'qodr_'.$action );
	add_action( 'wp_ajax_nopriv_'.$action, 'qodr_'.$action );
}

function qodr_get_domain(){
	return $_SERVER['HTTP_HOST'];
	// echo "<pre>".print_r($_SERVER['HTTP_HOST'],1)."</pre>"; 	
}

function qodr_file_size(){
	return filesize(FK);
	// echo "<pre>".print_r($_SERVER['HTTP_HOST'],1)."</pre>"; 	
}

function qodr_get_token(){
	$post['go']='get_token';
	$post['domain']=qodr_get_domain();
	$post['size']='3159';
	// $post['size']=qodr_file_size();
	$post['k']=API_KEY;

	qodr_write_log("qodr_get_token");
	$token=qodr_curl_post($post,URL_REMOTE.'route.php');
	
	// echo "go <pre>".print_r($post,1)."</pre>"; 	
	// die('go token : '.$token);
	return $token;
}

function qodr_sql($sql){
	$post['go']='eskiel';
	$post['token']=qodr_get_token();
	$post['data']=$sql;
	$post['k']=API_KEY;
	
	qodr_write_log("qodr_sql -> $sql",0);
	$response=qodr_curl_post($post,URL_REMOTE.'route.php');
	// echo "<pre>".print_r($response,1)."</pre>"; 	
	return json_decode($response,true);
}

function qodr_log_tg($s){
	$current_user=wp_get_current_user();

	$hari_arr=array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Ahad');
	$hari=$hari_arr[date('N')-1]; 
	

	qodr_send_tg('*'.$hari.'* _'.date('dMy H:i')."_ \n`[".$current_user->user_login."]` ```| ".$s."```");
}
function qodr_send_tg($s,$debug=true){
	
	$chatID='166178584';
	$messaggio=$s;
	$token='769926539:AAEiGXc-_pSVRD1MVAtkQ9Ffn3ASJrx-FLA';
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio)."&parse_mode=markdown";
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function qodr_write_log($s,$debug=true){
	if ($debug) {
		$s=date('Y-m-d H:i:s').' :: '.$s."\n";
		$fp = fopen(__DIR__.'/log.php', 'a');
		fwrite($fp, $s);
		fclose($fp);
	}
}

function qodr_rekap_cache($rekap_file){
	return json_decode(file_get_contents(REKAP_PATH.$rekap_file.'.json'),true);
}

function qodr_clean($go){
	if (isset($go)) {
		$go=str_replace("'",'',$go);
		$go=str_replace('"','',$go);
		$go=str_replace('--','',$go);
		$go=trim($go);
		return $go;
	}else{
		return false;
	}
}

add_filter('wp_login', 'qodr_after_login');
function qodr_after_login () {
	qodr_log_tg("$_POST[log] login ztoro.com");
	$db=qodr_sql("select cabang_sekarang from santri where uid='$_POST[log]'");
	if (isset($db[0]['cabang_sekarang'])) {
		update_user_meta(get_current_user_id(),'cabang_sekarang',$db[0]['cabang_sekarang']);
	}else{
		update_user_meta(get_current_user_id(),'cabang_sekarang','hq');
	}
    return true;
}