<?php
function qodr_kinerja_program_kerja_view($kinerja_pengurus,$kinerja_summary,$tanggal_rapat){
	$cabang = get_user_meta(get_current_user_id(),'cabang_sekarang',1);
	$html='
		<h5>Tanggal : '.$tanggal_rapat.' </h5>
		<p>
			<form id="form_kinerja_pengurus">
			<input type=hidden name=ksummary_id id="ksummary_id" value="'.$kinerja_summary['id'].'"  >
			<input type=hidden name=kunci id="kunci" value="'.$kinerja_summary['kunci'].'"  >
			<div class="divisi div_it">
				<h4>Div IT</h4>
				<table>';
				foreach($kinerja_pengurus['it'] as $k=>$v){
					if($v['aktif']=='aktif'){
						$skip=qodr_skip_kinerja_program_helper($v['hitung']);
						$html.='
						<tr class="program_it">
							<td><'.$skip['label'].' onclick="return skip_program(this,0)">'.$v['program'].'</'.$skip['label'].'><input type=hidden id="'.$skip['id_program'].'program_'.$v['program'].'" name=program['.$v['program'].'] value="'.$skip['val_nilai'].$v['nilai'].'"></td>
							<td align=right class="td_'.$v['program'].'">';
							for ($i=1; $i<=$v['nilai'] ; $i++) { 
								$html.='<i class="fa fa-star bintang_'.$i.' '.$skip['kuning'].'" onclick="return update_poin(this,\'it\',\''.$v['program'].'\','.$i.');"></i> ';
							}
							for ($i=($v['nilai']+1); $i<=5 ; $i++) { 
								$html.='<i class="fa fa-star bintang_'.$i.' abu" onclick="return update_poin(this,\'it\',\''.$v['program'].'\','.$i.');"></i> ';
							}
							$html.='
							</td>
						</tr>
						';
					}
				}
				$html.='
					<tr class="total">
						<td><b>Total Poin</b></td>
						<td class="total_bintang_it" align=right ></td>
					</tr>
					<tr>
						<td><b>Rata-rata</b></td>
						<td class="total_it" align=right ></td>
					</tr>
				</table>
			</div>
			<div class="divisi div_agama">
				<h4>Div Agama</h4>
				<table>';
				foreach($kinerja_pengurus['agama'] as $k=>$v){
					if($v['aktif']=='aktif'){
						$skip=qodr_skip_kinerja_program_helper($v['hitung']);
						$html.='
						<tr class="program_agama">
							<td><'.$skip['label'].' onclick="return skip_program(this,0)">'.$v['program'].'</'.$skip['label'].'><input type=hidden id="'.$skip['id_program'].'program_'.$v['program'].'" name=program['.$v['program'].'] value="'.$skip['val_nilai'].$v['nilai'].'"></td>
							<td align=right class="td_'.$v['program'].'">';
							for ($i=1; $i<=$v['nilai'] ; $i++) { 
								$html.='<i class="fa fa-star bintang_'.$i.' '.$skip['kuning'].'" onclick="return update_poin(this,\'agama\',\''.$v['program'].'\','.$i.');"></i> ';
							}
							for ($i=($v['nilai']+1); $i<=5 ; $i++) { 
								$html.='<i class="fa fa-star bintang_'.$i.' abu" onclick="return update_poin(this,\'agama\',\''.$v['program'].'\','.$i.');"></i> ';
							}
							$html.='</td>
						</tr>
						';
					}
				}
				$html.='
					<tr class="total">
						<td><b>Total Poin</b></td>
						<td class="total_bintang_agama" align=right ></td>
					</tr>
					<tr>
						<td><b>Rata-rata</b></td>
						<td class="total_agama" align=right ></td>
					</tr>
				</table>
			</div>
			<div class="divisi">
				<div class="div_publikasi">
					<h4>Div Publikasi</h4>
					<table>';
					foreach($kinerja_pengurus['publikasi'] as $k=>$v){
						if($v['aktif']=='aktif'){
							$skip=qodr_skip_kinerja_program_helper($v['hitung']);
							$html.='
							<tr class="program_publikasi">
								<td><'.$skip['label'].' onclick="return skip_program(this,0)">'.$v['program'].'</'.$skip['label'].'><input type=hidden id="'.$skip['id_program'].'program_'.$v['program'].'" name=program['.$v['program'].'] value="'.$skip['val_nilai'].$v['nilai'].'"></td>
								<td align=right >';
								for ($i=1; $i<=$v['nilai'] ; $i++) { 
									$html.='<i class="fa fa-star bintang_'.$i.' '.$skip['kuning'].'" onclick="return update_poin(this,\'publikasi\',\''.$v['program'].'\','.$i.');"></i> ';
								}
								for ($i=($v['nilai']+1); $i<=5 ; $i++) { 
									$html.='<i class="fa fa-star bintang_'.$i.' abu" onclick="return update_poin(this,\'publikasi\',\''.$v['program'].'\','.$i.');"></i> ';
								}
								$html.='</td>
							</tr>
							';
						}
					}
					$html.='
						<tr class="total">
							<td><b>Total Poin</b></td>
							<td class="total_bintang_publikasi" align=right ></td>
						</tr>
						<tr>
							<td><b>Rata-rata</b></td>
							<td class="total_publikasi" align=right ></td>
						</tr>
					</table>
				</div>
				<div class="div_administrasi">
					<h4>Div Administrasi</h4>
					<table>';
					foreach($kinerja_pengurus['administrasi'] as $k=>$v){
						if($v['aktif']=='aktif'){
							$skip=qodr_skip_kinerja_program_helper($v['hitung']);
							$html.='
							<tr class="program_administrasi">
								<td><'.$skip['label'].' onclick="return skip_program(this,0)">'.$v['program'].'</'.$skip['label'].'><input type=hidden id="'.$skip['id_program'].'program_'.$v['program'].'" name=program['.$v['program'].'] value="'.$skip['val_nilai'].$v['nilai'].'"></td>
								<td align=right >';
								for ($i=1; $i<=$v['nilai'] ; $i++) { 
									$html.='<i class="fa fa-star bintang_'.$i.' '.$skip['kuning'].'" onclick="return update_poin(this,\'administrasi\',\''.$v['program'].'\','.$i.');"></i> ';
								}
								for ($i=($v['nilai']+1); $i<=5 ; $i++) { 
									$html.='<i class="fa fa-star bintang_'.$i.' abu" onclick="return update_poin(this,\'administrasi\',\''.$v['program'].'\','.$i.');"></i> ';
								}
								$html.='</td>
							</tr>
							';
						}
					}
					$html.='
						<tr class="total">
							<td><b>Total Poin</b></td>
							<td class="total_bintang_administrasi" align=right ></td>
						</tr>
						<tr>
							<td><b>Rata-rata</b></td>
							<td class="total_administrasi" align=right ></td>
						</tr>
					</table>
				</div> 
				<div class="div_keuangan">
					<h4>Div Keuangan</h4>
					<table>';
					foreach($kinerja_pengurus['keuangan'] as $k=>$v){
						if($v['aktif']=='aktif'){
							$skip=qodr_skip_kinerja_program_helper($v['hitung']);
							$html.='
							<tr class="program_keuangan">
								<td><'.$skip['label'].' onclick="return skip_program(this,0)">'.$v['program'].'</'.$skip['label'].'><input type=hidden id="'.$skip['id_program'].'program_'.$v['program'].'" name=program['.$v['program'].'] value="'.$skip['val_nilai'].$v['nilai'].'"></td>
								<td align=right >';
								for ($i=1; $i<=$v['nilai'] ; $i++) { 
									$html.='<i class="fa fa-star bintang_'.$i.' '.$skip['kuning'].'" onclick="return update_poin(this,\'keuangan\',\''.$v['program'].'\','.$i.');"></i> ';
								}
								for ($i=($v['nilai']+1); $i<=5 ; $i++) { 
									$html.='<i class="fa fa-star bintang_'.$i.' abu" onclick="return update_poin(this,\'keuangan\',\''.$v['program'].'\','.$i.');"></i> ';
								}
								$html.='</td>
							</tr>
							';
						}
					}
					$html.='
						<tr class="total">
							<td><b>Total Poin</b></td>
							<td class="total_bintang_keuangan" align=right ></td>
						</tr>
						<tr>
							<td><b>Rata-rata</b></td>
							<td class="total_keuangan" align=right ></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="divisi summary">
				<h4>Total Summary</h4>
				<table>
					<tr>
						<td><b>Div IT</b><input type=hidden id="summary_it" name=summary[div_it] value= ></td>
						<td class="total_it" align=right ></td>
					</tr>
					<tr>
						<td><b>Div Agama</b><input type=hidden id="summary_agama" name=summary[div_agama] value= ></td>
						<td class="total_agama" align=right ></td>
					</tr>
					<tr>
						<td><b>Div Publikasi</b><input type=hidden id="summary_publikasi" name=summary[div_publikasi] value= ></td>
						<td class="total_publikasi" align=right ></td>
					</tr>
					<tr>
						<td><b>Div Administrasi</b><input type=hidden id="summary_administrasi" name=summary[div_administrasi] value= ></td>
						<td class="total_administrasi" align=right ></td>
					</tr>
					<tr>
						<td><b>Div Keuangan</b><input type=hidden id="summary_keuangan" name=summary[div_keuangan] value= ></td>
						<td class="total_keuangan" align=right ></td>
					</tr>
					<tr>
						<td><b>Kedisiplinan</b></td>
						<td class="total_kedisiplinan" align=right ><input type=text style="text-align:right;background:none;border:0px;box-shadow:none;width:60px;" id="summary_kedisiplinan" name=summary[kedisiplinan] value="'.$kinerja_summary['kedisiplinan'].'" onblur="return hitung_summary()" ></td>
					</tr>
					<tr>
						<td><b>Kenyamanan</b></td>
						<td class="total_kenyamanan" align=right ><input type=text style="text-align:right;background:none;border:0px;box-shadow:none;width:60px;" id="summary_kenyamanan" name=summary[kenyamanan] value="'.$kinerja_summary['kenyamanan'].'" onblur="return hitung_summary()"></td>
					</tr>
					<tr class="total">
						<td><b>Total Poin</b><input type=hidden id="summary_total_poin" name=summary[total_poin] value= ></td>
						<td id="total_summary" align=right ></td>
					</tr>
					<tr>
						<td><b>Rata-rata</b><input type=hidden id="summary_bintang" name=summary[bintang] value= ></td>
						<td id="skala5" align=right ></td>
					</tr>
				</table>
				<table align=center id="selamat" style="display:none;">
					<tr>
						<td align=right valign=bottom ><i class="fa fa-star kuning" style="font-size:40px;"></i> </td>
						<td align=center ><i class="fa fa-star kuning" style="font-size:80px;"></i> </td>
						<td valign=bottom ><i class="fa fa-star kuning" style="font-size:40px;"></i> </td>
					</tr>
					<tr>
						<td colspan="3" align=center style="background:rgba(7, 224, 53, 0.4);border-top:1px solid gray;border-bottom:1px solid gray;">Selamat... Target <b>Tercapai</b><br>Makan2 yey..</td>
					</tr>
				</table>
			</div>
			<br style="clear:both;">
			
			<div style="float:left;">Catatan : <br><textarea cols=65 rows=30 id=summary_catatan name=summary[catatan] >'.$kinerja_summary['catatan'].'</textarea></div>
			<table style="float:left;margin:15px 15px;">
				<tr>
					<td>Tanggal </td><td>: <input type=date id=summary_tgl name=summary[tgl] value="'.$kinerja_summary['tgl'].'"></td>
				</tr>
				<tr>
					<td>Target Poin </td><td>: <input type=text id=summary_target_poin name=summary[target_poin] value="'.$kinerja_summary['target_poin'].' "  ></td>
				</tr>
				<tr>
					<td>Ketua </td><td>: <input type=text id=ketua name=summary[ketua] value="'.$kinerja_summary['ketua'].' " ></td>
				</tr>
				<tr>
					<td>PJ Administrasi </td><td>: <input type=text id=administrasi name=summary[pj_administrasi] value="'.$kinerja_summary['pj_administrasi'].' " ></td>
				</tr>
				<tr>
					<td>PJ Keuangan </td><td>: <input type=text id=bendahara name=summary[pj_keuangan] value="'.$kinerja_summary['pj_keuangan'].' " ></td>
				</tr>
				<tr>
					<td>PJ Div IT</td><td>: <input type=text id=it name=summary[pj_it] value="'.$kinerja_summary['pj_it'].' " ></td>
				</tr>
				<tr>
					<td>PJ Div Agama</td><td>: <input type=text id=majelis name=summary[pj_agama] value="'.$kinerja_summary['pj_agama'].' " ></td>
				</tr>
				<tr>
					<td>PJ Div Publikasi </td><td>: <input type=text id=publikasi name=summary[pj_publikasi] value="'.$kinerja_summary['pj_publikasi'].' " ></td>
				</tr>
				<tr>
					<td>Cabang</td><td>: <select class="form_cabang" name=summary[cabang_id] value="'.$kinerja_summary['cabang_id'].'">
					<option value="">'.$kinerja_summary['cabang_id'].'</option>
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
				<tr>
					<td><input type=button value="save" class="btn btn-md btn-primary" onclick="return ajax_save_kinerja_pengurus()" > </td>
					<td>
						<span class="n"></span>
					</td>
				</tr>
			</table>
			</form>
		</p>
	';
	return $html;
}