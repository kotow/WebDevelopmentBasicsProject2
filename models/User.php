<?php
/**
 * Created by PhpStorm.
 * User: iwo
 * Date: 15-4-30
 * Time: 19:57
 */

namespace Models;


class User {

    public function __construct(){
        $this->clean=new \GF\Common();
        $this->db= new \GF\DB\SimpleDB();
    }
    public function login(){
        $username=$this->clean->xss_clean($_POST['username']);
        $password=$this->clean->xss_clean($_POST['password']);
        $password = crypt(md5(sha1($password)),sha1($username));

        $this->db->prepare('SELECT * FROM `users` WHERE `User_Name` = :user AND `User_Password` = :pass');
        $this->db->user=$username;
        $this->db->pass=$password;
        $this->db->execute();
        if($this->db->fetchRowNum() > 0){
            session_start();
            echo 'Logged!';
            $_SESSION['isLogged']=true;
            $_SESSION['user']=$username;
            return false;
        }
        else{
            return '<p class="error">Incorrect Username or Password</p>';
        }
    }

    public function register(){
        $error='';
        $username=$this->clean->xss_clean($_POST['username']);
        $password=$this->clean->xss_clean($_POST['password']);
        $confpass=$this->clean->xss_clean($_POST['passwordConf']);
        $email=$this->clean->xss_clean($_POST['email']);
        $emailconf=$this->clean->xss_clean($_POST['emailConf']);
        $first_name=$this->clean->xss_clean($_POST['firstname']);
        $last_name=$this->clean->xss_clean($_POST['lastname']);
        $gender=$this->clean->xss_clean($_POST['gender']);
        if (!ctype_alnum($username)) {
            $error .= '<p class="error">Username should be alpha numeric characters only.</p>';
        }
        if (strlen($username) < 3 OR strlen($username) > 20) {
            $error .= '<p class="error">Username should be within 3-20 characters long.</p>';
        }
        if (strlen($password) < 3 OR strlen($password) > 20) {
            $error .= '<p class="error">Password should be within 3-20 characters long.</p>';
        }
        if ($confpass != $password) {
            $error .= '<p class="error">Confirm password mismatch.</p>';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= '<p class="error">Enter a valid email address.</p>';
        }
        if ($emailconf != $email) {
            $error .= '<p class="error">Confirm Email mismatch.</p>';
        }
        if (!ctype_alpha(str_replace(array("'", "-"), "",$first_name))) {
            $error .= '<p class="error">First name should be alpha characters only.</p>';
        }
        if (strlen($first_name) < 3 OR strlen($first_name) > 20) {
            $error .= '<p class="error">First name should be within 3-20 characters long.</p>';
        }
        if (!ctype_alpha(str_replace(array("'", "-"), "", $last_name))) {
            $error .= '<p class="error">Last name should be alpha characters only.</p>';
        }
        if (strlen($last_name) < 3 OR strlen($last_name) > 20) {
            $error .= '<p class="error">Last name should be within 3-20 characters long.</p>';
        }
        if ($gender != 'male' && $gender != 'female') {
            $error .= '<p class="error">Please select your gender.</p>';
        }

        if($password==$confpass && $email==$emailconf && $error==''){
            $password = crypt(md5(sha1($password)),sha1($username));
            $this->db->prepare('SELECT * FROM `users` WHERE `User_Name` = :user');
            $this->db->user=$username;
            $this->db->execute();
            if($this->db->fetchRowNum()){
                $error .= '<p class="error">Username exits. Try another username</p>';
                return $error;
            } else {
                $this->db->prepare('INSERT INTO `users`( `User_Name`, `User_Password`) VALUES (:user, :pass)');
                $this->db->user=$username;
                $this->db->pass=$password;
                $this->db->execute();
                $this->db->prepare('INSERT INTO `user_details`(`User_Id`, `User_FirstName`, `User_LastName`, `User_E-mail`, `User_Gender`) VALUES(:id, :first, :last, :mail, :gender)');
                $this->db->id=$this->db->getLastInsertId();
                $this->db->first=$first_name;
                $this->last=$last_name;
                $this->db->mail=$email;
                $this->db->gender=$gender;
                $this->db->execute();
                session_start();
                $_SESSION['isLogged']=true;
                $_SESSION['user']=$username;
            }
        }
        return $error;
    }

    public function getUserProfile(){

    }
} 