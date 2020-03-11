<?php
function qodr_keuangan_view($dt){
	$user_cabang=get_user_meta(get_current_user_id(),'cabang_sekarang',1);
	extract($dt);
	$html='<script src="' . site_url() . '/wp-content/plugins/qodr/public/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" href="' . site_url() . '/wp-content/plugins/qodr/public/css/bootstrap.min.css">
		<link rel="stylesheet" href="' . site_url() . '/wp-content/plugins/qodr/public/css/qodr.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">';
	
	$btn_filter="<div style='float:right;text-align:right;margin:10px 22px;'>";
	for ($thn=2016; $thn <= date('Y'); $thn++) { 
		$btn_filter.="<a href='admin.php?page=qodr-keuangan&tahun=".$thn."&cabang=".$dt['cabang']." 'class='btn btn-xs btn-default btn-filter' ><span class='fa fa-money-circle'></span> ".$thn."</a>";	
	}
	$btn_filter.="</div>";

	$judul='<div class="container">
	<style>
		.btn-filter{
			margin:3px 1px;
		}
	</style>
	<div class="row">
		<h1>Rekap Keuangan</h1>'.$btn_filter;
	$script=qodr_script_keuangan();
	$html.=$script;
	if ($user_cabang != 'hq') {
	}else{
		$html.='<a href="admin.php?page=qodr-keuangan&cabang=all"><button type="button" class="btn btn-primary" style="margin-bottom:17px !important;margin-right:10px">All</button></a>
		<a href="admin.php?page=qodr-keuangan&cabang=hq"><button type="button" class="btn btn-primary" style="margin-bottom:17px !important;margin-right:10px">HQ</button></a>
		<a href="admin.php?page=qodr-keuangan&cabang=magelang"><button type="button" class="btn btn-success" style="margin-bottom:17px !important;margin-right:10px">Magelang</button></a>
		<a href="admin.php?page=qodr-keuangan&cabang=andalus"><button type="button" class="btn btn-info" style="margin-bottom:17px !important;margin-right:10px">Andalus</button></a>
		<a href="admin.php?page=qodr-keuangan&cabang=samarinda"><button type="button" class="btn btn-warning" style="margin-bottom:17px !important;margin-right:10px">Samarinda</button></a>'
		;
	}
	$html.='<style>
		.kanan{
			text-align:right;
		}
		.raw{
			display:none;
		}
	</style>
	<table class="table table-hover" style="width:98%;">
		<tr>
			<th>No</th>
			<th>Bulan</th>
			<th class="kanan">KAS</th>
			<th class="kanan">RAB</th>
			<th class="kanan">Terkumpul</th>
			<th class="kanan">Kekurangan</th>
			<th class="kanan">Pengeluaran</th>
		</tr>';
	
	$i=1;
	// echo "<pre>".print_r($rekap_keuangan_bulanan['raw'],1)."</pre>";
	$total['rab']=0;
	$total['kas']=0;
	$total['terkumpul']=0;
	$total['pengeluaran_real']=0;
	foreach ($rekap_keuangan_bulanan['summary'] as $bulan => $v) {
		$bulan1=str_replace(" ","",$bulan);
		$total['rab']+=$v['rab'];
		$total['kas']+=$v['kas'];
		$total['terkumpul']+=$v['terkumpul'];
		$total['pengeluaran_real']+=$v['pengeluaran_real'];
		$html.='
		<tr bgcolor="#f6f3f3" onclick="jQuery(\'.raw_'.$bulan1.'\').toggle();">
			<td>'.($i++).'</td>
			<td><b>'.$bulan.'</b></td>
			<td align=right ><b>'.number_format($v['kas']).'</b></td>
			<td align=right ><b>'.number_format($v['rab']).'</b></td>
			<td align=right ><b>'.number_format($v['terkumpul']).'</b></td>
			<td align=right ><b>'.number_format($v['terkumpul']-$v['rab']).'</b></td>
			<td align=right ><b>'.number_format($v['pengeluaran_real']).'</b></td>
		</tr>
		';	
		foreach ($rekap_keuangan_bulanan['raw'][$bulan] as $k => $v1) {
			$html.='
			<tr class="raw raw_'.$bulan1.'" >
				<td> </td>
				<td>'.$v1['cabang_id'].'</td>
				<td align=right ondblclick="return form_update_rekap_keuangan_bulanan(this,\'kas\',\''.$v1['id'].'\')">
					'.number_format($v1['kas']).'</td>
				<td align=right ondblclick="return form_update_rekap_keuangan_bulanan(this,\'rab\',\''.$v1['id'].'\')">
					'.number_format($v1['rab']).'</td>
				<td align=right  ondblclick="return form_update_rekap_keuangan_bulanan(this,\'terkumpul\',\''.$v1['id'].'\')">
					'.number_format($v1['terkumpul']).'</td>
				<td align=right ><b>'.number_format($v1['terkumpul']-$v1['rab']).'</b></td>
				<td align=right  ondblclick="return form_update_rekap_keuangan_bulanan(this,\'pengeluaran_real\',\''.$v1['id'].'\')">
					'.number_format($v1['pengeluaran_real']).'</td>
			</tr>
			';	
		}
	}
	$html.='
		<tr bgcolor="#f6f3f3">
			<td></td>
			<td><b>Total</b></td>
			<td align=right ><b>'.number_format($total['kas']).'</b></td>
			<td align=right ><b>'.number_format($total['rab']).'</b></td>
			<td align=right ><b>'.number_format($total['terkumpul']).'</b></td>
			<td align=right ><b>'.number_format($total['terkumpul']-$total['rab']).'</b></td>
			<td align=right ><b>'.number_format($total['pengeluaran_real']).'</b></td>
		</tr>
	</table>';	
	$html.='</div></div>';	
	return $judul.$html;
}


?>