<?php

function qodr_script_psb_view(){
	$script='
	<script type="text/javascript">
		function ajax_detail_psb(id){
			jQuery("#exampleModalLabel").html("Detail "+id);
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=detail_psb&id="+id,
			    method : "POST", 
			    success : function( r ){  
			    	jQuery(".modal-body").html(r);
			    	jQuery("#modal-save-btn").attr("onclick","return ajax_update_psb();");
			    },
			    error : function(error){ console.log(error) }
			});
			return false;
		}

		function ajax_update_psb(){
			jQuery("#notif-footer").html("Data sent... ");
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=update_psb&"+jQuery("#form").serialize(),
			    method : "POST", 
			    success : function( r ){  
			    	jQuery("#notif-footer").html(r);
			    },
			    error : function(error){ console.log(error) }
			});
			return false;
		}

		function ajax_delete_psb(id){
			if(confirm("ojo macem2 lo..")){
				jQuery.ajax({
				    url : "'.site_url().'/wp-admin/admin-ajax.php",
				    data : "action=delete_psb&id="+id,
				    method : "POST", 
				    success : function( r ){  
				    	jQuery("#tr_"+id).hide();
				    },
				    error : function(error){ console.log(error) }
				});
				return false;
			}
		}
	</script>
	';
	return $script;
}
?>