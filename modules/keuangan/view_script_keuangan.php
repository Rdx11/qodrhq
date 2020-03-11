<?php

function qodr_script_keuangan(){
	$script='
	<script type="text/javascript">
		function form_update_rekap_keuangan_bulanan(that,kolom,id){
			var nilai=jQuery(that).html().replace(/,/g,"").trim();
			var input="<input type=text value=\'"+nilai+"\' style=\'width:70px;\' onblur=\'return ajax_update_rekap_keuangan_bulanan(\""+kolom+"\",\""+id+"\",this)\'>";
			jQuery(that).html(input);
		}
		function ajax_update_rekap_keuangan_bulanan(kolom,id,that){
			var nilai=jQuery(that).val().replace(/,/g,"").trim();
				jQuery.ajax({
				    url : "'.site_url().'/wp-admin/admin-ajax.php",
				    data : "action=update_rekap_keuangan_bulanan&id="+id+"&kolom="+kolom+"&nilai="+nilai,
				    method : "POST", 
				    success : function( r ){  
				    	jQuery(that).parent().html(r);
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