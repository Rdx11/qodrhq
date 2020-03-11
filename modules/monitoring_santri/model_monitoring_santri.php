<?php

class ModelMonitoringSantri{
    public function getSantri(){
        $datas = qodr_sql("SELECT uid FROM santri");
        foreach ($datas as $data) {
            $hasil[] = $data;
        }
        return $hasil;
    }

    public function monitoringSave($post){
        $tgl = $post['tgl'];
        $uid = $post['uid'];
        $tahsin_nilai = $post['tahsin_nilai'];
        $tahsin_keterangan = $post['tahsin_keterangan'];
        $santri_monitor_id=qodr_sql("INSERT INTO santri_monitor(santri_id, tgl) VALUES('$uid', '$tgl')");
        if (!empty($santri_monitor_id)) {
            qodr_sql("INSERT INTO santri_tahsin(santri_id,tgl,nilai,keterangan,santri_monitor_id) 
            VALUES('$uid', '$tgl', '$tahsin_nilai','$tahsin_keterangan','$santri_monitor_id')");

            // qodr_sql("INSERT INTO santri_it(keterangan,deadline,santri_monitor_id) 
            // VALUES('$uid', '$tgl', '$tahsin_nilai','$tahsin_keterangan','$santri_monitor_id')");
        }
        	

        
    }

    public function view($file,$data){
        extract($data);
        include_once("views_".$file.".php");
    }

}



// class monitoring_santri{
//     
// }