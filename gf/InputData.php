<?php
/**
 * Created by PhpStorm.
 * User: iwo
 * Date: 15-4-29
 * Time: 18:07
 */

namespace GF;


class InputData {
    private $_instance=null;
    private $_get=array();
    private $_post=array();
    private $_cookies=array();

    public static function getInstance () {
        if (self::$_instance == null) {
            self:: $_instance = new \GF\InputData();
        }

        return self::$_instance;
    }

    private function __construct() {
        $this->_cookies=$_COOKIE;
    }

    public function setGet($get)
    {
        if(is_array($get)) {
            $this->_get = $get;
        }
    }

    public function setPost($post)
    {
        if(is_array($post)) {
            $this->_post = $post;
        }
    }

    public function hasGet($id) {
        return array_key_exists($id, $this->_get);
    }

    public function hasPost($name) {
        return array_key_exists($name, $this->_post);
    }

    public function hasCookies($name) {
        return array_key_exists($name, $this->_cookies);
    }

    public function get($id, $normalize=null, $default=null) {
        if($this->hasGet($id)){
            if($normalize!=null){
                //todo
            }
            return $this->_get[$id];
        }
        return $default;
    }

    public function post($id, $normalize=null, $default=null) {
        if($this->hasPost($id)){
            if($normalize!=null){
                //todo
            }
            return $this->_post[$id];
        }
        return $default;
    }
    public function cookies($id, $normalize=null, $default=null) {
        if($this->hasCookies($id)){
            if($normalize!=null){
                //todo #23 Common.php
            }
            return $this->_cookies[$id];
        }
        return $default;
    }
} 