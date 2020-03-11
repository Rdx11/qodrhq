<?php

function qodr_script_dashboard_view(){
	$style='
	<script src="' . site_url() . '/wp-content/plugins/qodr/public/js/bootstrap.min.js"></script> 
	<link rel="stylesheet" href="' . site_url() . '/wp-content/plugins/qodr/public/css/bootstrap.min.css">
	<link rel="stylesheet" href="' . site_url() . '/wp-content/plugins/qodr/public/css/qodr.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<style>
		td{
			padding:5px;
		}
	</style>
	';
	$script='
	<script type="text/javascript">
		jQuery(function(){
			
		});

		function ajax_(k,that){
			
			jQuery.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action= ",
			    method : "POST", 
			    success : function( r ){  
			    	
			    },
			    error : function(error){ console.log(error) }
			});
			return false;
		}
	</script>
	';
	return $style.$script;
}