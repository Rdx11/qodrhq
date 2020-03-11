<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>  
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>  
    <script src="<?php echo site_url();?>/wp-content/plugins/qodr/public/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="<?php echo site_url();?>/wp-content/plugins/qodr/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo site_url();?>/wp-content/plugins/qodr/public/css/qodr.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
		.container{
		    width: 98% !important;
        }
    </style>

   
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
                        <?php include_once("views_form.php");?>
                    </div>
                    <div id="rekap" class="tab-pane fade">
                        <?php include_once("views_data.php");?>
                    </div>
                </div>
            </div>
        </div>
    </div>