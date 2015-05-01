<?php
/**
 * Created by PhpStorm.
 * User: iwo
 * Date: 15-4-28
 * Time: 15:13
 */
namespace Controllers;
class Index {

    public function index(){
        $model= new \Models\Category();
        $res=$model->getCategories();

        $view=\GF\View::getInstance();
        $view->info=$res;
        $view->appendToLayout('body','categories');
        return $view->display('layouts.default');
    }
} 