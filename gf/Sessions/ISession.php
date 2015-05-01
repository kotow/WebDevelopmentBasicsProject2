<?php
/**
 * Created by PhpStorm.
 * User: iwo
 * Date: 15-4-30
 * Time: 11:31
 */

namespace GF\Sessions;


interface ISession {

    public function __get($name);
    public function __set($name, $value);
    public function destroySession();
    public function getSessionId();
    public function saveSession() ;
} 