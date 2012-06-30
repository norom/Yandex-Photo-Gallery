<?

require_once '/controllers/abstract.controller.php';

class Router{
    static function route($controller = 'index', $action = 'index'){
        try{
        require_once '/controllers/'.$controller.'.php';
        $controller = $controller.'Controller';
        $worker = new $controller;
        $action = $action.'Action';
        $worker->$action();
        }
        catch (Exception $e){
            echo('Произошел раскол крабовой туманности в момент '.str_rot13($controller).$e->getMessage()); die(0);
        }
    }
    static function redirect($controller = 'index', $action = 'index'){
        self::redirectUrl("/?controller=$controller&action=$action");
    }
    static function redirectUrl($url){
        header ('Location: '.$url);
        exit;
    }
}
