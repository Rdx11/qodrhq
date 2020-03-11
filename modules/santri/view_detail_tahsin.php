<?php

function qodr_detail_tahsin_view($dt,$uid){
	
	$script='
	<script type="text/javascript">
		function ajax_add_tahsin(uid){
			var nilai=jQuery("#nilai_tahsin").val();
			var keterangan=jQuery("#keterangan").val();
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=add_tahsin&uid="+uid+"&nilai="+nilai+"&keterangan="+keterangan,
			    dataType : "html", 
			    method : "POST", 
			    success : function( r ){  
			    	ajax_get_tahsin(r);
			    },
			    error : function(error){ console.log(error) }
			  });
			  return false;
		}
		function ajax_del_tahsin(id){
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=del_tahsin&id="+id,
			    dataType : "html", 
			    method : "POST", 
			    success : function( r ){  
			    	jQuery(".tr_tahsin_"+r).remove();
			    },
			    error : function(error){ console.log(error) }
			  });
			  return false;
		}
	</script>
	';
	$table='
	Nilai sekarang : <input type="text" style="width:50px;" id="nilai_tahsin" > <br>
	Keterangan : <input type="text" style="width:70%;" id="keterangan" >
		<button onclick="return ajax_add_tahsin(\''.$uid.'\');" class="btn btn-primary btn-sm"> save </button><br>
	<table class="table table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Tanggal</th>
			<th>Nilai</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody class="body-tahsin">';
	foreach ($dt as $k => $v) {
		$table.="<tr class='tr_tahsin_$v[id]'><td>$v[id]</td><td>".date("d F Y",strtotime($v['tgl']))."</td>
			<td>$v[nilai]</td>
			<td>$v[keterangan]</td>
			<td><button class='btn btn-xs btn-danger' onclick='return ajax_del_tahsin(".$v['id'].")'>x</button></td>
			</tr>";
	}
	$table.='
		</tbody>
		<tfoot>
			<tr>
				<th>Id</th>
				<th>Tanggal</th>
				<th>Nilai</th>
				<th>Keterangan</th>
			</tr>
		</tfoot>
	</table>';
	
	return $script.$table;
}