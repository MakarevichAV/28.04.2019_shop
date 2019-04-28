<?php 
    //echo 'Привет';
    include ($_SERVER['DOCUMENT_ROOT'] .'/php/connect.php');
    
    // $cat = $_GET['cat'];
    
    $query = "SELECT * FROM `catalog`";
    
    $goods = mysqli_query($db, $query);  

    //echo mysqli_num_rows($goods);

    $goods_array = [];

    while ( $row = mysqli_fetch_assoc($goods) ) {
       array_push( $goods_array, $row);
    }
    
    //JSON 

    //print_r( $goods_array );


    echo json_encode($goods_array);








    //echo '<pre>';
    //print_r($goods_array);
    //echo '</pre>';






?>

