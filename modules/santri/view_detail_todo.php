<?php

function detail_todo_view($dt){
	$script='
	<script type="text/javascript">
		function ajax_update_todo(kolom,id,that){
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=update_todo&id="+id+"&kolom="+kolom+"&val="+jQuery(that).val(),
			    dataType : "html", 
			    method : "POST", 
			    success : function( r ){  
			    	jQuery("#notif-footer").html(r);
			    },
			    error : function(error){ console.log("asd"+error) }
			  });
			  return false;
		}
	</script>
	';
	$table='
	<style>
		.form_deadline{
			background:none  !important;
			border:none !important;
			width:85px;
			box-shadow:none !important;
		}
		.form_molor{
			width:50px;
			border:none !important;
			background:none !important;
			box-shadow:none !important;
		}
	</style>
	<table class="table table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>Tgl</th>
			<th>Keterangan</th>
			<th>Status</th>
			<th>Molor</th>
		</tr>
	</thead>
	<tbody>';
	foreach ($dt as $k => $v) {
		if ($v['status']=="proses") {
			$warna='#f0ad4e';
		}elseif ($v['status']=="failed") {
			$warna='#d9534f';
		}elseif ($v['status']=="done") {
			$warna='lightgreen';
		}else{
			$warna='none;color:black !important';
		}
		$table.="<tr id='data_todo_".$v['id']."' ><td >".($k+1)."</td>
			<td>".date("d M Y",strtotime($v['tgl']))."<br>
				<input class='form_deadline' type='text' onblur=\"return ajax_update_todo('deadline','$v[id]',this);\" value='$v[deadline]' >
			</td>
			<td>$v[do]</td>
			<td><select onchange=\"return ajax_update_todo('status','$v[id]',this);\" style='background:$warna;border: none;border-radius: 5px;color:white;'>
				<option value='$v[status]'> $v[status]</option>
				<option value='plan'> plan</option>
				<option value='proses'> proses</option>
				<option value='done'> done</option>
				<option value='failed'> failed</option>
			</td>
			<td class='molor'><input class='form_molor' type='number' onblur=\"return ajax_update_todo('molor','$v[id]',this);\" value='$v[molor]' ></td>
			<td><a onclick='return ajax_del_todo(\"".$v['id']."\")' class='btn btn-xs btn-danger' >x</a></td>
			</tr>";
	}
	$table.='
		</tbody>
	</table>';
	return $script.$table;
}

?>