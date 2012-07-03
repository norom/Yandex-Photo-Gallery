<?

class indexController extends Controller {
    public function indexAction() {
        if(!isset ($_GET['search'])) {
            $this->tpl->display('index.tpl');
        }
        else{
            $prepare = $_GET['search'];

            if (preg_match('%.*?/users/([^/]+)/album/([\d]+).*%', $prepare, $match)) {
                $username = $match[1];
                $albumId = $match[2];
                $afterpart = "/".$albumId."/";
            }
            else if (preg_match('%.*?/users/([^/]+)%', $prepare, $match)) {
                $username = $match[1];
                $afterpart = "/";
            }
            else {
                $username = $prepare;
                $afterpart = "/";
            }

            Router::redirectUrl('u/'.$username.$afterpart);
        }
    }
}