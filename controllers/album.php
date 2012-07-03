<?

class albumController extends Controller{
    public function indexAction(){
        $username = (isset ($_GET['username'])) ? $_GET['username'] : '';
        $param = (isset ($_GET['param'])) ? $_GET['param'] : '';
        $this->tpl->assign('username', $username);
        $this->tpl->assign('albumid', $param);
        $this->tpl->display('album.tpl');
    }
}