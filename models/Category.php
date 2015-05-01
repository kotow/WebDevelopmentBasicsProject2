<?php
/**
 * Created by PhpStorm.
 * User: iwo
 * Date: 15-4-30
 * Time: 19:58
 */

namespace Models;


class Category {

    public function __construct(){
        $this->clean=new \GF\Common();
        $this->db= new \GF\DB\SimpleDB();
    }

    public function getCategories(){
        $this->db->prepare('SELECT t.topic_ID, t.topic_name, t.topic_info, count(th.theme_ID) as a
        from `topic` as t
        left join `theme` as th
        on t.topic_ID=th.topic_ID
        GROUP BY t.topic_ID
        ');
        $this->db->execute();
        return $this->db->fetchAllAssoc();
    }

    public function addCategory(){

    }

    public function editCategory(){

    }

    public function deleteCategory(){

    }


} 