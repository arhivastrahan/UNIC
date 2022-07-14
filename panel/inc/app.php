<?php
session_start();
error_reporting(0);

$db_infos = [
    'host'              => 'localhost',
    'db_user'           => 'root',
    'db_pass'           => '',
    'database_name'     => 'unicaja'
];

include_once 'MysqliDb.php';
include_once 'functions.php';
?>