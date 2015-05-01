<?php
$cnf['connection_url']='mysql:host=localhost;dbname=teamwork';
$cnf['username']='root';
$cnf['password']='';
$cnf['pdo_options'][PDO::MYSQL_ATTR_INIT_COMMAND]="SET NAMES 'UTF8'";
$cnf['pdo_options'][PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;

return $cnf;