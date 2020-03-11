<?php

function qodr_publikasi_rekap_view($data_rekap){
    $html="
    <!--table rekap-->
    <div class='row'>
        <div class='col-lg-6 col-md-6 col-sm-6'>
            <h1>Rekap Publikasi</h1>
            <table class='table table-hover'>
                <thead>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                </thead>
                <tbody>";
                    $total=0;
                    foreach ($data_rekap as $k => $v) {
                        $total=$total+$v['jml'];
                        $html.="
                        <tr>
                            <td>".($k+1)."</td>
                            <td>".$v['tgl']."</td>
                            <td>".$v['jml']."</td>
                        </tr>
                        ";
                    }
                $html.="
                    <tr>
                        <td></td>
                        <td>Jumlah Total</td>
                        <td>".$total."</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class='col-lg-6 col-md-6 col-sm-6'>
            <h1>Grafik</h1>
            <div id='chartContainer' style='width:100%; height:300px;'></div>
        </div>
    </div>
                
    ";
    return $html;
}

?>