<?php

function qodr_add_form_todo_view(){
	$form='<div id="div_add_todo" style="display:none;">
		<table class="table table-hover ">
			<thead>
				<tr>
					<th>Keterangan</th>
					<th>Input</th>
				</tr>
			</thead>
			<tbody>
				<tr><td>do</td><td><textarea class="form_biodata" name="do" rows="2"></textarea></td></tr>
				<tr><td>deadline</td><td><input class="form_biodata" type="date" name="deadline" value="'.date('Y-m-d').'"></td></tr>
				<tr><td>status</td><td><select class="form_biodata" name="status">
					<option value="proses">proses</option>
					<option value="plan">plan</option>
					<option value="done">done</option>
					<option value="failed">failed</option>
					</select></td>
				</tr>
			</tbody>
		</table>
	</div>';
	return $form;	
}

function qodr_add_form_santri_view(){
	$form_tambah='
	<div id="div_tambah_santri" style="display:none;">
		<table class="table table-hover ">
			<thead>
				<tr>
					<th>Data</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<tr><td>uid</td><td><input type="text" class="form_biodata" name="uid" value=""></td></tr>
				<tr><td>nama</td><td><input type="text" class="form_biodata" name="nama" value=""></td></tr>
				<tr><td>cabang_sekarang</td><td><select class="form_biodata" name="cabang_sekarang">
					<option value="">--pilih cabang--</option>
					<option value="andalus">andalus</option>
					<option value="hq">hq</option>
					<option value="magelang">magelang</option>
					<option value="magetan">magetan</option>
					<option value="pekalongan">pekalongan</option>
					<option value="semarang">semarang</option>
					<option value="qodrbee">qodrbee</option>
					<option value="samarinda">samarinda</option>

					</select></td>
				</tr>
				<tr><td>panggilan</td><td><input type="text" class="form_biodata" name="panggilan" value=""></td></tr>
				<tr><td>kota_asal</td><td><input type="text" class="form_biodata" name="kota_asal" value=""></td></tr>
				<tr><td>no_telp</td><td><input type="text" class="form_biodata" name="no_telp" value=""></td></tr>
				<tr><td>nama_ortu</td><td><input type="text" class="form_biodata" name="nama_ortu" value=""></td></tr>
				<tr><td>no_telp_ortu</td><td><input type="text" class="form_biodata" name="no_telp_ortu" value=""></td></tr>
				<tr><td>alamat</td><td><textarea class="form_biodata" name="alamat" rows="2"></textarea></td></tr>
				<tr><td>email</td><td><input type="email" class="form_biodata" name="email" value=""></td></tr>
				<tr><td>fokus</td><td><select class="form_biodata" name="fokus">
					<option value="">Bingung</option>
					<option value="Frontend Developer">Frontend Developer</option>
					<option value="Backend Developer">Backend Developer</option>
					<option value="Mobile Developer">Mobile Developer</option>
					<option value="Internet Marketing">Internet Marketing</option>
					<option value="Designer">Designer</option>
					</select></td>
				</tr>
				<tr><td>tgl_join</td><td><input class="form_biodata" type="date" name="tgl_join" value="'.date('Y-m-d').'"></td></tr>
				
			</tbody>
		</table>
	</div>
	';
	return $form_tambah;
}
?>