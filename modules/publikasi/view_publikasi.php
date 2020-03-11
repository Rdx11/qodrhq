<?php

function qodr_publikasi_view($db,$jml_data,$jml_per_hal,$data_rekap){
    $html='
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>  
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>  
    <script src="' . site_url() . '/wp-content/plugins/qodr/public/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="' . site_url() . '/wp-content/plugins/qodr/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="' . site_url() . '/wp-content/plugins/qodr/public/css/qodr.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
		.container{
		    width: 98% !important;
        }
    </style>

    <script>
        function pindah_data(id){
            var nilai_judul=jQuery("#tr_"+id+" td.judul").html();
            jQuery("#popup_publikasi input[name=judul]").val(nilai_judul);
            
            var nilai_publisher=jQuery("#tr_"+id+" td.publisher").html();
            jQuery("#popup_publikasi input[name=publisher]").val(nilai_publisher);

            var nilai_tgl=jQuery("#tr_"+id+" td.tgl").html();
            jQuery("#popup_publikasi input[name=tgl]").val(nilai_tgl);

            var nilai_link=jQuery("#tr_"+id+" td.link").html();
            jQuery("#popup_publikasi input[name=link]").val(nilai_link);

            jQuery("#popup_publikasi input[name=id]").val(id);
        }
        function cek_all(param){
            var cek = jQuery(param).prop("checked");
            if (cek){
                // jQuery(".centang").attr("checked","checked");
                jQuery(".centang").prop("checked",true);
            }else{
                jQuery(".centang").prop("checked",false);
                // jQuery(".centang").removeAttr("checked");
            }
        }

        jQuery(function () {
            jQuery("#chartContainer").CanvasJSChart({ //Pass chart options
                data: [
                {
                type: "splineArea", //change it to column, spline, line, pie, etc
                dataPoints: [
                    ';
                    foreach ($data_rekap as $k => $v) {
                        $html.="{ label: '$v[tgl]', y: $v[jml] },";
                    }
                    $html.='
                ]
            }
            ]
            });

        });

    </script>
    <style>
        #search-form{
            float:right;
        }
        .pagination{
            display: block;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#list">List Data</a></li>
                    <li><a data-toggle="tab" href="#rekap">Rekap Data</a></li>
                </ul>

                <div class="tab-content">
                    <div id="list" class="tab-pane fade in active">
                        '.qodr_publikasi_list_view($db,$jml_data,$jml_per_hal)."
                    </div>
                    <div id='rekap' class='tab-pane fade'>
                        ".qodr_publikasi_rekap_view($data_rekap)."
                    </div>
                </div>
            </div>
        </div>
    </div>";

    $modal='
    
  <!-- The Modal -->
  <div class="modal" id="popup_publikasi">
    <div class="modal-dialog">
      <div class="modal-content">
      
      <form action="admin.php?page=qodr-publikasi" method="POST">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
                <table>
                    
                    <input type="hidden" name="id" value="" >
                
                    <tr>
                        <td>Judul</td>
                        <td>: <input type="text" name="judul" value=""></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>: <input type="text" name="tgl" value=""></td>
                    </tr>
                    <tr>
                        <td>Link</td>
                        <td>: <input type="text" name="link" value=""></td>
                    </tr>
                    <tr>
                        <td>Publisher</td>
                        <td>: <input type="text" name="publisher" value=""></td>
                    </tr>
                </table>
          
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" >Save</button>  
        </div>
        </form>
      </div>
    </div> 
    </div>

  <!-- The Modal -->
  <div class="modal" id="popup_publikasi_tambah_data">
    <div class="modal-dialog">
      <div class="modal-content">
      
      <form action="admin.php?page=qodr-publikasi" method="POST">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
                <table>
                    
                <tr>
                        <td>Judul</td>
                        <td>: <input type="text" name="judul" value=""></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>: <input type="text" name="tgl" value=""></td>
                    </tr>
                    <tr>
                        <td>Link</td>
                        <td>: <input type="text" name="link" value=""></td>
                    </tr>
                    <tr>
                        <td>Publisher</td>
                        <td>: <input type="text" name="publisher" value=""></td>
                    </tr>
                </table>
          
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" >Save</button>  
        </div>
        </form>
      </div>
    </div>
    </div>
    ';

    return $html.$modal;
}