<?
# configure
require_once 'config/general.config.php';

# load libs
require_once 'libs/router.php';
require_once 'libs/general.lib.php';
require_once 'smarty/Smarty.class.php';

$controller = (isset ($_GET['controller'])) ? $_GET['controller'] : 'index';
$action = (isset ($_GET['action'])) ? $_GET['action'] : 'index';

Router::route($controller,$action);

