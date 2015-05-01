<?php
/**
 * Created by PhpStorm.
 * User: iwo
 * Date: 15-4-30
 * Time: 19:54
 */

namespace Controllers;


class Question {

    public function getQuestion($id){
        $q=new \Models\Question();
        $res=$q->getQuestion($id[0]);
        $view=\GF\View::getInstance();
        $view->info=$res;
        $view->id=$id[0];
        $view->appendToLayout('body','question');
        $view->display('layouts.default');
    }

    public function addAnswer($id){
        if(isset($_POST['text']) ){
            $a=new \Models\Question();
            $a->addAnswer($id[0]);
            header('Location: /public/forum/getquestion/'.$id[0]);
        }
    }

    public function getQuestionsByCategory($id){
        $cat=new \Models\Question();
        $res=$cat->getQuestionByCat($id[0]);
        $view=\GF\View::getInstance();
        $view->info=$res[0];
        $view->cat=$res[1]['topic_name'];
        $view->appendToLayout('body','index');
        return $view->display('layouts.default');
    }

    public function addQuestion(){
        if(!isset($_SESSION['isLogged'])){
            header('Location: /public/forum/login');
            ob_end_flush();
        }
        $q=new \Models\Question();
        $id=$q->postQuestions();
        return $this->getQuestion($id);
    }

    public function search(){
        $cat=new \Models\Question();
        $res=$cat->search();
        $view=\GF\View::getInstance();
        $view->info=$res;
        $view->appendToLayout('body','index');
        return $view->display('layouts.default');
    }
} 