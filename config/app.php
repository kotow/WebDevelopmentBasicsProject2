<?php
/**
 * Created by PhpStorm.
 * User: iwo
 * Date: 15-4-28
 * Time: 12:21
 */

$cnf['namespaces']['Controllers'] = '../controllers';
$cnf['namespaces']['Models'] = '../models';
$cnf['namespaces']['Views'] = '../views';

$cnf['session']['autostart']=true;
$cnf['session']['type']='Native';
$cnf['session']['name']='_sess';
$cnf['session']['time']=3600;
$cnf['session']['path']='/';
$cnf['session']['domain']='';
$cnf['session']['secure']=false;

return $cnf;