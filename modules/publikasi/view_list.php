<?php

function qodr_publikasi_list_view($db,$jml_data,$jml_per_hal){
    $html='
                <h1>List Publikasi</h1>

                <form action="admin.php?page=qodr-publikasi" method="POST">
                    <input type="hidden" name="search" value="data">
                    <div id="search-form" >
                        <input type="text" name="cari" value="" placeholder="keyword">
                        <button type="submit" class="btn btn-default btn-xs">
                            <span class="fas fa-lup"></span> cari
                        </button>
                    </div>
                </form>

                <form action="admin.php?page=qodr-publikasi" method="POST">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#popup_publikasi_tambah_data">
                    <span class="fas fa-plus"></span> Tambah Data
                </button>
                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm(\'yakin mau di hapus? hati2\');">
                    <span class="fas fa-times"></span> Hapus Data
                </button><br><br>
                <input type="hidden" name="multi_del" value="del">
                <table class="table table-hover" >
                    <tr>
                        <th><input type="checkbox"  onclick="return cek_all(this)"></th>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tgl</th>
                        <th>Link</th>
                        <th>Publisher</th>
                        <th>Action</th>
                    </tr>';
                if(!empty($db)){
                    if (empty($_GET['hal'])) {
                        $_GET['hal']=1;
                    }
                    $no=($_GET['hal']-1)*$jml_per_hal;
                    foreach ($db as $k => $v) {
                        $no++;
                        $html.="<tr id='tr_".$v['id']."'>
                            <td><input type='checkbox' class='centang' name='dt[]' value='".$v['id']."'></td>
                            <td>".$no."</td>
                            <td class='judul'>".$v['judul']."</td>
                            <td class='tgl'>".$v['tgl']."</td>
                            <td class='link'>".$v['link']."</td>
                            <td class='publisher' >".$v['publisher']."</td>
                            <td>
                                <a onclick='return confirm(\"Yakin hapus?\");' href='admin.php?page=qodr-publikasi&action=del&id=".$v['id']."' class='btn btn-xs btn-danger'>
                                    <span class='fas fa-times'></span>
                                </a>

                                <button type='button' class='btn btn-primary btn-xs' data-toggle='modal' onclick='return pindah_data(".$v['id'].")' data-target='#popup_publikasi'>
                                    <span class='fas fa-pen'></span>
                                </button>

                            </td>
                        </tr>";
                    }
                }
                $html.= "</table>
                </form>
                <div class='pagination' align='center'>";
                    $jml_hal=ceil($jml_data/$jml_per_hal);
                    for ($i=1; $i <= $jml_hal; $i++) { 
                        $html.="<a href='admin.php?page=qodr-publikasi&hal=$i'>$i</a> ";
                    }

                $html.="
                </div>";
    return $html;
}

?>