<?php
namespace GF;

class FrontController {
    private static $_instance=null;
    private $ns=null;
    private $controller='index';
    private $method='index';
    private $params=array();

    private function  __construct(){
    }


    public static function  getInstance(){

        if(self::$_instance==null){
            self::$_instance= new FrontController();
        }

        return self::$_instance;
    }

    public function dispatch() {
        $a = new \GF\Routers\DefaultRouter();
        $_uri = $a->getURI();
        $routes = \GF\App::getInstance()->getConfig()->routes;
        foreach($routes as $k=>$v) {
            if(strpos($_uri, $k)===0) {
                $this->ns=$v['namespace'];
                $_uri=substr($_uri, strlen($k) + 1);
                break;
            }
        }
        if($this->ns==null && $routes['*']['namespace']) {
            $this->ns= $routes['*']['namespace'];
        }

        $_params = explode('/', $_uri);
        if ($_params[0]) {
            $this->controller = strtolower($_params[0]);

            // if we do not have controller and method we don't have params
            if ($_params[1]) {
                $this->method = strtolower($_params[1]);

                unset($_params[0], $_params[1]);
                $this->params = array_values($_params);
            }
        }
        //#18 14:00
        $f = $this->ns.'\\'.ucfirst($this->controller);
        $newController = new $f();
        $newController->{$this->method}($this->params);
    }
}