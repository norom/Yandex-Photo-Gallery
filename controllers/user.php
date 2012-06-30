<?

class userController extends Controller{
    public function indexAction(){
        Router::redirect('user','login');
    }

    public function registrationAction(){
        $this->tpl->display('register.tpl');
    }

    public function loginAction(){
        $this->tpl->display('login.tpl');
    }
}