<?php
function qodr_kinerja_del($id){
    qodr_log_tg("del kinerja ".$id);
    $db=qodr_sql("DELETE FROM kinerja_summary where id='$id'");
    $db=qodr_sql("DELETE FROM kinerja_pengurus where ksummary_id='$id'");
}
function qodr_pengurus_sekarang(){
    $db=qodr_sql("SELECT pejabat,divisi,max(mulai) as mulai FROM `pengurus` where cabang_id='hq' group by divisi");
    $pengurus=array();
    foreach ($db as $k => $v) {
        $pengurus[$v['divisi']]=$v['pejabat'];
    }
    return $pengurus;
}
function qodr_lock_kinerja(){
    qodr_log_tg("lock kinerja ".json_encode($_POST));
    $id=$_POST['id'];
    qodr_sql("UPDATE kinerja_summary SET kunci='Y' WHERE id='$id'");
    wp_die('lock');
}
function qodr_save_kinerja_pengurus(){ 

    qodr_log_tg("simpan kinerja ".$_POST['summary']['tgl']);

    if (isset($_POST)) {
        foreach ($_POST['summary'] as $k => $v) {
            $val_kinerja_summary[]="'$v'";
            $kolom[]=$k;
            $update[]="$k='$v'";
        
        }
        if($_POST['ksummary_id']==''){
            $ksummary_id=qodr_sql("INSERT INTO kinerja_summary(".join(",",$kolom).") values (".join(",",$val_kinerja_summary).")");
        }else{
            $ksummary_id=$_POST['ksummary_id'];
            if ($_POST['kunci']=='N') {
                qodr_sql("UPDATE kinerja_summary SET ".join(",",$update)." WHERE id='$ksummary_id'");
            }
        }
        unset($v);
        foreach ($_POST['program'] as $program => $poin) {
            if(substr($poin,0,5)=='skip-'){
                $hitung='skip';
                $poin=str_replace("skip-","",$poin);
            }else{
                $hitung="hitung";
            }
            $val_kinerja_pengurus[]="('$ksummary_id','$program','$poin','$hitung')";
        }
        if ($_POST['kunci']=='N') {
            qodr_sql("REPLACE INTO kinerja_pengurus(ksummary_id,program_kerja,poin,hitung) values ".join(",",$val_kinerja_pengurus));
        }
        $n['notif']="saved successfully";
        $n['ksummary_id']=$ksummary_id;
        echo json_encode($n);
    }
    wp_die();
}

function qodr_tanggal_rapat($cabangq){    
//USERLOGIN
$cabang=get_user_meta(get_current_user_id(),'cabang_sekarang',1);
//ENDUSERLOGIN
    if (isset($_GET['id'])) {
        $id=$_GET['id'];
        $id_db=qodr_sql("SELECT kunci from kinerja_summary where id='$id'");
        $kunci=$id_db[0]['kunci'];
    }else{
        $id_db=qodr_sql("SELECT max(id) as id,kunci from kinerja_summary");
        $id=$id_db[0]['id'];
        $kunci=$id_db[0]['kunci'];
    }
    $tgl_db=qodr_sql("SELECT tgl,id from kinerja_summary where cabang_id='$cabangq' order by tgl desc limit 5");
    $tgl='';
    foreach ($tgl_db as $k => $v) {
        $tgl_sekarang='';
        if ($id==$v['id']) {
            $tgl_sekarang='color:green;font-weight:bold;';
        }else{
            $tgl_sekarang='';
        }
        $tgl.='<a href=admin.php?page=qodr-kinerja&id='.$v['id'].'&tab=kinerja-pengurus&cabang='.$cabangq.' style="'.$tgl_sekarang.'" >'.date("dMy",strtotime($v['tgl'])).'</a> | ';
    }
    $tgl.='<button class="btn btn-xs btn-primary" onclick="return new_data()">new</button>';
    
    $tgl.='<button style="float:right;margin-right:5px;" class="btn btn-xs btn-danger" onclick="return del_kinerja_summary_data('.$id.')"><i class="fa fa-times"></i> del</button>';
    if ($kunci=='Y') {
        $tgl.='<button style="float:right;margin-right:5px;" class="btn btn-xs btn-default" ><i class="fa fa-lock"></i> lock</button>';
    }else{
        $tgl.='<button style="float:right;margin-right:5px;" class="btn btn-xs btn-warning" onclick="return lock_kinerja_summary_data(this,'.$id.')"><i class="fa fa-key"></i> lock</button>';
    }
    return $tgl;
}

function qodr_kinerja_pengurus(){
    if (isset($_GET['id'])) {
        $id=$_GET['id'];
    }else{
        $id_db=qodr_sql("SELECT max(id) as id from kinerja_summary");
        $id=$id_db[0]['id'];
    }
    $pengurus_db=qodr_sql("select * from kinerja_pengurus p join program_kerja k on p.program_kerja=k.id where p.ksummary_id='$id'");
    $summary_db=qodr_sql("select * from kinerja_summary where id='$id'");
    foreach ($pengurus_db as $k => $v) {
        $program[$v['divisi']][]=array(
            'program'=>$v['program_kerja'],
            'nilai'=>$v['poin'],
            'aktif'=>$v['aktif'],
            'hitung'=>$v['hitung']
        );
    }
    $summary=$summary_db[0];
    $dt['program']=$program;
    $dt['summary']=$summary;
    return $dt;
}