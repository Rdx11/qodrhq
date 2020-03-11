<?php

function qodr_psb_view($dt){
	extract($dt);
	$rekap=array('all','seed','menyusul','ngilang','gagal','wawancara','tes-online','tes-offline','lulus');
	foreach ($rekap as $k => $v) {
		if (empty($rekap_status_psb[$v])) {
			$rekap_status_psb[$v]=0;
		}
	}
	$html='<script src="' . site_url() . '/wp-content/plugins/qodr/public/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" href="' . site_url() . '/wp-content/plugins/qodr/public/css/bootstrap.min.css">
		<link rel="stylesheet" href="' . site_url() . '/wp-content/plugins/qodr/public/css/qodr.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">';
	$btn_filter="<div style='float:left;text-align:left;margin:10px 0px;'>
			<a class='btn btn-xs btn-default btn-filter' href='admin.php?page=qodr-psb' >
				<span class='fa fa-refresh'>".$rekap_status_psb['all']."</span> all</a>
			<a class='btn btn-xs btn-default btn-filter' href='admin.php?page=qodr-psb&cabang=berau' >
				<span class='fa fa-refresh'>".$rekap_status_psb['seed']."</span> berau</a>
			<a class='btn btn-xs btn-default btn-filter' href='admin.php?page=qodr-psb&status=seed' >
				<span class='fa fa-refresh'>".$rekap_status_psb['seed']."</span> seed</a>
			<a class='btn btn-xs btn-default btn-filter' href='admin.php?page=qodr-psb&status=menyusul' >
				<span class='fa fa-refresh'>".$rekap_status_psb['menyusul']."</span> menyusul</a>
			<a class='btn btn-xs btn-default btn-filter' href='admin.php?page=qodr-psb&status=ngilang' >
				<span class='fa fa-refresh'>".$rekap_status_psb['ngilang']."</span> ngilang</a>
			<a class='btn btn-xs btn-default btn-filter' href='admin.php?page=qodr-psb&status=gagal' >
				<span class='fa fa-refresh'>".$rekap_status_psb['gagal']."</span> gagal</a>
			<a class='btn btn-xs btn-default btn-filter' href='admin.php?page=qodr-psb&status=wawancara' >
				<span class='fa fa-refresh'>".$rekap_status_psb['wawancara']."</span> wawancara</a>
			<a class='btn btn-xs btn-default btn-filter' href='admin.php?page=qodr-psb&status=tes-online' >
				<span class='fa fa-refresh'>".$rekap_status_psb['tes-online']."</span> tes-online</a>
			<a class='btn btn-xs btn-default btn-filter' href='admin.php?page=qodr-psb&status=tes-offline' >
				<span class='fa fa-refresh'>".$rekap_status_psb['tes-offline']."</span> tes-offline</a>
			<a class='btn btn-xs btn-default btn-filter' href='admin.php?page=qodr-psb&status=lulus' >
				<span class='fa fa-refresh'>".$rekap_status_psb['lulus']."</span> lulus</a>
		</div>
		<div style='float:right;text-align:right;margin:10px 20px;'>
			<a target='_blank' class='btn btn-xs btn-warning btn-filter' href='http://psb.qodr.or.id' ><span class='fa fa-refresh'></span> form pertanyaan</a>
			<a target='_blank' class='btn btn-xs btn-warning btn-filter' href='".URL_REMOTE."route.php?go=psb-pertanyaan&k=".API_KEY."' ><span class='fa fa-refresh'></span> daftar pertanyaan</a>
			<a target='_blank' class='btn btn-xs btn-warning btn-filter' href='".URL_REMOTE."route.php?go=psb-tes-offline&k=".API_KEY."' ><span class='fa fa-refresh'></span> persiapan tes-offline</a>
		</div>";

	$judul='<div class="container">
	<style>
		.btn-filter{
			margin:3px 1px;
		}
		.btn-sync{
    		background:silver;
    		border-radius:3px;
    		font-size:10px;    
    		padding: 0px 3px 3px 3px;
		    text-decoration: none;
		    color: green;
    	}
    	.btn-sync:hover{
    		background:green;
    		color:white;
    	}
	</style>
	<div class="row">
		<h1>Daftar PSB <a class="btn-sync" href="admin.php?page=qodr-psb&action=reload" style="">sync</a></h1>'.$btn_filter;
	$modal=qodr_modal_psb_view();
	$script=qodr_script_psb_view();

	$html.=$script.$modal.'
	<style> 

	</style>
	<table class="table table-hover" style="width:98%;float:left;">
		<tr bgcolor="#f6f3f3">
			<th>No</th>
			<th>Nama</th>
			<th>Asal</th>
			<th>No WA</th>
			<th>FB</th>
			<th>Coding</th>
			<th>Tanggal Daftar</th>
			<th>Status</th>
			<th>Ket</th>
		</tr>';
		$i=1;
	foreach ($data_psb as $k => $v) {
		if (substr($v['no_wa'],0,1)=='0') {
			$no_wa='62'.substr($v['no_wa'],1,strlen($v['no_wa']));
		}else{
			$no_wa=$v['no_wa'];
		}
		$no_wa=str_replace(" ","",$no_wa);
		$no_wa=str_replace("-","",$no_wa);
		$no_wa=str_replace("+","",$no_wa);
		if ($v['status_daftar']=='lulus') {
			$warna="success";
		}elseif ($v['status_daftar']=='menyusul') {
			$warna="warning";
		}elseif ($v['status_daftar']=='gagal' or $v['status_daftar']=='ngilang') {
			$warna="danger";
		}else{
			$warna="info";
		}
		$status_daftar='<button class="btn btn-xs btn-'.$warna.'" onclick="jQuery(\'.btn-detail-'.$v['id'].'\').click();" >'.$v['status_daftar']."</button>";

		$tr_ket='
		<tr style="display:none;" class="ket-'.$v['id'].'">
			<td colspan=8 >register : '.date("d M y",strtotime($v['created_at'])).' | updated : '.date("d M y",strtotime($v['last_update'])).' | '.$v['ket'].'</td>
		</tr>
		';
		$td_ket='<span onclick="jQuery(\'.ket-'.$v['id'].'\').toggle();">'.substr($v['ket'],0,50).'..</span>';
		$html.='
		<tr id="tr_'.$v['id'].'">
			<td>'.($i++).'</td>
			<td>
				<button class="btn btn-xs btn-danger" onclick="return ajax_delete_psb('.$v['id'].');"><i class="fa fa-close"></i>x</button>
				<a href=# class="btn-detail-'.$v['id'].'" onclick="return ajax_detail_psb('.$v['id'].');" data-toggle="modal" data-target="#exampleModal">'.$v['nama'].'</a> ('.$v['umur'].')</td>
			<td>'.substr($v['kota_asal'],0,12).'</td>
			<td><a target="_blank" href="https://api.whatsapp.com/send?phone='.$no_wa.'&text=Assalamualaikum%20mas%20'.$v['nama'].'">+'.$no_wa.'</a></td>
			<td><a target="_blank" href="'.$v['fb'].'">click</a></td>
			<td>'.substr($v['pernah_coding'],0,20).'</td>
			<td>'.date("d M y",strtotime($v['created_at'])).'</td>
			<td>'.$status_daftar.'</td>
			<td>'.$td_ket.'</td>
		</tr>
		';	
		$html.=$tr_ket;
	}
	$html.='</table>
	';	
	$html.='</div></div>';	
	return $judul.$html;
}

function qodr_modal_psb_view(){
	$modal='
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		  	<form id="form">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">

			      </div>
			      <div class="modal-footer">
			      	<div id="notif-footer" style="float:left;"></div>
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="button" class="btn btn-primary" id="modal-save-btn">Save changes</button>
			      </div>
			    </div>
		    </form>
		  </div>
		</div>
	';
	return $modal;
}


?>