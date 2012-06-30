<?php
$allconfig = array ();

if (isset ($_SERVER['SERVER_NAME']) && strstr($_SERVER['SERVER_NAME'], 'aldekein.lc') !== false) {
    $config =
    array (
        'siteurl' => 'http://photo.aldekein.lc/',
        'sitepath' => 'd:/www/home/aldekein.lc/photo/'
    );
}
else {
    $config =
    array (
        'siteurl' => 'http://fotker.fdzn.net/',
        'sitepath' => '/var/www/vhosts/fotker.fdzn.net/'
    );
}

$config = array_merge($allconfig, $config);
 
function prn ($data) {
	echo "<pre>";
	print_r ($data);
	echo "</pre><br><br>";
}
?>