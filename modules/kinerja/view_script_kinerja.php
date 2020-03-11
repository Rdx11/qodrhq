<?php
function qodr_script_kinerja_view(){
	$style='
	<script src="' . site_url() . '/wp-content/plugins/qodr/public/js/bootstrap.min.js"></script> 
	<link rel="stylesheet" href="' . site_url() . '/wp-content/plugins/qodr/public/css/bootstrap.min.css">
	<link rel="stylesheet" href="' . site_url() . '/wp-content/plugins/qodr/public/css/qodr.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<style>
		.btn-filter{
			margin:3px 1px;
		}
		.container {
    		width: 100% !important;
    	}
    	.kanan{
			text-align:right;
		}
		.raw{
			display:none;
		}
		.divisi{
			float:left;
			margin:10px;
		}
		.divisi td{
			padding:5px;
		}
		.kuning{
			color:yellow;
		}
		.abu{
			color:gray;
		}
		h4{
			border-bottom:1px solid gray;
			font-weight:bold;
			padding-bottom:10px;
		}
		h5 {
			display: block;
		}
		tr.total{
			border-top:1px solid gray;
		}
		table{
			min-width: 230px;
			margin-bottom:15px;
		}
		#total_summary{
			color:red;
			font-weight:bold;
		}
	</style>
	';
	$script='
	<script type="text/javascript">
		jQuery(function(){
			hitung_summary();
		});
		function lock_kinerja_summary_data(that,id){
			jQuery(that).removeClass("btn-warning").addClass("btn-default");
			jQuery(that).find("i").removeClass("fa-key").addClass("fa-lock");
			jQuery.ajax({
				url : "'.site_url().'/wp-admin/admin-ajax.php",
				data : "action=lock_kinerja&id="+id,
				dataType : "json",
				method : "POST", 
				success : function( r ){  
				},
				error : function(error){ console.log(error) }
			});
			return false;
		}
		function del_kinerja_summary_data(id){
			if(confirm("ilang lo iki...")){
				window.location.href="admin.php?page=qodr-kinerja&id="+id+"&tab=kinerja-pengurus&action=del";
			}else{
				return false;
			}
		}
		function skip_program(that,posisi){
			var isi=jQuery(that).html();
			if(posisi==0){// posisi 1 berarti di coret 0 blm dicoret
				jQuery(that).before("<del onclick=\'return skip_program(this,1)\'>"+isi+"</del>"); // fungsi untuk coret program

				//ganti id jadi ada disable-program nya biar tidak ke itung
				var id_val=jQuery(that).next().attr("id");
				jQuery(that).next().attr("id","disable-"+id_val);

				//hilangkan class kuning biar dihitung
				jQuery(that).parent().parent().find("td").eq(1).find("i").removeClass("kuning");

				//agar di database masuk kolom skip
				var nilai_program=jQuery(that).next().val();
				jQuery(that).next().val("skip-"+nilai_program);
			}else{
				jQuery(that).before("<span onclick=\'return skip_program(this,0)\'>"+isi+"</span>");

				//ganti id jadi ilangi disable- nya biar ke itung
				var id_val=jQuery(that).next().attr("id");
				jQuery(that).next().attr("id",id_val.replace(/disable\-/g,""));

				//hilangkan class kuning biar tidak dihitung
				jQuery(that).parent().parent().find("td").eq(1).find("i").addClass("kuning");

				var nilai_program=jQuery(that).next().val();
				jQuery(that).next().val(nilai_program.replace(/skip\-/g,"")); 
			}
			jQuery(that).remove();

			hitung_summary();
		}
		function new_data(){
			jQuery(".bintang_1").click();
			jQuery("#summary_tgl").val("'.date('Y-m-d').'");
			jQuery("#summary_catatan").val("");
			jQuery("#summary_target_poin").val("");
			jQuery("#ketua").val("");
			jQuery("#administrasi").val("");
			jQuery("#bendahara").val("");
			jQuery("#it").val("");
			jQuery("#majelis").val("");
			jQuery("#publikasi").val("");
			jQuery("#summary_id").val("");
			jQuery("#ksummary_id").val("");
			jQuery("#kunci").val("N");
			jQuery("#summary_kedisiplinan").html("1.00");
			jQuery("#summary_kenyamanan").html("1.00");
			hitung_summary();
			
		}
		function hitung_summary(){
			var it=hitung_poin("it");
			var agama=hitung_poin("agama");
			var publikasi=hitung_poin("publikasi");
			var administrasi=hitung_poin("administrasi");
			var keuangan=hitung_poin("keuangan");
			var kedisiplinan=jQuery("#summary_kedisiplinan").val();
			var kenyamanan=jQuery("#summary_kenyamanan").val();
			var total_summary=parseFloat(it)+parseFloat(agama)+parseFloat(publikasi)+parseFloat(administrasi)+parseFloat(keuangan)+parseFloat(kedisiplinan)+parseFloat(kenyamanan);
			jQuery("#total_summary").html(total_summary.toFixed(2));
			var skala5=parseFloat(total_summary)*5/35;
			var total_bintang="";
			for(var i=1;i<=skala5.toFixed(0);i++){
				total_bintang+="<i class=\"fa fa-star kuning\"></i> ";
			}
			for(var i=1;i<=(5-skala5.toFixed(0));i++){
				total_bintang+="<i class=\"fa fa-star abu\"></i> ";
			}
			jQuery("#summary_total_poin").val(total_summary.toFixed(2));
			jQuery("#summary_bintang").val(skala5.toFixed(2));
			jQuery("#skala5").html(total_bintang);
			var target=jQuery("#summary_target_poin").val();
			if(parseInt(total_summary) >= parseInt(target)){
				jQuery("#selamat").fadeIn();
			}else{
				jQuery("#selamat").fadeOut();
			}
		}
		function hitung_poin(div){
			var jml_bintang=jQuery(".div_"+div).find(".kuning").length;
			var jml_program_all=jQuery(".div_"+div).find(".program_"+div).length;
			var jml_program_coret=jQuery(".div_"+div).find(".program_"+div).find("del").length;
			var jml_program=jml_program_all-jml_program_coret;
			var max_poin=parseInt(jml_program)*5;
			var poin_skala5=parseInt(jml_bintang)*5/max_poin;
			var poin_bulat=poin_skala5.toFixed(2);
			jQuery(".total_"+div).html("<b style=color:blue;margin-right:5px; >"+poin_bulat+"</b>");
			jQuery("#summary_"+div).val(poin_bulat);
			jQuery(".total_bintang_"+div).html("<b style=color:blue; >"+jml_bintang+"</b>");		
			return poin_bulat;
		}
		function update_poin(that,div,program,bintang){
			var total_bintang="";
			for(var i=1;i<=bintang;i++){
				total_bintang+="<i class=\"fa fa-star kuning\" onclick=\"return update_poin(this,\'"+div+"\',\'"+program+"\',"+i+");\"></i> ";
			}
			for(var i=(parseInt(bintang)+1);i<=5;i++){
				total_bintang+="<i class=\"fa fa-star abu\" onclick=\"return update_poin(this,\'"+div+"\',\'"+program+"\',"+i+");\"></i> ";
			}
			jQuery("#program_"+program).val(bintang);
			jQuery(that).parent().html(total_bintang);
			hitung_poin(div);
			hitung_summary();
			return false;
		}
		function ajax_save_kinerja_pengurus(){
			var data=jQuery("#form_kinerja_pengurus").serialize();
			jQuery(".n").html("Sabbar.. ojo nesu akhii");
			jQuery.ajax({
				url : "'.site_url().'/wp-admin/admin-ajax.php",
				data : "action=save_kinerja_pengurus&"+data,
				dataType : "json",
				method : "POST", 
				success : function( r ){  
					jQuery(".n").html(r.notif);
					jQuery("#ksummary_id").val(r.ksummary_id);
				},
				error : function(error){ console.log(error) }
			});
			return false;
		}
		function ajax_siapa_saja(k,that){
			jQuery(".raw_"+k).toggle();
			var tgl=jQuery(that).find(".tgl").html();
			var key=jQuery(that).find(".key").html();
			var value=jQuery(that).find(".value").html();
			jQuery.ajax({
				    url : "'.site_url().'/wp-admin/admin-ajax.php",
				    data : "action=siapa_saja&tgl="+tgl+"&key="+key+"&value="+value,
				    method : "POST", 
				    success : function( r ){  
				    	jQuery(".siapa_"+k).html(r);
				    },
				    error : function(error){ console.log(error) }
				});
				return false;
		}
	</script>
	';
	$script_summary=qodr_kinerja_summary_script_view();
	return $style.$script.$script_summary;
}
function qodr_kinerja_summary_script_view(){
	$cabang=$_GET['cabang'];
	$script='
	<script src="'.plugin_dir_url(__DIR__).'../public/js/chart.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function () {
            showGraph();
            //jQuery(\'#daterange\').daterangepicker();
            //jQuery(\'#daterange\').daterangepicker(\'setDate\', \'today\');
        });
		function showGraph(start=null,end=null){		
                jQuery.post("'.site_url().'/wp-admin/admin-ajax.php", { action: "summary_chart",start:start,end:end },
                function (data0)
                {
                	var data=JSON.parse(data0);
                    var tgl = [];
                    var target_poin = [];
                    var total_poin = [];
                    for (var i in data) {
                        tgl.push(data[i].tgl);
                        target_poin.push(data[i].target_poin);
                        total_poin.push(data[i].total_poin);         
                    }
                    var chartdata = {
                        labels: tgl,
                        datasets: [
                            {
                            label: \'Target\',
                            backgroundColor: \'#49e2ff\',
                            borderColor: \'#46d5f1\',
                            hoverBackgroundColor: \'#49e2ff\',
                            hoverBorderColor: \'#46d5f1\',
                            data: target_poin
                            },
                            {
                            label: \'Poin\',
                            backgroundColor: \'#849ee8\',
                            borderColor: \'#849ee8\',
                            hoverBackgroundColor: \'#849ee8\',
                            hoverBorderColor: \'#849ee8\',
                            data: total_poin
                            }
                        ]
                    };
                    var graphTarget = jQuery("#graphCanvas");
	                var barGraph = new Chart(graphTarget, {
	                    type: \'bar\',
	                    data: chartdata,
                        options: {
                            responsive: true,
                            legend: {
                                position: \'bottom\',
                            },
                            hover: {
                                mode: \'label\'
                            },
                            scales: {
                                xAxes: [{
                                        display: true,
                                        scaleLabel: {
                                            display: true,
                                            labelString: \'Date\'
                                        }
                                    }],
                                yAxes: [{
                                        display: true,
                                        ticks: {
                                            beginAtZero: true,
                                            steps: 10,
                                            stepValue: 10
                                        }
                                    }]
                            },
                            title: {
                                display: true,
                                text: \'Statistik Kinerja Pengurus QODR '.$cabang.'\'
                            }
                        }
	                });
                });
    	}
        jQuery(function() {
            // jQuery(\'input[name="daterange"]\').daterangepicker({
            //     opens: \'left\'
            // }, function(start, end, label) {
            //     jQuery(\'#daterange\').daterangepicker();
            //     jQuery(\'#daterange\').on(\'apply.daterangepicker\', function(ev, picker) {
            //             jQuery("#graphCanvas").remove();
            //             jQuery("#chart-container").html("<canvas id=\'graphCanvas\'></canvas>");
            //             var start = picker.startDate.format(\'YYYY-MM-DD\');
            //             var end = picker.endDate.format(\'YYYY-MM-DD\');
            //             showGraph("summary_chart",start,end);
            //             summary_table(start,end);
            //     });
            // });
        });
        function summary_table(from,to){
            jQuery.ajax({
                url : "'.site_url().'/wp-admin/admin-ajax.php",
                data : "action=summary_table&from="+from+"&to="+to,
                method : "POST",
                success : function(data){
                    jQuery(\'#summary_table\').html(data);
                },
                error : function(error){}
            });
            return false;
        }
	</script>
	';
	return $script;
}