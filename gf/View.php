<?php
/**
 * Created by PhpStorm.
 * User: iwo
 * Date: 15-4-30
 * Time: 12:17
 */

namespace GF;


class View {
    private static $_instance=null;
    private $viewPath=null;
    private $data=array();
    private $layoutParts=array();
    private $layoutData=array();

    private function __construct()
    {
        if(isset(\GF\App::getInstance()->getConfig()->app['viewsDir'])){
            $this->viewPath = \GF\App::getInstance()->getConfig()->app['viewsDir'];
        }
        if($this->viewPath==null){
            $this->viewPath=realpath('../views/');
        }
    }

    public function __get($name){
        return $this->data[$name];
    }

    public function __set($name, $value){
        $this->data[$name]=$value;
    }

    public function display($name, $data=array(), $returnAsString=false){
        if(is_array($data)){
            $this->data=array_merge($this->data, $data);
        }
        if(count($this->layoutParts)>0){
            foreach($this->layoutParts as $k=>$v){
                $r=$this->_includeFile($v);
                if($r){
                    $this->layoutData[$k]=$r;
                }
            }
        }
        if($returnAsString){
            return $this->_includeFile($name);
        } else {
            echo $this->_includeFile($name);
        }
    }

    public function appendToLayout($key, $template){
        if($key && $template){
            $this->layoutParts[$key]=$template;
        }
    }

    public function getLayoutData($name){
        return $this->layoutData[$name];
    }

    private function _includeFile($file){
        $p=str_replace('.', DIRECTORY_SEPARATOR, $file);
        $fl=$this->viewPath.DIRECTORY_SEPARATOR.$p.'.php';
        if(file_exists($fl) && is_readable($fl)) {
            ob_start();
            include $fl;
            return ob_get_clean();
        }
    }
    public static function getInstance(){
        if(self::$_instance==null){
            self::$_instance=new \GF\View();
        }

        return self::$_instance;
    }


}