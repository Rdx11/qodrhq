<?php

function qodr_detail_psb_view($dt){
	$detail='
		
		<style>
			td{
				border-bottom:1px solid gray;
				padding:5px;
			}
		</style>
		<table style="width:100%;">';
		foreach ($dt as $k => $v) {
			if ($k=='id') {
				$id=$v;
			}elseif ($k=='status_daftar') {
				$status_daftar='<select name="status_daftar">
						<option value="'.$v.'">'.$v.'</option>
						<option value="seed">seed</option>
						<option value="menyusul">menyusul</option>
						<option value="ngilang">ngilang</option>
						<option value="gagal">gagal</option>
						<option value="wawancara">wawancara</option>
						<option value="tes-online">tes-online</option>
						<option value="tes-offline">tes-offline</option>
						<option value="lulus">lulus</option>
					</select>
				';$v;
			}elseif ($k=='ket') {
				$detail.='
				<tr valign=bottom >
					<td>'.$k.'</td>
					<td ><textarea name="ket" style="width:98%;height:50px;">'.$v.'</textarea>
				</tr>
				';
			}else{
				$detail.='
				<tr>
					<td>'.$k.'</td>
					<td>: '.$v.'</td>
				</tr>
				';
			}
		}
		$detail.='
				<tr>
					<td>status_daftar</td>
					<td>: '.$status_daftar.'</td>
				</tr>
				';
	$detail.='</table>
		<input type="hidden" name="id" value="'.$id.'">
	';
	return $detail;
}