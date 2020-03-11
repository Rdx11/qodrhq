<?php

function qodr_script_santri(){
	$script='
	<script type="text/javascript">
		

		function ajax_del_todo(id){
			if(confirm("yakin dihapus?")){
				jQuery.ajax({
				    url : "'.site_url().'/wp-admin/admin-ajax.php",
				    data : "action=del_todo&id="+id,
				    method : "POST", 
				    success : function( r ){  
				    	jQuery("#data_todo_"+r).hide();
				    },
				    error : function(error){ console.log(error) }
				});
				return false;
			}
		}

		function form_add_todo(santri_id){
			jQuery("#notif-footer").html("");
			var form=jQuery("#div_add_todo").html();
			jQuery(".modal-body").html(form);
			jQuery("#exampleModalLabel").html("Form Tambah Todo <b>"+santri_id+"</b>");
			jQuery("#modal-save-btn").attr("onclick","return ajax_add_todo(\'"+santri_id+"\')");
			return false;
		}

		function ajax_add_todo(santri_id){
			jQuery("#notif-footer").html("Data Sent...");
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : jQuery("#form_tahfidz").serialize()+"&action=add_todo&santri_id="+santri_id,
			    method : "POST", 
			    success : function( response ){  
			    	jQuery("#notif-footer").html(response);
			    },
			    error : function(error){ console.log(error) }
			});
			return false;
		}

		function ajax_add_santri(){
			jQuery("#notif-footer").html("Data Sent...");
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : jQuery("#form_tahfidz").serialize()+"&action=add_santri",
			    method : "POST", 
			    success : function( response ){  
			    	jQuery("#notif-footer").html(response);
			    },
			    error : function(error){ console.log(error) }
			});
			return false;
		}

		
		function form_add_santri(){
			jQuery("#notif-footer").html("");
			var form=jQuery("#div_tambah_santri").html();
			jQuery(".modal-body").html(form);
			jQuery("#exampleModalLabel").html("Form Tambah Santri");
			jQuery("#modal-save-btn").attr("onclick","return ajax_add_santri()");
			return false;
		}

		function ajax_get_tahfidz(uid){
			jQuery(".modal-body").html("");
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=get_tahfidz&uid="+uid,
			    method : "POST", 
			    success : function( response ){  
			    	jQuery("#exampleModalLabel").html("Progress Hafalan <b>"+uid+"</b>");
			    	jQuery(".modal-body").html(response);
			    },
			    error : function(error){ console.log(error) }
			});
			return false;
		}
		function ajax_get_tahsin(uid){
			jQuery(".modal-body").html("");
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=get_tahsin&uid="+uid,
			    method : "POST", 
			    success : function( response ){  
			    	jQuery("#exampleModalLabel").html("Perkembangan Tahsin <b>"+uid+"</b>");
			    	jQuery(".modal-body").html(response);
			    },
			    error : function(error){ console.log(error) }
			});
			return false;
		}
		
		function ajax_get_goal(uid,jangka){
			jQuery(".modal-body").html("");
			jQuery("#notif-footer").html("Tunggu dilut...");
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=get_goal&uid="+uid+"&jangka="+jangka,
			    method : "POST", 
			    success : function( response ){  
			    	jQuery("#exampleModalLabel").html("Target Jangka "+jangka+" <b>"+uid+"</b>");
			    	jQuery(".modal-body").html(response);
			    	jQuery("#notif-footer").html("");
			    },
			    error : function(error){ console.log(error) }
			});
			return false;
		}
		
		function ajax_update_biodata(){
			jQuery("#notif-footer").html("Update please wait ...");
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : jQuery("#form_tahfidz").serialize()+"&action=update_biodata",
			    method : "POST", 
			    success : function( response ){  
			    	jQuery("#exampleModalLabel").html("Update Biodata");
			    	jQuery("#notif-footer").html(response);
			    },
			    error : function(error){ console.log(error) }
			});
			return false;
		}

		function ajax_get_biodata(uid){
			jQuery(".modal-body").html("Get Biodata "+uid+", Plaese Wait...");
			jQuery("#notif-footer").html("");
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=get_biodata&uid="+uid,
			    method : "POST", 
			    success : function( response ){  
			    	jQuery("#exampleModalLabel").html("Biodata ");
			    	jQuery(".modal-body").html(response);
			    	jQuery("#modal-save-btn").attr("onclick","return ajax_update_biodata()");
			    },
			    error : function(error){ console.log(error) }
			});
			return false;
		}
		
		function ajax_get_todo(uid){
			jQuery(".modal-body").html("Get Todo "+uid+", Please Wait...");
			jQuery("#notif-footer").html("");
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=get_todo&uid="+uid,
			    method : "POST", 
			    success : function( response ){  
			    	jQuery("#exampleModalLabel").html("Todo ");
			    	jQuery(".modal-body").html(response);
			    },
			    error : function(error){ console.log(error) }
			});
			return false;
		}
	</script>
	';
	return $script;
}

?>