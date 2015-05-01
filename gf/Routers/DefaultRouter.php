<?php
/**
 * Created by PhpStorm.
 * User: iwo
 * Date: 15-4-27
 * Time: 14:47
 */

namespace GF\Routers;


class DefaultRouter implements \GF\Routers\IRouter {
    private $controller = null;
    private $method = null;
    private $params = array();

    public function getURI() {
        $len=strlen($_SERVER['SCRIPT_NAME'])+1;
        return $_uri = substr($_SERVER['PHP_SELF'], $len);
    }

} 