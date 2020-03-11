<?php

function qodr_roadmap_master_view($dt){
	extract($dt);
	$html='
	<link href="'.plugin_dir_url(__DIR__).'../vendor/easytree/skin-win7/ui.easytree.css" rel="stylesheet" class="skins" type="text/css" />
    <link href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <script src="'.plugin_dir_url(__DIR__).'../vendor/easytree/jquery.js"></script>

    <script src="'.plugin_dir_url(__DIR__).'../vendor/easytree/jquery.easytree.min.js"></script>
    <style type="text/css">
    	.easytree-container{
    		background-color: #f1f1f1;
    		border: 0px;
    	}
    	.btn-sync{
    		background:silver;
    		border-radius:3px;
    		font-size:10px;    
    		padding: 0px 3px 3px 3px;
		    text-decoration: none;
		    color: green;
    	}
    	.btn-sync:hover{
    		background:green;
    		color:white;
    	}
    	.btn-action-wrapper{
    		color:blue;
    	}
    </style>
    <h1>Roadmap Master <a class="btn-sync" href="admin.php?page=qodr-roadmap&action=reload" style="">sync</a></h1>
    <div id="demo2_menu">
    	'.$json_tree.'
    </div>
    <script>
	    $("#demo2_menu").easytree();
	    $(function(){
	    	
			
	    });
	    function show_btn_action(that,id,bapak,urut,link){
	    	$(".roadmap-btn-action").remove();
	    	var btn="<span class=btn-action-wrapper >&nbsp;<a onclick=\'return form_edit(this,"+id+","+bapak+","+urut+",\""+link+"\");\'  class=roadmap-btn-action href=# title=edit >["+urut+"/"+id+"] <span class=\"fa fa-pen\"></span></a>"+
	    		"&nbsp;<a onclick=\'return del_roadmap(this,"+id+");\' title=hapus class=roadmap-btn-action href=# ><span class=\"fa fa-times\"></span></a>"+
	    		"&nbsp;<a onclick=\'return form_add(this,"+id+");\' title=add class=roadmap-btn-action href=# ><span class=\"fa fa-plus\"></span></a></span>";
	    	$(that).after(btn);
	    	return false;
	    }
	    function form_edit(that,id,bapak,urut,link){
	    	var data_awal=$("a[data-id="+id+"]").html();
	    	var input="<form class=edit-roadmap ><input type=text name=teks value=\'"+data_awal+"\'>"+
	    		"<input title=urutan type=text name=urut value=\'"+urut+"\' style=width:50px;>"+
	    		"<input title=bapak type=text name=bapak value=\'"+bapak+"\' style=width:50px;>"+
	    		"<input title=link type=text name=link value=\'"+link+"\' style=width:250px;>"+
	    		"<input type=button value=save onclick=\'return update_roadmap(this);\'>"+
	    		"<input type=hidden name=id value=\'"+id+"\' style=width:50px;>"+
	    		"</form>";
	    	$("a[data-id="+id+"]").html(input);
	    }
	    function form_add(that,id){
	    	$(that).after("<br><input type=text onblur=\'return add_roadmap(this,"+id+");\'>");
	    	$(that).next().next().focus();
	    }
	    function add_roadmap(that,id){
	    	var isi=$(that).val();
	    	var id_bapak=id;
	    	//ajax
	    	$.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=add_roadmap&teks="+isi+"&bapak="+id_bapak,
			    method : "POST", 
			    success : function( r ){  
			    	$(that).after("<span class=easytree-title >"+r+"</span>");
			    	$(that).remove();
			    },
			    error : function(error){ console.log(error) }
			});
	    	return false;
	    }
	    function update_roadmap(that){
	    	var data=$(that).parent().serialize();
	    	//ajax
	    	var teks=$(that).parent().find("input").val();
	    	// alert(data);
	    	$.ajax({
			    url : "'.site_url().'/wp-admin/admin-ajax.php",
			    data : "action=update_roadmap&"+data,
			    method : "POST", 
			    success : function( r ){  
			    	$(that).parent().parent().html(r);
			    },
			    error : function(error){ console.log(error) }
			});
	    	return false;
	    }
	    function del_roadmap(that,id){
	    	if(confirm("ojo macem2..")){
		    	//ajax
		    	$.ajax({
				    url : "'.site_url().'/wp-admin/admin-ajax.php",
				    data : "action=del_roadmap&id="+id,
				    method : "POST", 
				    success : function( r ){  
		    			$("span[id="+r+"]").remove();
				    },
				    error : function(error){ console.log(error) }
				});
		    	return false;
	    	}
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