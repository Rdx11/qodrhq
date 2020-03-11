<?php

function qodr_publikasi(){
    $where='';
    if (!empty($_POST)) {
        
        if (!empty($_POST['search']) and $_POST['search']=='data') {
            $keyword=$_POST['cari'];
            $where="WHERE judul like '%$keyword%' OR tgl  like '%$keyword%' OR link  like '%$keyword%' OR publisher  like '%$keyword%'";
        }elseif (!empty($_POST['multi_del']) and $_POST['multi_del']!='') {
            qodr_publikasi_multi_del($_POST);
        }elseif (!empty($_POST['id']) and $_POST['id']!='') {
            qodr_publikasi_upd($_POST);
        }else{
            qodr_publikasi_ins($_POST);
        }
    }

    $jml_per_hal=10;
    if (empty($_GET['hal'])) {
        $_GET['hal']=1;
    }
    $hal=$_GET['hal'];//1
    $offset=($hal-1)*$jml_per_hal;
    $where.=" limit $offset,$jml_per_hal";
    if (isset($_GET['action']) and $_GET['action']=='del') {
        qodr_publikasi_del($_GET);
    }  
    $jml_data_sql=qodr_sql("select count(id) as jml from publikasi $where");
    $jml_data=$jml_data_sql[0]['jml'];
    $data_rekap=qodr_publikasi_rekap();
    $db=qodr_data_publikasi($where);
    $view=qodr_publikasi_view($db,$jml_data,$jml_per_hal,$data_rekap);
    wp_die($view);
}


?>