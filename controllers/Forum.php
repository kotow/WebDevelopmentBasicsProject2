<?php
/**
 * Created by PhpStorm.
 * User: iwo
 * Date: 15-4-30
 * Time: 19:51
 */

namespace Controllers;


class Forum {

    public function __construct(){
        $this->view=\GF\View::getInstance();
    }

    public function login(){
        $this->view->appendToLayout('body','login');
        $this->view->display('layouts.default');
    }

    public function register(){
        $this->view->appendToLayout('body','register');
        $this->view->display('layouts.default');
    }

    public function search(){
        $this->view->appendToLayout('body', 'search');
        $this->view->display('layouts.default');

    }

    public function getQuestion($id){
        $q=new \Models\Question();
        $res=$q->getQuestion($id[0]);
        $this->view->info=$res;
        $this->view->id=$id[0];
        $this->view->appendToLayout('body','question');
        $this->view->display('layouts.default');
    }

    public function getQuestionsByCategory(){
        $db = new \GF\DB\SimpleDB();
        $db->prepare('SELECT * from `message` WHERE topic_ID = 1');
        $db->execute();
        $res=$db->fetchAllAssoc();
        $this->view->info=$res;
        $this->view->appendToLayout('body','question');
        $this->view->display('layouts.default');
    }

    public function getQuestionsByTag(){

    }

    public function post() {
        $this->view->appendToLayout('body','post');
        $this->view->display('layouts.default');
    }
    public function answer($id) {
        $this->view->id=$id[0];
        $this->view->appendToLayout('body','answer');
        $this->view->display('layouts.default');
    }
} 