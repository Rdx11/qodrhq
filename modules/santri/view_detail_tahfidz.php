<?php

function detail_tahfidz_view($view){
	extract($view);
	$head="<div>Hafal : ".$hafal." | Belum Hafal : ".$blm_hafal."</div>";
	$script='
	<script type="text/javascript">
		function ajax_update_hafal(id,hafal,warna){
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "warna="+warna+"&hafal="+hafal+"&action=update_tahfidz&id="+id,
			    dataType : "json", 
			    method : "POST", 
			    success : function( r ){  
			    	jQuery(".btn_"+id).removeClass("btn-"+warna);
					jQuery(".btn_"+id).addClass("btn-"+r.warna);
			    	jQuery(".btn_"+id).html(r.hafal);
			    	jQuery(".btn_"+id).attr("onclick","return ajax_update_hafal(\'"+id+"\',\'"+r.hafal+"\',\'"+r.warna+"\')");
			    },
			    error : function(error){ console.log(error) }
			  });
			  return false;
		}
	</script>
	';
	$table='
	<table class="table table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Surat</th>
			<th>Tanggal</th>
			<th>Hafal</th>
		</tr>
	</thead>
	<tbody>';
	foreach ($data as $k => $v) {
		$table.="<tr><td>$v[id]</td><td>$v[no_surat]. $v[nama_surat]</td><td>".date("d F Y",strtotime($v['tgl']))."</td>
			<td><button onclick=\"return ajax_update_hafal('$v[id]','$v[hafal]','$warna[$k]');\" class='btn_$v[id] btn btn-".$warna[$k]." btn-xs'><span class='fa fa-cross-circle'></span> $v[hafal]</button></td></tr>";
	}
	$table.='
		</tbody>
		<tfoot>
			<tr>
				<th>Id</th>
				<th>Surat</th>
				<th>Tanggal</th>
				<th>Hafal</th>
			</tr>
		</tfoot>
	</table>';
	
	return $script.$head.$table;
}

?>