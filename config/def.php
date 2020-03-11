<?php
date_default_timezone_set('Asia/Jakarta');
if($_SERVER['HTTP_HOST'] == 'wp-dropbox.local'){
    define("URL_REMOTE","http://localhost/qodr.or.id/");
    define("API_KEY", 'X186Ll9fMy5fOl8uLS0uX186Ll86Ni5fXzMuX183Ll9fOA==');//local
    define("DATA_SOURCE",'offline');//cache or online
}else{
    define("URL_REMOTE","http://qodr.or.id/");
    define("API_KEY", 'XzI0Ll9fOC5fXzMuX182Ll9fMy40OC5fOl8uX18zLl9fXw==');
    define("DATA_SOURCE",'online');//cache or online
}
define("FK", __FILE__);
define("REKAP_PATH",__DIR__.'/rekap/');