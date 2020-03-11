<?php

function qodr_santri_view($dt){
	extract($dt);
	$rekap_santri='';
	$html='<script src="' . site_url() . '/wp-content/plugins/qodr/public/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" href="' . site_url() . '/wp-content/plugins/qodr/public/css/bootstrap.min.css">
		<link rel="stylesheet" href="' . site_url() . '/wp-content/plugins/qodr/public/css/qodr.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">';
	
	
	$judul='<div class="container">
	<style>
		.btn-filter{
			margin:3px 1px;
		}
		.container{
			    width: 98% !important;
		}
		h1{
			float:left;
		}
	</style>
	<div class="row">
		<h1>Rekap Santri<a class="btn btn-xs btn-primary" href="admin.php?page=qodr-santri&action=reload" style="">sync</a></h1>';
	$html.='
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
		  	<form id="form_tahfidz">
		  	
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
		</div>';
	$script=qodr_script_santri();
	
	$html.=$script.'<br><table class="table table-hover">
		<th>No</th>
		<th>Santri</th>
		<th>Umur</th>
		<th>Biodata</th>
		<th>Todo</th>
		<th>Goal</th>
		<th>Agama</th>
		<th>Integriti</th>
		<th>IT</th>
		<th>Portfolio</th>
		<th>Grade</th>
		</tr>';
	$total=0;$hafal=0;
	$i=1;
	foreach ($rekap_biodata as $uid => $v) {
		if (empty($rekap_santri_tahfidz[$uid])) {$rekap_santri_tahfidz[$uid]=0;}
		if (empty($rekap_santri_tahsin[$uid])) {$rekap_santri_tahsin[$uid]=0;}
		if (empty($deadline_santri[$uid])) {$deadline_santri[$uid]['deadline']='0000-00-00';$deadline_santri[$uid]['status']='plan';}
		$warna_tahsin=qodr_warna_tahsin($rekap_santri_tahsin[$uid]);
		$warna_hafidz=qodr_warna_hafidz($rekap_santri_tahfidz[$uid]);
		$warna_deadline=qodr_warna_deadline($deadline_santri[$uid]);
		$html.="<tr><td>".($i++)."</td>
			<td>".$rekap_biodata[$uid]['nama']."<br>qodr :: ".$cabang_sekarang[$uid]."</td>
			<td>".$umur_santri[$uid]['tgl_join']."<br>".$umur_santri[$uid]['umur']."</td>
			<td>$uid<br>
				<a onclick='return ajax_get_biodata(\"".$uid."\")' class='btn btn-xs btn-".qodr_warna_persen_biodata($rekap_biodata[$uid]['persen'])."' data-toggle='modal' data-target='#exampleModal'>".$rekap_biodata[$uid]['persen']."%</a>
			</td>
			<td>
				<a onclick='return form_add_todo(\"".$uid."\")' class='btn btn-xs btn-default' data-toggle='modal' data-target='#exampleModal'><span class='fa fa-plus-circle'></span>&nbsp;</a>
				<a onclick='return ajax_get_todo(\"".$uid."\")' class='btn btn-xs btn-".$warna_deadline."' data-toggle='modal' data-target='#exampleModal'>".date("dMy",strtotime($deadline_santri[$uid]['deadline']))."</a>
			</td>
			<td><a onclick='return ajax_get_goal(\"".$uid."\",\"panjang\")' data-toggle='modal' data-target='#exampleModal' class='btn btn-xs btn-default' >panjang</a><br>
				<a onclick='return ajax_get_goal(\"".$uid."\",\"pendek\")' data-toggle='modal' data-target='#exampleModal' class='btn btn-xs btn-default' >pendek</a>
			</td>
			<td>
				<a onclick='return ajax_get_tahfidz(\"".$uid."\")' class='btn btn-xs btn-".$warna_hafidz."' data-toggle='modal' data-target='#exampleModal'>hafalan alquran : ".$rekap_santri_tahfidz[$uid]."</a><br>
				<a href='#' class='btn btn-xs btn-default' >sunnah</a>
				<a onclick='return ajax_get_tahsin(\"".$uid."\")' class='btn btn-xs btn-".$warna_tahsin."' data-toggle='modal' data-target='#exampleModal' >tahsin ".$rekap_santri_tahsin[$uid]."</a>
			</td>
			<td>c</td>
			<td><a href='admin.php?page=qodr-santri&santri_id=".$uid."&page2=santri-roadmap' class='btn btn-xs btn-default' >roadmap</a><br>
				<a href='#' class='btn btn-xs btn-info' >&nbsp;skill IT &nbsp;&nbsp;</a></td>
			<td>c</td>
			<td>grade</td>
			</tr>";
	}
	$html.='</table>';	
	$html.='</div></div>';	
	
	$btn_top="
		<div style='float:right;text-align:right;'>
			<a class='btn btn-xs btn-info btn-filter' href='admin.php?page=qodr-santri&santri=all'><span class=''>".$filter_btn['all']."</span> All</a>
			<a class='btn btn-xs btn-info btn-filter' href='admin.php?page=qodr-santri&santri=hq'><span class=''>".$filter_btn['hq']."</span> HQ</a>
			<a class='btn btn-xs btn-info btn-filter' href='admin.php?page=qodr-santri&santri=semarang'><span class=''>".$filter_btn['semarang']."</span> Semarang</a>
			<a class='btn btn-xs btn-info btn-filter' href='admin.php?page=qodr-santri&santri=pekalongan'><span class=''>".$filter_btn['pekalongan']."</span> Pekalongan</a>
			<a class='btn btn-xs btn-info btn-filter' href='admin.php?page=qodr-santri&santri=magelang'><span class=''>".$filter_btn['magelang']."</span> Magelang</a>
			<a class='btn btn-xs btn-info btn-filter' href='admin.php?page=qodr-santri&santri=magetan'><span class=''>".$filter_btn['magetan']."</span> Magetan</a>
			<a class='btn btn-xs btn-info btn-filter' href='admin.php?page=qodr-santri&santri=andalus'><span class=''>".$filter_btn['andalus']."</span> Andalus</a>
			<a class='btn btn-xs btn-info btn-filter' href='admin.php?page=qodr-santri&santri=samarinda'><span class=''>".$filter_btn['samarinda']."</span> Samarinda</a>
			<a onclick='return form_add_santri()' class='btn btn-xs btn-default btn-filter' data-toggle='modal' data-target='#exampleModal'><span class='fa fa-plus-circle'></span> Santri</a>
			<br>
			<a class='btn btn-xs btn-warning btn-filter' href='admin.php?page=qodr-santri&santri=hafidz'><span class=''>".$filter_btn['hafidz']."</span> Hafidz</a>
			<a class='btn btn-xs btn-warning btn-filter' href='admin.php?page=qodr-santri&santri=pkl'><span class=''>".$filter_btn['pkl']."</span> pkl</a>
			<a class='btn btn-xs btn-warning btn-filter' href='admin.php?page=qodr-santri&santri=santri_magang'><span class=''>".$filter_btn['santri_magang']."</span> Santri_magang</a>
			<a class='btn btn-xs btn-warning btn-filter' href='admin.php?page=qodr-santri&santri=santri_belajar'><span class=''>".$filter_btn['santri_belajar']."</span> Santri_belajar</a>
			<a class='btn btn-xs btn-warning btn-filter' href='admin.php?page=qodr-santri&santri=magang'><span class=''>".$filter_btn['magang']."</span> Magang</a>
			<a class='btn btn-xs btn-warning btn-filter' href='admin.php?page=qodr-santri&santri=cuti'><span class=''>".$filter_btn['cuti']."</span> Cuti</a>
			<a class='btn btn-xs btn-warning btn-filter' href='admin.php?page=qodr-santri&santri=tugas-belajar'><span class=''>".$filter_btn['tugas_belajar']."</span> Tugas Belajar</a>
			<a class='btn btn-xs btn-warning btn-filter' href='admin.php?page=qodr-santri&santri=alumni'><span class=''>".$filter_btn['alumni']."</span> Alumni</a>
			<a class='btn btn-xs btn-warning btn-filter' href='admin.php?page=qodr-santri&santri=dropout'><span class=''>".$filter_btn['dropout']."</span> Dropout</a>
			<a class='btn btn-xs btn-warning btn-filter' href='admin.php?page=qodr-santri&santri=ngilang'><span class=''>".$filter_btn['ngilang']."</span> Ngilang</a><br>
		</div><br><br>
		";
	$add_form=qodr_add_form_santri_view();
	$add_form.=qodr_add_form_todo_view();
	return $judul.$btn_top.$add_form.$html;
}
?>