<?php

$config = [
    'host'		    => 'localhost',
    'username' 	=> 'root',
    'password' 	=> 'root',
    'dbname' 	  => 'helpdesk',
];

$db = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'], $config['username'], $config['password']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
