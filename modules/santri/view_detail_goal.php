<?php

function qodr_detail_goal_view($dt,$uid){

	$script='
	<script type="text/javascript">
		function ajax_change_status_goal(that,id){
			var status=jQuery(that).val();
			jQuery("#notif-footer").html("Tunggu update...");
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=change_status_goal&id="+id+"&status="+status,
			    dataType : "html", 
			    method : "POST", 
			    success : function( uid ){  
			    	jQuery("#notif-footer").html("updated.");
			    },
			    error : function(error){ console.log(error) }
			});
			return false;
		}
		function ajax_del_goal(id){
			jQuery("#notif-footer").html("Tunggu delete...");
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=del_goal&id="+id,
			    dataType : "html", 
			    method : "POST", 
			    success : function( r ){
			    	jQuery(".tr-goal-"+r).remove();  
			    	jQuery("#notif-footer").html("deleted.");
			    },
			    error : function(error){ console.log(error) }
			});
			return false;
		}
		function ajax_add_tahsin(uid){
			var nilai=jQuery("#nilai_tahsin").val();
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=add_tahsin&uid="+uid+"&nilai="+nilai,
			    dataType : "html", 
			    method : "POST", 
			    success : function( r ){  
			    	ajax_get_tahsin(r);
			    },
			    error : function(error){ console.log(error) }
			  });
			  return false;
		}
	</script>
	';
	$table='
	<table class="table table-hover">
	<tbody class="body-tahsin">';
	foreach ($dt as $k => $v) {
		$table.="<tr class='tr-goal-$v[id]'>
			<td>".($k+1)."
				<button class='btn btn-xs btn-danger' onclick='return ajax_del_goal(".$v['id'].")'>x</button>
				<select onchange='return ajax_change_status_goal(this,$v[id])'>
					<option value='".$v['status']."'>".$v['status']."</option>
					<option value='plan'>plan</option>
					<option value='progress'>progress</option>
					<option value='done'>done</option>
					<option value='cancel'>cancel</option>
					<option value='stagnan'>stagnan</option>
				</select>
			</td>
			<td align=left >Start : ".date("d F Y",strtotime($v['set_goal']))."</td>
			<td align=right >Deadline : ".date("d F Y",strtotime($v['deadline']))."</td>
		</tr>";
		$table.="<tr class='tr-goal-$v[id]'>
				<td  colspan=3 >
					$v[ket]<br><br>
				</td>
			</tr>";
	}
	$table.='
		</tbody>
	</table>';
	
	return $script.$table;
}