<?php

function qodr_doc(){
	$url=URL_REMOTE."route.php?go=doc&k=".API_KEY;
	$html=qodr_filegetcontents($url);
	die($html);
}

?>