<?php
namespace GF;

final class Loader {
        private static $namespaces = array();
    
        private function __construct () {
        }
    
        public static function registerAutoload () {
                $autoloadObj = array("\GF\Loader", "autoload");
                spl_autoload_register($autoloadObj);
        }
    
        public static function autoload ($class) {
                self::loadClass($class);
        }

        public static function loadClass ($class) {
            foreach(self::$namespaces as $k => $v){
                if(strpos($class, $k) === 0){
                    $f =str_replace('\\', DIRECTORY_SEPARATOR, $class);
                    $f = substr_replace($f, $v, 0, strlen($k)).'.php';
                    $f = realpath($f);
                    if($f && is_readable($f)){
                        include $f;
                    }
                    break;
                }
            }
        }

        public static function registerNamespaces($ar) {
            if(is_array($ar)) {
                foreach($ar as $k=>$v) {
                    self::registerNamespace($k, $v);
                }
            }
        }
        public static function registerNamespace ($namespace, $path) {
            $namespace = trim($namespace);
            if(strlen($namespace) > 0){
                if(!$path){
                    throw new \Exception('Invalid path');
                }
                $_path = realpath($path);
                if($_path && is_dir($_path) && is_readable($_path)){
                    self::$namespaces[$namespace.'\\'] = $_path . DIRECTORY_SEPARATOR;
                } else {
                    throw new \Exception('Namespace directory read error:' . $path);
                }
            } else {
                throw new \Exception('Invalid namespace:' . $namespace);
            }
        }
    
        public static function getNamespaces () {
                return self::$namespaces;
        }
    
        public static function removeNamespaces ($namespace) {
                unset(self::$namespaces[$namespace]);
        }
    
        public static function clearNamespaces () {
                self::$namespaces = array();
        }
}