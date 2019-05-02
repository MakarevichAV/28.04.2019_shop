<?php
    include ($_SERVER['DOCUMENT_ROOT'].'/php/connect.php');
    
    $cat = $_GET['id'];

    // Ищем дочерние категории на основании переданной родительской категории
    $query = "SELECT * FROM `categories` WHERE `parent_category` = $cat";
    $result = mysqli_query($db, $query);

    // Если количество строк в результате не равно 0 (т е пришли родительские категории) 
    if ( mysqli_num_rows($result) !=0 ) {

        // нужно записать категории в виде (4,5,6,7)
        $allCatsID = []; // пустой массив для записи в него результата
        // перебираем результат
        while ( $row_parent = mysqli_fetch_assoc($result) ) {
            // идентификаторы каждой строчки помещаем в массив
            $allCatsID[] = $row_parent['id'];
        }
        // превращаем массив в строку
        $catsLine = implode(',', $allCatsID);

        // print_r($catsLine);
        // die();

        $qr = "SELECT * FROM `catalog` WHERE `category_id` IN ($catsLine)";
        $goods = mysqli_query($db, $qr);

        //echo mysqli_num_rows($goods);  // кол-во строчек

        $goods_array = [];
        while ( $row = mysqli_fetch_assoc($goods) ) {
            array_push( $goods_array, $row );
        }

        // Конвертация для JS
        // JSON - JS Object Notation - Формат для отправки данных
        echo json_encode($goods_array);   // перевели в формат JSON

    } else {

        // ищем товары, соответствующие подкатегориям
        $query = "SELECT * FROM `catalog` WHERE `category_id` = $cat";
        $goods = mysqli_query($db, $query);

        $goods_array = [];

        while ( $row = mysqli_fetch_assoc($goods) ) {
            $goods_array[] = $row;
        }

        echo json_encode($goods_array);
    }

    


?>