<?php


function qodr_tab_kinerja_helper($get){
	$tab['survey']='active';
	$tab['kinerja_pengurus']='';
	$tab['summary']='';
	if (isset($get['tab'])){
		if ($get['tab']=='survey') 
			{$tab['survey']='active';}else{$tab['survey']='';}
		if ($get['tab']=='kinerja-pengurus') 
			{$tab['kinerja_pengurus']='active';}else{$tab['kinerja_pengurus']='';}
		if ($get['tab']=='summary') 
			{$tab['summary']='active';}else{$tab['summary']='';}
	}
	return $tab;
}

function qodr_skip_kinerja_program_helper($hitung){
	if ($hitung=='skip') {
		$skip['label']='del';
		$skip['id_program']='disable-';
		$skip['val_nilai']='skip-';
		$skip['kuning']='';
	}else{
		$skip['label']='span';
		$skip['id_program']='';
		$skip['val_nilai']='';
		$skip['kuning']='kuning';
	}
	return $skip;
}