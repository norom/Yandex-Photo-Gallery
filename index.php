<?
# configure
require_once 'config/general.config.php';

# load libs
require_once 'libs/db.lib.php';
require_once 'libs/general.lib.php';

# Smarty
require_once 'smarty/Smarty.class.php';
$tpl = new Smarty;

# you should request a photo/album
if (!isset ($_GET['p']) || empty($_GET['p']) || !preg_match('%([\w]+)/([\d]+)%i', $_GET['p'], $regs)) go_to('http://aldeke.in/', true);

$action = $regs[1];
$param = $regs[2];

if ($action == 'album') {
    # check if album is present, show photos

    $tpl->display('album.tpl');
}
else go_to('http://aldeke.in/', true);
?>