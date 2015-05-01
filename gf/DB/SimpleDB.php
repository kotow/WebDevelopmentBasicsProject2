<?php
/**
 * Created by PhpStorm.
 * User: iwo
 * Date: 15-4-29
 * Time: 19:07
 */

namespace GF\DB;


class SimpleDB {

    private $db=null;
    private $sql=null;
    private $stmt=null;
    private $params=array();

    public function __construct() {
        $this->db= \GF\App::getInstance()->getConnection();
    }

    public function __set($name, $value){
        $this->params[$name]=$value;
    }

    public function prepare($sql, $params=array(), $pdoOptions=array()) {
        $this->stmt=$this->db->prepare($sql, $pdoOptions);
        $this->params=$params;
        $this->sql=$sql;

        return $this;
    }

    public function execute($params=array()) {
        if($params) {
            $this->params=$params;
        }
        $this->stmt->execute($this->params);

        return $this;
    }

    public function fetchAllAssoc() {
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchRowAssoc() {
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetchAllNum() {
        return $this->stmt->fetchAll(\PDO::FETCH_NUM);
    }

    public function fetchRowNum() {
        return $this->stmt->fetch(\PDO::FETCH_NUM);
    }

    public function fetchAllObj() {
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function fetchRowObj() {
        return $this->stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function fetchAllColumn($column) {
        return $this->stmt->fetchAll(\PDO::FETCH_COLUMN, $column);
    }

    public function fetchRowColumn($column) {
        return $this->stmt->fetch(\PDO::FETCH_COLUMN, $column);
    }

    public function fetchAllClass($class) {
        return $this->stmt->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public function fetchRowClass($class) {
        return $this->stmt->fetch(\PDO::FETCH_CLASS, $class);
    }

    public function getLastInsertId() {
        return $this->db->lastInsertId();
    }

    public function getAffectedRows(){
        return $this->stmt->rowCount();
    }

    public function getSTMT() {
        return $this->stmt;
    }
} 