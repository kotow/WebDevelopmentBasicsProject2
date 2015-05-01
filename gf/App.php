<?php
namespace GF;
include_once 'Loader.php';

class App {
    private static $_instance = null;
    private $_config = null;
    private $_frontController;
    private $_session = null;
    
    private function __construct () {
        $namespace = "GF";
        $path = dirname(__FILE__) . DIRECTORY_SEPARATOR;
                
        \GF\Loader::registerNamespace($namespace, $path);
        \GF\Loader::registerAutoload();
        $this->_config = \GF\Config::getInstance();
                
        if ($this->_config->getConfigFolder() == null) {
            $this->_config->setConfigFolder('../config');
        }
    }
    
    public function setConfigFolder ($path) {
        $this->_config->setConfigFolder($path);
    }
    
    public function getConfigFolder () {
        return $this->_config->_configFolder;
    }
    
        /*
                @return type: \GF\Config
        */
    public function getConfig () {
        return $this->_config;
    }
    
    public function run () {
        if ($this->_config->getConfigFolder() == null) {
            $this->_config->_setConfigFolder('../config');
        }
            
        $this->_frontController = \GF\FrontController::getInstance();
        $_sess=$this->_config->app['session'];
        if($_sess['autostart']){
            $this->_session=new \GF\Sessions\NativeSession($_sess['name'], $_sess['time'], $_sess['path'], $_sess['domain'], $_sess['secure']);
        }
                
        $this->_frontController->dispatch();
    }

    public function getSession() {
        return $this->_session;
    }
    public function getConnection() {
        $_cnf=$this->getConfig()->database;
        $dbh=new \PDO($_cnf['connection_url'], $_cnf['username'], $_cnf['password'], $_cnf['pdo_options']);
        return $dbh;
    }
    
    public static function getInstance () {
        if (self::$_instance == null) {
            self:: $_instance = new \GF\App();
        }
            
        return self::$_instance;
    }
}