<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Интернет магазин - FitCloud</title>
    <link rel="stylesheet" href="../styles/regis.css"> 
    <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>
    <!--Admin control-->
    <header class="header">
        <div class="header__block">
            <a href="/"><h1 class="header__logo"><span class="header__title">Fit</span>Cloud Admin</h1></a>
        </div>
    </header>
    <main class="main">
        <h1>Создать товар</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" placeholder="Названия" name="name">
            <input type="text" placeholder="Цена" name="price">
            <input type="number" placeholder="Кол-во" name="count">
            <textarea name="text" id="" placeholder="Описания"></textarea>
            <input type="file" name="img_upload"><input type="submit" name="upload" value="Загрузить">

            <?php
                require_once("../api/api.php");

                if(isset($_POST["upload"])) {
                    if(!empty($_FILES['img_upload']['tmp_name'])) 
                    {
                        if(!empty($_POST["name"]) || !empty($_POST["price"]) || 
                        !empty($_POST["count"]) || !empty($_POST["text"])) {
                            if(is_numeric($_POST["price"]) && is_numeric($_POST["count"])) {
                                $img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
                                $q = "INSERT INTO store (product, price, description, quantity, img)
                                VALUES ('".$_POST["name"]."', '".$_POST["price"]."',
                                '".$_POST["text"]."', '".$_POST["count"]."', '".$img."')";
                                if(!$mysql->query($q)) {
                                    print_r("Ошибка");
                                } 
                            } else {
                                echo 'Цену и количество нужно оформлять ТОЛЬКО в цифрах!';
                            }
                        } else {
                            echo 'Заполните все поля!';
                        }
                    } else {
                        print_r("Загрузите картинку!");
                    }
                }

                if(isset($_GET['del'])) { 
                    $id = $_GET['del'];

                    $del = "DELETE FROM store WHERE store.id = $id";
                    $mysql->query($del);
                }
                
                if(isset($_GET['delor'])) {
                    $id = $_GET['delor'];

                    $del = "DELETE FROM orders WHERE orders.id = $id";
                    $mysql->query($del);
                }
            ?>
        </form>
        <div class="tables">
            <div class="tables__store">
                <table border="1" width="300">
                    <tr>
                        <th>id</th>
                        <th>Продукт</th>
                        <th>Цена</th>
                        <th>Количество</th>
                    </tr>
                    <?php
                        $q = 'SELECT * FROM store'; //вывести все товары
                        $product = $mysql->query($q);

                        while($get = $product->fetch_assoc()) {
                            echo '<tr>';
                                echo '<td>';  echo '<input class="ids" type="num" name="id" value="', $get["id"] ,'">'; echo '</td>';
                                echo '<td>'; print_r($get["product"]); echo '</td>';
                                echo '<td>'; echo $get['price'], "$"; echo '</td>';
                                echo '<td>'; print_r($get["quantity"]);  echo '</td>';
                                echo '<td>
                                <form action="" method="POST">';
                                    echo '<button><a href="?del=',$get["id"],'">Удалить</a></button>';                   
                                echo '</form>
                                </td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
            <div class="tables__order">
                <table border="1" width="300">
                    <tr>
                        <th>id</th>
                        <th>Продукт</th>
                        <th>Почтовый Индекс</th>
                        <th>Город</th>
                        <th>Улица</th>
                        <th>Тип логистики</th>
                    </tr>
                    <?php
                        $q = 'SELECT * FROM orders';
                        $order = $mysql->query($q);

                        while($get = $order->fetch_assoc()) {
                            echo '<tr>';
                                echo '<td>';  echo '<input class="ids" type="num" name="id" value="', $get["id"] ,'">'; echo '</td>';
                                echo '<td>'; print_r($get["product"]); echo '</td>';
                                echo '<td>'; print_r($get["ind"]); echo '</td>';
                                echo '<td>'; print_r($get["city"]);  echo '</td>';
                                echo '<td>'; print_r($get["street"]);  echo '</td>';
                                echo '<td>'; print_r($get["log"]);  echo '</td>';
                                echo '<td>'; echo '<form action="" method="POST">';
                                echo '<button><a href="?delor=',$get["id"],'">Удалить</a></button>';                   
                                echo '</form>
                            </td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </main>
</body>
</html>