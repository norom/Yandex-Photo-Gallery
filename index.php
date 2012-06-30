<?
# configure
require_once 'config/general.config.php';

# load libs
require_once 'libs/db.lib.php';
require_once 'config/database.config.php';
require_once 'libs/general.lib.php';


# Smarty
require_once 'smarty/Smarty.class.php';
$tpl = new Smarty;
$tpl->assign('siteurl', $config['siteurl']);
$tpl->assign('sitetitle', "Фоткер");
# you should request a photo/album
// if (!isset ($_GET['p']) || empty($_GET['p']) || !preg_match('%([\w]+)/([\d]+)%i', $_GET['p'], $regs)) go_to('http://aldeke.in/', true);

$action = (isset ($_GET['action'])) ? $_GET['action'] : 'index';
$username = (isset ($_GET['username'])) ? $_GET['username'] : '';
$param = (isset ($_GET['param'])) ? $_GET['param'] : '';

if ($action == 'album') {
    # check if album is present, show photos
    // http://api-fotki.yandex.ru/api/users/aldekein/
    // http://api.yandex.ru/fotki/doc/operations-ref/album-get.xml
	// http://api.yandex.ru/fotki/doc/concepts/json.xml !!!
    // http://api-fotki.yandex.ru/api/users/aldekein/album/183105/photos/

    $tpl->assign('username', $username);
    $tpl->assign('albumid', $param);
    $tpl->display('album.tpl');
}
else if ($action == 'u') {
    # show user's albums

    $tpl->assign('username', $username);
    $tpl->display('u.tpl');
}
else if ($action == 'index') {
    $tpl->display('index.tpl');
}
else echo('Произошел раскол крабовой туманности в момент '.str_rot13($action));
?>