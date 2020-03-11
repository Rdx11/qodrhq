<?php

function qodr_santri_roadmap_view($dt){
	extract($dt);
	$html='
	<link href="'.plugin_dir_url(__DIR__).'../vendor/easytree/skin-win7/ui.easytree.css" rel="stylesheet" class="skins" type="text/css" />
    <link href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
    
    <script src="'.plugin_dir_url(__DIR__).'../vendor/easytree/jquery.js"></script>

    <script src="'.plugin_dir_url(__DIR__).'../vendor/easytree/jquery.easytree.min.js"></script>
    <style type="text/css">
    	.merah{
    		background:rgba(240, 10, 10, 0.6);
    	}
    	.kuning{
    		background:rgba(240, 220, 10, 0.6);
    	}
    	.ijo{
    		background:rgba(128, 240, 106, 0.6);	
    	}
    	.check{
    		border-radius:20px;
    	}
    	.link{
    		padding-right:5px;
	    	border-radius:5px;
    	}
    	.easytree-container{
    		background-color: #f1f1f1;
    		border: 0px;
    	}
    </style>
    <h1>'.$_GET['santri_id'].'</h1>
    <div id="demo2_menu">
    	'.$json_tree.'
    </div>
    <script>
	    $("#demo2_menu").easytree();
	    $(function(){
	    	var len=$("a.link-nilai").length;
			for(var i=0;i<len;i++){
				var nilai=$("a.link-nilai").eq(i).attr("data-nilai");
			    var text=$("a.link-nilai").eq(i).html();
			    var span="<span class=\'check\' >&nbsp;<b>"+nilai+"</b> | </span>"+text;
			    if (nilai<50) {
			    	var warna="merah";
		    	}else if (nilai>=50 && nilai<75) {
		    		var warna="kuning";
			    }else{
			    	var warna="ijo";
			    }
				$("a.link-nilai").eq(i).html(span);
				$("a.link-nilai").eq(i).addClass(warna);
			}
	    });
	    function form_update_roadmap_santri(that,santri_id,id,folder){
	    	$(".nilai").remove();
	    	$(that).find(".check").remove();
	    	if (folder!="true") {
	    		$(that).before("<input type=\'text\' class=\'nilai\' onblur=\'return ajax_update_roadmap_santri(this,\""+santri_id.trim()+"\","+id+");\' style=\'width:30px;border-radius:5px;border:1px solid gray;\'> ").focus();
	    	}
	    	$(".nilai").focus();
	    	// $(that).remove();
	    	return false;
	    }
	    function ajax_update_roadmap_santri(that,santri_id,id){
	    	
	    	if ($(that).val()=="") {
	    		var nilai=0;
	    	}else{
		    	var nilai=parseInt($(that).val());
	    	}
	    	$(that).next().prepend("<span class=\'check\'>&nbsp;<b>"+nilai+"</b> | </span>");
	    	if (nilai<50) {
		    	$(that).next().addClass("merah");
	    	}else if (nilai>=50 && nilai<75) {
		    	$(that).next().addClass("kuning");
		    }else{
		    	$(that).next().addClass("ijo");
		    }
	    	$(that).remove();
	    	$("#notif-footer").html("Data sent... ");
			$.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=save_nilai_roadmap&santri_id="+santri_id+"&nilai="+nilai+"&roadmap_id="+id,
			    method : "POST", 
			    success : function( r ){  
			    	$("#notif").html(r.trim());
			    },
			    error : function(error){ console.log(error) }
			});
			return false;
	    	return false;
	    }
	</script>
	<div id="notif" style="position:fixed;bottom:10px;right:10px;    position: fixed;
    bottom: 10px;
    right: 10px;
    background: lightgreen;
    border-radius: 100px;
    min-width: 20px;
    height: 20px;
    padding: 0px 10px;"></div>
	';	
	return $html;
}

?>