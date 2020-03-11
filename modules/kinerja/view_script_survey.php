<?php 
    function script_survey_view(){
        $script='
            <script type="text/javascript">
                jQuery(function(){
                    otomasi("duolingo");
                    otomasi("ngaji");
                    otomasi("puasa");
                    otomasi("itikaf");
                    otomasi("wakatime");
                    otomasi("github");
                    otomasi("sholat_duha");
                    otomasi("sholat_malam");
                    otomasi("sholat_rowatib");
                    otomasi("sholat_sunnah");
                    otomasi("tahfidz");                    
                    // new_data();
                });
                function konversi_nilai_survey(jawaban){
                    var nilai="";
                    if(jawaban=="jarang"){nilai=3;}
                    if(jawaban=="tdk pernah"){nilai=1;}
                    if(jawaban=="selalu"){nilai=10;}
                    if(jawaban=="sering"){nilai=8;}
                    if(jawaban=="kadang"){nilai=5;}
                    if(jawaban=="sudah"){nilai=10;}
                    if(jawaban=="belum"){nilai=1;}
                    //batas
                    if(jawaban=="ya"){nilai=10;}
                    if(jawaban=="tdk nambah"){nilai=1;}
                    //batas
                    if(jawaban=="0"){nilai=0;}
                    if(jawaban=="1"){nilai=5;}
                    if(jawaban=="2"){nilai=10;}
                    return nilai;
                }
                function nilai_wakatime(jawaban){
                    var nilai="";
                    if(jawaban < "1"){nilai=1;}
                    if(jawaban=="1"){nilai=5;}
                    if(jawaban=="2"){nilai=5;}
                    if(jawaban=="3"){nilai=8;}
                    if(jawaban=="4"){nilai=10;}
                    if(jawaban=="5"){nilai=10;}
                    if(jawaban=="6"){nilai=10;}
                    if(jawaban=="7"){nilai=10;}
                    return nilai;
                }
                function nilai_github(jawaban){
                    var nilai="";
                    if(jawaban==""){nilai=1;}
                    if(jawaban==0){nilai=1;}
                    if(jawaban==1){nilai=3;}
                    if(jawaban==2){nilai=5;}
                    if(jawaban==3){nilai=8;}
                    if(jawaban==4){nilai=8;}
                    if(jawaban==5){nilai=8;}
                    if(jawaban==6){nilai=10;}
                    if(jawaban>6){nilai=10;}
                    return nilai;
                }
                function konversi_nilai_star(nilai){
                    if(nilai==100){star=5;}
                    if(nilai<100){star=4;}
                    if(nilai<=80){star=3;}
                    if(nilai<=50){star=2;}
                    if(nilai<=20){star=1;}
                    return star;
                }
                function otomasi(program){
                    if(program=="duolingo"){ //DUOLINGO
                        var jml_jawaban=jQuery(".key_"+program+" .survey_jawaban").length;
                        var poin=0;
                        var total_jumlah_org=0
                        for(var i=0;i<jml_jawaban;i++){
                           var jawaban=jQuery(".key_"+program+" .survey_jawaban").eq(i).attr("jawaban");
                           var jumlah_org=jQuery(".key_"+program+" .survey_jumlah").eq(i).html();
                           total_jumlah_org=total_jumlah_org+parseInt(jumlah_org);
                           var nilai=konversi_nilai_survey(jawaban);
                           poin=poin+jumlah_org*nilai;
                            // console.log(nilai+"x"+jumlah_org+"="+(jumlah_org*nilai));
                        }
                        var max_poin=total_jumlah_org*konversi_nilai_survey("selalu");
                        var rata2=poin/max_poin*100;
                        var star=konversi_nilai_star(rata2);
                        jQuery(".td_duolingo i").eq(star-1).click();
                        console.log(star);
                    }
                    if(program=="ngaji"){ //TAHSIN
                        var jml_jawaban=jQuery(".key_"+program+" .survey_jawaban").length;
                        var poin=0;
                        var total_jumlah_org=0
                        for(var i=0; i<jml_jawaban; i++){
                            var jawaban=jQuery(".key_"+program+" .survey_jawaban").eq(i).attr("jawaban"); //ini kata-kata jawabannya
                            var jumlah_org=jQuery(".key_"+program+" .survey_jumlah").eq(i).html();
                            total_jumlah_org=total_jumlah_org+parseInt(jumlah_org);
                            var nilai=konversi_nilai_survey(jawaban);
                            poin=poin+jumlah_org*nilai;
                        }
                        var max_poin=total_jumlah_org*konversi_nilai_survey("selalu");
                        var rata2=poin/max_poin*100;
                        var star=konversi_nilai_star(rata2);
                        jQuery(".td_tilawah i").eq(star-1).click();
                        //console.log("total bintangnya"+star);
                    }
                    if(program=="puasa"){ //PUASA
                        var jml_jawaban=jQuery(".key_"+program+" .survey_jawaban").length;
                        var poin=0;
                        var total_jumlah_org=0
                        for(var i=0; i<jml_jawaban; i++){
                            var jawaban=jQuery(".key_"+program+" .survey_jawaban").eq(i).attr("jawaban"); //ini kata-kata jawabannya
                            var jumlah_org=jQuery(".key_"+program+" .survey_jumlah").eq(i).html();
                            total_jumlah_org=total_jumlah_org+parseInt(jumlah_org);
                            var nilai=konversi_nilai_survey(jawaban);
                            poin=poin+jumlah_org*nilai;
                        }
                        var max_poin=total_jumlah_org*konversi_nilai_survey("selalu");
                        var rata2=poin/max_poin*100;
                        var star=konversi_nilai_star(rata2);
                        jQuery(".td_puasa_sunnah i").eq(star-1).click();
                        //console.log("seng puasa"+star);
                    }
                    if(program=="tahfidz"){ //TAHFIDZ
                        var jml_jawaban=jQuery(".key_"+program+" .survey_jawaban").length;
                        var poin=0;
                        var total_jumlah_org=0
                        for(var i=0; i<jml_jawaban; i++){
                            var jawaban=jQuery(".key_"+program+" .survey_jawaban").eq(i).attr("jawaban"); //ini kata-kata jawabannya
                            var jumlah_org=jQuery(".key_"+program+" .survey_jumlah").eq(i).html();//juml orang
                            total_jumlah_org=total_jumlah_org+parseInt(jumlah_org);
                            var nilai=konversi_nilai_survey(jawaban);
                            poin=poin+jumlah_org*nilai;
                        }
                        var max_poin=total_jumlah_org*konversi_nilai_survey("ya");
                        var rata2=poin/max_poin*100;
                        var star=konversi_nilai_star(rata2);
                        jQuery(".td_tahfidz i").eq(star-1).click();
                        //console.log("hafalann tuhh"+star);
                    }
                    if(program=="itikaf"){ //ITIKAF
                        //console.log("hayoooo")
                        var jml_jawaban=jQuery(".key_"+program+" .survey_jawaban").length;
                        var poin=0;
                        var total_jumlah_org=0
                        for(var i=0; i<jml_jawaban; i++){
                            var jawaban=jQuery(".key_"+program+" .survey_jawaban").eq(i).attr("jawaban"); //ini kata-kata jawabannya
                            var jumlah_org=jQuery(".key_"+program+" .survey_jumlah").eq(i).html();//juml orang
                            total_jumlah_org=total_jumlah_org+parseInt(jumlah_org);
                            var nilai=konversi_nilai_survey(jawaban);
                            poin=poin+jumlah_org*nilai;
                        }
                        var max_poin=total_jumlah_org*konversi_nilai_survey("selalu");
                        var rata2=poin/max_poin*100;
                        var star=konversi_nilai_star(rata2);
                        jQuery(".td_itikaf i").eq(star-1).click();
                        //console.log("hafalann tuhh"+star);
                    }
                    if(program=="wakatime"){ //WAKATIME
                        var jml_jawaban=jQuery(".key_"+program+" .survey_jawaban").length;
                        var poin=0;
                        var total_jumlah_org=0
                        for(var i=0; i<jml_jawaban; i++){
                            var jawaban=jQuery(".key_"+program+" .survey_jawaban").eq(i).attr("jawaban"); //ini kata-kata jawabannya
                            var jumlah_org=jQuery(".key_"+program+" .survey_jumlah").eq(i).html();//juml orang
                            total_jumlah_org=total_jumlah_org+parseInt(jumlah_org);
                            var nilai=nilai_wakatime(jawaban);
                            poin=poin+jumlah_org*nilai;
                        }
                        var max_poin=total_jumlah_org*konversi_nilai_survey("selalu");
                        var rata2=poin/max_poin*100;
                        var star=konversi_nilai_star(rata2);
                        jQuery(".td_wakatime i").eq(star-1).click();
                     }
                     if(program=="github"){ //GITHUB
                        var jml_jawaban=jQuery(".key_"+program+" .survey_jawaban").length;
                        var poin=0;
                        var total_jumlah_org=0
                        for(var i=0; i<jml_jawaban; i++){
                            var jawaban=jQuery(".key_"+program+" .survey_jawaban").eq(i).attr("jawaban"); //ini kata-kata jawabannya
                            var jumlah_org=jQuery(".key_"+program+" .survey_jumlah").eq(i).html();//juml orang
                            total_jumlah_org=total_jumlah_org+parseInt(jumlah_org);
                            var nilai=nilai_github(jawaban);
                            poin=poin+jumlah_org*nilai;
                        }
                        var max_poin=total_jumlah_org*konversi_nilai_survey("selalu");
                        var rata2=poin/max_poin*100;
                        var star=konversi_nilai_star(rata2);
                        jQuery(".td_github i").eq(star-1).click();
                     }
                     if(program=="sholat_duha"){ 
                        var jml_jawaban=jQuery(".key_"+program+" .survey_jawaban").length;
                        var poin=0;
                        var total_jumlah_org=0
                        for(var i=0; i<jml_jawaban; i++){
                            var jawaban=jQuery(".key_"+program+" .survey_jawaban").eq(i).attr("jawaban"); //ini kata-kata jawabannya
                            var jumlah_org=jQuery(".key_"+program+" .survey_jumlah").eq(i).html();//juml orang
                            total_jumlah_org=total_jumlah_org+parseInt(jumlah_org);
                            var nilai=konversi_nilai_survey(jawaban);
                            poin=poin+jumlah_org*nilai;
                        }
                        var max_poin=total_jumlah_org*konversi_nilai_survey("selalu");
                        var rata2=poin/max_poin*100;
                        var star=konversi_nilai_star(rata2);
                        jQuery(".td_sholat_sunnah i").eq(star-1).click();
                     }
                }
                function ajax_convert_tgl(){
                    var tgl_awal  = jQuery("#tgl_awal").val();
                    var tgl_akhir = jQuery("#tgl_akhir").val();
                    jQuery.ajax({
                        url : "'.site_url().'/wp-admin/admin-ajax.php",
                        data : "action=convert_tgl&tgl_awal="+tgl_awal+"&tgl_akhir="+tgl_akhir+"&table=santri_survey",
                        dataType : "json",
                        method : "POST", 
                        success : function( r ){  
                        },
                        error : function(error){ console.log(error) }
                    });
                    return false;
                }
            </script>';
        return $script;
    }
?>