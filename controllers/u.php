<?

class uController extends Controller{
    public function indexAction(){
        $username = (isset ($_GET['username'])) ? $_GET['username'] : '';
        $this->tpl->assign('username', $username);
        $this->tpl->display('u.tpl');
    }
}