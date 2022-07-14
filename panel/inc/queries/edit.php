<?php

if( $_POST ) {

    include_once '../app.php';
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);

    $id = intval($_GET['id']);
    $number = $_POST['number'];
    $number2 = $_POST['number2'];
    $ip = $_POST['ip'];
    $data = [
        'number'   => $number,
        'number2'   => $number2,
    ];

    $db->where ('ip', $ip);
    $db->update ('data', $data);
    $db->disconnect();

    header("location: ../../edit.php?success=1");
    exit();

}

?>