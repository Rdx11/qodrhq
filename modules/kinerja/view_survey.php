<?php
function qodr_kinerja_survey_pekanan_view($dt){
	$html='
	<h3>Survey Pekanan</h3>
	<p>
	'.$dt['tanggal_survey'].'
	<div>
		Tgl Awal: <input type="date" id="tgl_awal">&nbsp;
		Tgl Akhir: <input type="date" id="tgl_akhir">&nbsp;
		<button class="btn btn-primary" onclick="return ajax_convert_tgl();">Convert</button>
	</div>
	<table class="table table-hover" style="width:38%;">
		<tr>
			<th>No</th>
			<th>Survey</th>
			<th></th>
			<th></th>
		</tr>';	
	$i=1;
	$j=1;
	// echo "<pre>".print_r($rekap_keuangan_bulanan['raw'],1)."</pre>";
	$total=0;	
	foreach ((array)$dt['rekap_survey'] as $key => $val) {
		$html.='
			<tr bgcolor="#f6f3f3" onclick="jQuery(\'.key_'.$key.'\').toggle();">
				<td>'.($i++).'</td>
				<td><b class="value">'.$key.'</b></td>
				<td></td>
				<td></td>
			</tr>
			';
		foreach ($val as $k => $v) {
			$total+=$v['jml'];
			$j++;
			$html.='
			<tr style="display:none;" class="key_'.$key.'">
				<td></td>
				<td nowrap class="survey_jawaban" jawaban="'.$v['survey_val'].'">&rarr; '.$v['survey_val'].'</td>
				<td class="survey_jumlah" >'.number_format($v['jml']).'</td>
				<td>'.$v['siapa'].'</td>
			</tr>
			';
		}
	}

	$html.='
	</table>
	</p>';	
	return $html.script_survey_view();
}

