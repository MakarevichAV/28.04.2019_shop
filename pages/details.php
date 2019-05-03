<?php
    include($_SERVER['DOCUMENT_ROOT'].'/php/connect.php');

    // Пункты меню из базы данных
    include($_SERVER['DOCUMENT_ROOT'].'/modules/menuSql.php');

    // Берем из массива ГЕТ id переданного товара (на который кликнули)
    $productId = $_GET['id'];

    // Ищем товар с переданным ID в БД
    $qrProduct = "SELECT * FROM `catalog` WHERE `id` = $productId";
    $resProduct = mysqli_query($db, $qrProduct);
    $rowProduct = mysqli_fetch_assoc($resProduct);

    // Подставляем название товара в title
    $title = $rowProduct['name'];

    // Берем id подкатегории 
    $subcat = $rowProduct['category_id'];

    // Ищем название подкатегории 
    $subCatID = "SELECT * FROM `categories` WHERE `id` = $subcat";
    $resCatID = mysqli_query($db, $subCatID);
    $rowCatID = mysqli_fetch_assoc($resCatID);

    // Берем id родительской категории 
    $parentID = $rowCatID['parent_category'];
    
    // Ищем родительскую категорию
    $parentCat = "SELECT * FROM `categories` WHERE `id` = $parentID";
    $resParent = mysqli_query($db, $parentCat);
    $rowParent = mysqli_fetch_assoc($resParent);


    // Подключение шапки сайта
    include($_SERVER['DOCUMENT_ROOT'].'/modules/head.php');
?>

<div class="bread-crumbs">
    <a href="/index.php" class="bread-crumbs-item">Главная</a> /
    <a href="/pages/catalog.php?id=<?=$rowCatID['parent_category']?>" class="bread-crumbs-item"><?=$rowParent['name']?></a> /
    <a href="/pages/catalog.php?id=<?=$rowCatID['id']?>" class="bread-crumbs-item"><?=$rowCatID['name']?></a> /
    <a href="#" class="bread-crumbs-item"><?=$rowProduct['name']?></a>
</div>

<div class="picture margin-bottom20"" style="background-image: url(/images/catalog/<?=$rowProduct['pic']?>)"></div>
<h1 class="head1"><?=$rowProduct['name']?></h1>
<p class="article margin-bottom20">Артикул: <?=$rowProduct['article']?></p>
<p class="subhead"><?=$rowProduct['price']?> руб.</p>
<p class="description margin-bottom20"><?=$rowProduct['description']?></p>

<?php
    echo '<pre>';
    print_r($rowProduct);
    print_r($rowCatID);
    echo '</pre>';
?>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/modules/footer.php');
?>
