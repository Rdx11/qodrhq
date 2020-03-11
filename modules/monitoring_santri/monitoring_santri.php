<?php

function qodr_monitoring_santri(){
    $ms=new ModelMonitoringSantri();
    $data['santri']=$ms->getSantri();
    if(!empty($_POST)){
        $ms->monitoringSave($_POST);
    }
    $html=$ms->view("index",$data);
    die($html);
}