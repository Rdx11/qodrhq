<?php

function qodr_detail_biodata_view($dt,$cabang){
	$table='
	<form id="form_biodata">
	<table class="table table-hover">
	<thead>
		<tr>
			<th>Data</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>';

	foreach ($dt as $k => $v) {
		foreach ($v as $kolom => $isi) {
			if ($kolom=='uid' or $kolom=='last_update') {
				$isi="$isi<input type='hidden' name='$kolom' value='$isi'>";
			}else{
				if ($kolom=='tgl_join') {
					$isi="<input class='form_biodata' type='date' name='$kolom' value='$isi'>";
				}elseif ($kolom=='alamat') {
					$isi="<textarea class='form_biodata' name='$kolom' rows=2 >$isi</textarea>";
				}elseif ($kolom=='status_santri') {
					$isi="<select class='form_biodata' name='$kolom'>
						<option value='$isi'>$isi</option>
						<option value='seed'>seed</option>
						<option value='psb'>psb</option>
						<option value='santri_belajar'>santri_belajar</option>
						<option value='alumni'>alumni</option>
						<option value='dropout'>dropout</option>
						<option value='ngilang'>ngilang</option>
						<option value='cuti'>cuti</option>
						<option value='magang'>magang</option>
						<option value='santri_magang'>santri_magang</option>
						<option value='tugas-belajar'>tugas-belajar</option>
						";
					$isi.="</select>";
				}elseif ($kolom=='cabang_sekarang') {
					$isi="<select class='form_biodata' name='$kolom'>
						<option value='$isi'>$isi</option>";
						foreach ($cabang as $k => $v) {
							$isi.="<option value='$v[id]'>$v[id]</option>";
						}
					$isi.="</select>";
				}elseif ($kolom=='fokus') {
					$isi="<select class='form_biodata' name='$kolom'>
					    <option value='$isi'>$isi</option>
						<option value='Bingung'>Bingung</option>
						<option value='Backend Developer'>Backend Developer</option>
						<option value='Frontend Developer'>Frontend Developer</option>
						<option value='Designer'>Designer</option>
						<option value='Internet Marketing'>Internet Marketing</option>
						<option value='Mobile Developer'>Mobile Developer</option>
						";
					$isi.="</select>";
				}
				else{
					$isi="<input type='text' class='form_biodata' name='$kolom' value='$isi'>";
				}
			}
			$table.="<tr><td>$kolom</td><td>$isi</td></tr>";
		}
	}
	$table.='</tbody>
	</table>
	</form>';
	return $table;
}
?>