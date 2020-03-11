<?php
function qodr_summary_chart(){
	$cabang=get_user_meta(get_current_user_id(),'cabang_sekarang',1);
	$db=qodr_sql("select target_poin,total_poin,DATE_FORMAT(tgl,'%d %M %Y') as tgl from kinerja_summary where cabang_id='$cabang' order by id desc limit 12");
	
	wp_die(json_encode($db));
}
function qodr_summary_table_view($cabangq){
    $cabang=get_user_meta(get_current_user_id(),'cabang_sekarang',1);
	$db=qodr_sql("select * from kinerja_summary where cabang_id='$cabangq' order by tgl desc limit 12");
	$table='<table class="table">
	<thead>
		<tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>Div IT</th>
			<th>Div Agama</th>
			<th>Div Publikasi</th>
			<th>Div Administrasi</th>
			<th>Div Keuangan</th>
			<th>Kedisiplinan</th>
			<th>Kenyamanan</th>
			<th>Poin</th>
			<th>Target</th>
			<th>Bintang</th>
		</tr>
	</thead>';
	foreach ($db as $k => $v) {
		if ($v['total_poin']>=$v['target_poin']) {
			$warna="style='background:#acfdd0;'";
		}else{
			$warna="style='background:#fdacac;'";
		}
		$table.="<tr $warna>
			<td>".($k+1)."</td>
			<td>".date("dMy",strtotime($v['tgl']))."</td>
			<td>$v[div_it]</td>
			<td>$v[div_agama]</td>
			<td>$v[div_publikasi]</td>
			<td>$v[div_administrasi]</td>
			<td>$v[div_keuangan]</td>
			<td>$v[kedisiplinan]</td>
			<td>$v[kenyamanan]</td>
			<td>$v[total_poin]</td>
			<td>$v[target_poin]</td>
			<td>$v[bintang]</td>
		</tr>";
	}
	$table.='</table>';
	return $table;
}