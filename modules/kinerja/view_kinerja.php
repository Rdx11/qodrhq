<?php
function qodr_kinerja_view($dt,$view){
//userlogin	
$user_cabang=get_user_meta(get_current_user_id(),'cabang_sekarang',1);
//enduserlogin
	 //extract($dt);
	$tab=qodr_tab_kinerja_helper($_GET);
	$html=$view['script'].'
	<div class="container">
		<div class="row">
			<h1>Rekap Kinerja</h1>';
			if ($user_cabang != 'hq') {
			} else {
		$html .= '<a href="admin.php?page=qodr-kinerja&tab=survey&cabang=hq"><button type="button" class="btn btn-primary" style="margin-bottom:17px !important;margin-right:10px">HQ</button></a>	
			<a href="admin.php?page=qodr-kinerja&tab=survey&cabang=magelang"><button type="button" class="btn btn-success" style="margin-bottom:17px !important;margin-right:10px">Magelang</button></a>
			<a href="admin.php?page=qodr-kinerja&tab=survey&cabang=andalus"><button type="button" class="btn btn-info" style="margin-bottom:17px !important;margin-right:10px">Andalus</button></a>
			<a href="admin.php?page=qodr-kinerja&tab=survey&cabang=samarinda"><button type="button" class="btn btn-warning" style="margin-bottom:17px !important;">Samarinda</button></a>';			
			}
		$html .= '<ul class="nav nav-tabs">
				<li class="'.$tab['survey'].'"><a data-toggle="tab" href="#survey">Survey Pekanan</a></li>
				<li class="'.$tab['kinerja_pengurus'].'"><a data-toggle="tab" href="#kinerja-pengurus">Penilaian Program Kerja</a></li>
				<li class="'.$tab['summary'].'"><a data-toggle="tab" href="#summary">Summary Kinerja</a></li>
			</ul>
			<div class="tab-content">
				<div id="survey" class="tab-pane fade in '.$tab['survey'].'">
					'.$view['rekap_survey'].'
				</div>
				<div id="kinerja-pengurus" class="tab-pane fade in '.$tab['kinerja_pengurus'].'">
					'.$view['program_kerja'].'
				</div>
				<div id="summary" class="tab-pane fade in '.$tab['summary'].'">
					'.$view['summary'].'
				</div>
			</div>
		</div>
	</div>';
	$html.='';
	return $html;
}

