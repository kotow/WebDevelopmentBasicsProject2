<?php
/**
 * Created by PhpStorm.
 * User: iwo
 * Date: 15-4-30
 * Time: 19:57
 */
namespace Models;

class Question {
    public function __construct(){
        $this->clean=new \GF\Common();
        $this->db= new \GF\DB\SimpleDB();
    }
    public function getQuestion($id){
        $this->db->prepare('SELECT * from `message` WHERE theme_ID = :id');
        $this->db->id=$id[0];
        $this->db->execute();
        return $this->db->fetchAllAssoc();
    }

    public function postQuestions(){
        if(isset($_POST['submit'])){
            $topic=$_GET['topic'];
            $theme=$this->clean->xss_clean($_POST['theme']);
            $info=$this->clean->xss_clean($_POST['info']);
            $title=$this->clean->xss_clean($_POST['info']);
            $msg=$this->clean->xss_clean($_POST['message']);
            $user=$_SESSION['user'];
            $date=date('Y-m-d H:i:s');
            $this->db->prepare('INSERT INTO `theme`(`theme_name`, `theme_info`, `topic_ID`)
             VALUES (:theme,:info,:topic)');
            $this->db->theme=$theme;
            $this->db->info=$info;
            $this->db->topic=2;//$topic;
            $this->db->execute();
            $id=$this->db->getLastInsertId();
            $this->db->prepare('INSERT INTO `message`(`message_Title`, `message_Text`, `message_User`, `message_Data`, `theme_ID`)
             VALUES (:title,:msg,:user,:date,:id)');
            $this->db->title=$title;
            $this->db->msg=$msg;
            $this->db->user=$user;
            $this->db->date=$date;
            $this->db->id=$id;
            $this->db->execute();

            return array($id);
        }
    }

    public function getQuestionByCat($id){
        $this->db->prepare('SELECT t.theme_name, t.theme_info, count(m.message_ID) as a, t.theme_views, t.theme_ID
        FROM `theme` as t
        LEFT JOIN `message` as m
        ON t.theme_ID=m.theme_ID
        WHERE `topic_ID`=:id
        GROUP BY t.theme_ID
        ORDER BY m.message_Data');
        $this->db->id=$id;
        $this->db->execute();
        $res=$this->db->fetchAllAssoc();
        $this->db->prepare('SELECT topic_name FROM `topic` WHERE `topic_ID`=:id');
        $this->db->id=$id;
        $this->db->execute();
        $cat=$this->db->fetchRowAssoc();
        return array($res,$cat);
    }

    public function getQuestionByTag(){

    }

    public function search(){
        $letter=$_POST['name'];
        var_dump($_POST);
        if($_POST['where']== 'theme'){
                $this->db->prepare("SELECT  * FROM theme WHERE theme_name LIKE '%:s%' ");
        } else {
                $this->db->prepare("SELECT  * FROM message WHERE message_text LIKE '%:s%' ");
        }
        $this->db->s=$letter;
        $this->db->execute();
        return $this->db->fetchAllAssoc();
    }

    public function addAnswer($id){
        $theme=$id;
        $text=$this->clean->xss_clean($_POST['text']);
        $user=$_SESSION['user'];
        $date=date('Y-m-d H:i:s');
        $this->db->prepare('INSERT INTO `message`( `message_Text`, `message_User`, `message_Data`, `theme_ID`) VALUES ( :text, :user, :date, :theme)');

        $this->db->text=$text;
        $this->db->user=$user;
        $this->db->date=$date;
        $this->db->theme=$theme;
        $this->db->execute();
    }

} 