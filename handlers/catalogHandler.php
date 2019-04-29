<?php
    include($_SERVER['DOCUMENT_ROOT'].'/php/connect.php');

    $qr = "SELECT * FROM `catalog`";
    $goods = mysqli_query($db, $qr);

    //echo mysqli_num_rows($goods);  // кол-во строчек

    $goods_array = [];
    while ( $row = mysqli_fetch_assoc($goods) ) {
        array_push( $goods_array, $row );
    }

    // Конвертация для JS
    // JSON - JS Object Notation - Формат для отправки данных
    echo json_encode($goods_array);   // перевели в формат JSON


?>