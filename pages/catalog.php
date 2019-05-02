<?php
    include($_SERVER['DOCUMENT_ROOT'].'/php/connect.php');

    // Пункты меню из базы данных
    $qr_parent = "SELECT * FROM `categories` WHERE `parent_category` = 0";
    $cats_parent = mysqli_query($db, $qr_parent);
    // $template = [];
    while ( $row_cats_parent = mysqli_fetch_assoc($cats_parent) ) {
        $template['cats_parent'][] = $row_cats_parent;
    }

    // Берем количество полученных строк, в дальнейшем будем сравнивать с этим числом передаваемое число в ГЕТе (строка *)
    $num_cats_parent = mysqli_num_rows($cats_parent);
    // print_r($num_cats_parent);

    // пустая переменная, будем заносить в нее значение родительской категории
    $cat_id = '';

    // Если существует элемент массива id (т е если он был передан)
    if ( isset($_GET['id']) ) {
        // то проверяем его на пустоту
        // если непустой
        if ( !empty($_GET['id']) ) {

            // то проверяем чтобы число было не больше количества родительских категорий
            if ($_GET['id'] > $num_cats_parent) {   // если больше  // *
                // то присваиваем переменной значение по умолчанию 1 (отобразятся товары для мужчин)
                $cat_id = 1;
            } else {
                // иначе присваиваем значение передаваемого id переменной 
                $cat_id = $_GET['id'];
            }

        } else {
            // иначе присваиваем значение передаваемого id переменной 
            $cat_id = 1;
        }

    } else {
        // иначе присваиваем значение передаваемого id переменной 
        $cat_id = 1;
    }

    // Выбираем строку из таблицы категорий где родительская категория равна переданной в массив ГЕТ
    $qr_cats = "SELECT * FROM `categories` WHERE `parent_category` = $cat_id";
    $cats = mysqli_query($db, $qr_cats);
    while ( $row_cats = mysqli_fetch_assoc($cats) ) {
        $template['cats'][] = $row_cats;
    }

    // echo '<pre>';
    // print_r($template);
    // echo '</pre>';

    // Выбираем строку с родительской категорией товаров, в зависимости от того, какой id был передан в массиве $_GET
    $qr_cat_parent = "SELECT * FROM `categories` WHERE `id` = $cat_id";
    $result_parent = mysqli_query($db, $qr_cat_parent);
    $row_parent = mysqli_fetch_assoc($result_parent);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Магазин одежды</title>
</head>
<body>
    <div class="wrapper padding30">
        <div class="header">
            <div class="menu">
                <a href="#" class="logo margin-right"></a>
                <div class="menu-button">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
                <div class="nav">
                    <?php foreach ($template['cats_parent'] as $key => $val): ?>
                        <a href="/pages/catalog.php?id=<?=$val['id']?>" class="item"><?=$val['name']?></a>
                    <?php endforeach; ?>
                    <!-- <a href="#" class="item">Женщинам</a>
                    <a href="#" class="item">Мужчинам</a>
                    <a href="#" class="item">Детям</a> -->
                    <a href="#" class="item">Новинки</a>
                    <a href="#" class="item">О нас</a>
                </div>
            </div>
            <div class="account">
                <div class="user">
                    <div class="account-icon"></div>
                    <p class="hello">Привет, <span class="user-name">Шурик</span> (<span class="exit">выйти</span>)</p>
                </div>
                <a href="#" class="basket">
                    Корзина(<span class="number">5</span>)
                </a>
            </div>
        </div>
        <div class="bread-crumbs">
            <a href="#" class="bread-crumbs-item">Главная</a> /
            <a href="/pages/catalog.php?id=<?=$_GET['id']?>" class="bread-crumbs-item"><?=$row_parent['name']?></a>
        </div>
        <div class="content" id="catalog">
            <h1 class="head1"><?=$row_parent['name']?></h1>
            <p class="subhead">Все товары</p>
        </div>
        <div class="filter">
            <div class="select">
                <p class="filter-item">Категория <span class="arrow">&#9660;</span></p>   <!--&#9650;-->
                <div class="select-item">

                    <?php foreach ($template['cats'] as $key => $val):?>
                        <label class="option">
                            <input type="radio" name="subcat" value="<?=$val['id']?>" class="subcat">
                            <?=$val['name']?>
                        </label>
                    <?php endforeach; ?>  

                </div>
            </div>
            <div class="select">
                <p class="filter-item">Размер <span class="arrow">&#9660;</span></p>   <!--&#9650;-->
                <div class="select-item">
                    <p class="option">XS</p>
                    <p class="option">S</p>
                    <p class="option">M</p>
                    <p class="option">L</p>
                    <p class="option">XL</p>
                    <p class="option">XXL</p>
                    <p class="option">XXXL</p>
                </div>
            </div>
            <div class="select">
                <p class="filter-item">Стоимость <span class="arrow">&#9660;</span></p>   <!--&#9650;-->
                <div class="select-item">
                    <p class="option"><span>0 - 1000</span> руб.</p>
                    <p class="option"><span>1000 - 3000</span> руб.</p>
                    <p class="option"><span>3000 - 6000</span> руб.</p>
                    <p class="option"><span>6000 - 20000</span> руб.</p>
                </div>
            </div>
        </div>
    <!-- </div>
    <div class="wrapper"> -->
        <div class="goods">
            
        </div>
        <div class="content-nav padding-bottom-330">
            <div class="content-nav-item opened">1</div>
            <div class="content-nav-item">2</div>
            <div class="content-nav-item">3</div>
            <div class="content-nav-item">4</div>
        </div>
    <!-- </div>
    <div class="wrapper padding3030"> -->
        <div class="footer">
            <div class="section border-right">
                <h2 class="footer-head">Коллекции</h2>
                <a href="#" class="foter-nav">Женщинам (<span class="number-women">1725</span>)</a>
                <a href="#" class="foter-nav">Мужчинам (<span class="number-men">635</span>)</a>
                <a href="#" class="foter-nav">Детям (<span class="number-children">2514</span>)</a>
                <a href="#" class="foter-nav">Новинки (<span class="number-new">76</span>)</a>
            </div>
            <div class="section border-right flex-justify-center">
                <div class="score-info">
                    <h2 class="footer-head">Магазин</h2>
                    <a href="#" class="foter-nav">О нас</a>
                    <a href="#" class="foter-nav">Доставка</a>
                    <a href="#" class="foter-nav">Работай с нами</a>
                    <a href="#" class="foter-nav">Контакты</a>
                </div>
            </div>
            <div class="section flex-justify-center">
                <div class="company-info">
                    <h2 class="footer-head">Мы в социальных сетях</h2>
                    <p class="footer-text">Сайт разработан в inordic.ru</p>
                    <p class="footer-text margin-botton-22">2019 &copy; Все права защищены</p>
                    <div class="social">
                        <a href="#" class="social-item twitter"></a>
                        <a href="#" class="social-item fb"></a>
                        <a href="#" class="social-item insta"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/catalog.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>