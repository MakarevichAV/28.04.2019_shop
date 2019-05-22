<?php

    session_start();

    $data_id = $_GET['id'];
    // $_SESSION = [
    //     'items' => [],
    //     'count' => ''
    // ];
    // $_SESSION['count'] = 0;
    $_SESSION['count']++;


    echo json_encode($_SESSION['count']);

?>