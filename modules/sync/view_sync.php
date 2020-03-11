<?php

function qodr_sync_view($dt){
	extract($dt);
	$html='<script src="' . site_url() . '/wp-content/plugins/qodr/public/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" href="' . site_url() . '/wp-content/plugins/qodr/public/css/bootstrap.min.css">
		<link rel="stylesheet" href="' . site_url() . '/wp-content/plugins/qodr/public/css/qodr.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">';
	$btn_filter="<div style='text-align:left;margin:10px 0px;'>
		<a class='btn btn-xs btn-default btn-filter' href='admin.php?page=qodr-sync&filter=sync-all' ><span class='fa fa-refresh'></span> Sync All</a>
		</div>";

	$judul='<div class="container">
	<style>
		.btn-filter{
			margin:3px 1px;
		}
	</style>
	<div class="row">
		<h1>List Sync Module</h1>'.$btn_filter;
	$script='<script>
		function change_sync(that,key,val){
			jQuery.ajax({
				url : "'.site_url().'/wp-admin/admin-ajax.php",
				data : "action=change_sync&key="+key+"&val="+val, 
				method : "POST", 
				success : function( r ){  
					jQuery(that).parent().html(r);
				},
				error : function(error){ console.log(error) }
			});
			return false;

		}
	</script>';

	$html.=$script.'
	<style> 

	</style>
	<table class="table table-hover" style="width:40%;float:left;">
		<tr bgcolor="#f6f3f3">
			<th>No</th>
			<th>Module</th>
			<th>Status</th>
		</tr>';
		$i=1;
	foreach ($list_sync as $k => $v) {
		if ($v['meta_val']=='off') {
			$check="<span class='btn-sm btn-success' onclick='return change_sync(this,\"".$v['meta_key']."\",\"".$v['meta_val']."\");'> up to date</span>";
		}else{
			$check="<span class='btn-sm btn-danger' onclick='return change_sync(this,\"".$v['meta_key']."\",\"".$v['meta_val']."\");'> out of date</span>";
		}
		
		$html.='
		<tr >
			<td>'.($i++).'</td>
			<td>'.$v['meta_key'].'</td>
			<td>'.$check.'</td>
		</tr>
		';	
	}
	$html.='</table>
		<div style="float:left;margin-left:10px;">'.$res_sync_all.'</div>
	';	
	$html.='</div></div>';	
	return $judul.$html;
}

?>