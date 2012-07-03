<?

abstract class Controller {
    protected $tpl;

    public function __construct(){
        global $config;
        $this->tpl = new Smarty;
        $this->tpl->assign('siteurl', $config['siteurl']);
        $this->tpl->assign('sitetitle', "Фоткер");
    }

    abstract public function indexAction();
}