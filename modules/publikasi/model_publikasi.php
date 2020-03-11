<?php
function qodr_publikasi_rekap(){
    return qodr_sql("SELECT tgl,count(tgl) as jml FROM publikasi GROUP BY tgl");
}

function qodr_publikasi_multi_del($param){
    foreach ($param['dt'] as $k => $id) {
        qodr_sql("DELETE FROM publikasi WHERE id='$id'");
    }
}

function qodr_publikasi_upd($param){
    $judul=$param['judul'];
    $tgl=$param['tgl'];
    $link=$param['link'];
    $publisher=$param['publisher'];
    $id=$param['id'];
    qodr_sql("UPDATE publikasi SET judul='$judul',link='$link',publisher='$publisher',tgl='$tgl' WHERE id='$id'");
}

function qodr_publikasi_ins($param){
    $judul=$param['judul'];
    $tgl=$param['tgl'];
    $link=$param['link'];
    $publisher=$param['publisher'];
    qodr_sql("INSERT INTO publikasi(judul,link,publisher,tgl) 
    VALUES('$judul','$link','$publisher','$tgl')");
}

function qodr_data_publikasi($where=''){
    $db=qodr_sql("SELECT * FROM publikasi $where");
    return $db;
}

function qodr_publikasi_del($get){
    return qodr_sql("DELETE FROM publikasi WHERE id='$get[id]'"); 
}