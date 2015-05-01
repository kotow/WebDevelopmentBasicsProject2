<?php
/**
 * Created by PhpStorm.
 * User: iwo
 * Date: 15-4-30
 * Time: 15:43
 */

namespace Controllers;


class User {
    private $user=null;

    public  function __construct(){
        $this->user=new \Models\User();
    }

    public function register(){
        $error='';
        if(isset($_POST['username'])){
            $error=$this->user->register();
            if($error!=''){
                $view=\GF\View::getInstance();
                $view->appendToLayout('body','register');
                $view->error=$error;
                return $view->display('layouts.default');
            }
            header("Location: /public/");
            exit;
        }
    }




    public function login(){
        if(isset($_POST['username']) && isset($_POST['password'])){
            $error=$this->user->login();
            if(!$error){
                header("Location: /public/");
            } else {

                $view=\GF\View::getInstance();
                $view->appendToLayout('body','login');
                $view->error=$error;
                return $view->display('layouts.default');
            }
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: \public');
        exit;
    }

    public function profile(){

    }



} 