<?

class indexController extends Controller{
    public function indexAction(){
        if(!isset ($_GET['search'])){
            $this->tpl->display('index.tpl');
        }
        else{
            $prepare = $_GET['search'];
            $user = $prepare;
            Router::redirectUrl('u/'.$user.'/');
        }
    }
}