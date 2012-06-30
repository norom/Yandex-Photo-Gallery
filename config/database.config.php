<?
if (isset ($_SERVER['SERVER_NAME']) && strstr($_SERVER['SERVER_NAME'], 'aldekein.lc') !== false) {
    $dbserver="127.0.0.1";
    $dbuser="root";
    $dbpass="";
    $dbname="aldekein";
}
else {
    $dbserver="127.0.0.1";
    $dbuser="taxerdbuser";
    $dbpass="jVeCr6Ua8zbtVGmx04mq";
    $dbname="taxer";
}

db::getInstance()->config($dbserver, $dbname, $dbuser, $dbpass);

?>