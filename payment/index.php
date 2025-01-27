<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=401, initial-scale=1.0">
    <title>Интернет магазин - FitCloud</title>
    <link rel="stylesheet" href="../styles/regis.css">
</head>
<body>
    <?php require_once("../api/api.php")?>
    <header class="header">
        <div class="header__block">
            <a href="/"><h1 class="header__logo"><span class="header__title">Fit</span>Cloud Payment</h1></a>
        </div>
    </header>
    <main class="main">
        <div class="data">
            <div class="data__form">
                <form action="" class="data__get" method="POST">
                    <?php
                    $q = 'SELECT * FROM store'; //вывести все товары
                    $product = $mysql->query($q);

                    echo "Товар: ";
                    if(isset($_GET["storeid"])) {
                        $name_store = $_GET["storeid"];
                        print_r($name_store); echo '<br><br>';
                    } else if (empty($_GET["storeid"])) {
                        echo 'На складе ничего нету';
                    }
                    
                    $i = 0;
                    while($get = $product->fetch_assoc()) {
                        if($get["quantity"] > 0) {
                            $i++;
                        }
                    }
                    ?>
                    <input type="text" class="data__password" placeholder="Почтовый индекс" name="index">
                    <input type="text" class="data__password" placeholder="Город" name="city">
                    <input type="text" class="data__password" placeholder="Улица" name="street">
                    <p>Тип логистики</p>
                    <select name="pochta" id="" class="data__select-prod">
                        <option value="ПочтаРоссии">Почта России</option>
                        <option value="Другое">Другое</option>
                    </select>
                    <button class="data__accept" name="accept" type="submit">Заказать</button>
                    <?php
                        if(isset($_POST["accept"])) {
                            if(empty($_POST['index']) || empty($_POST['city']) ||
                                empty($_POST['street'])) {
                                print_r("Заполните поля!");
                            } else {
                                if(is_numeric($_POST["index"])) {
                                    $q = "INSERT INTO orders(id, product, ind, city, street, log) VALUES 
                                    (NULL, '".$_GET["storeid"]."', '".$_POST["index"]."', '".$_POST["city"]."', '".$_POST["street"]."', '".$_POST["pochta"]."')";
                                    if(empty($_GET["storeid"])) {
                                        print_r("Такого продукта нету на складе");
                                    } else {
                                        if($mysql->query($q)) {
                                            print_r("Отправленно! Ожидайте курьера");
                                        } else {
                                            print("Промах");
                                        }
                                    }
                                } else {
                                    echo 'Неверно указан индекс! Индекс оформляется только в цифрах<br>';
                                    echo 'Например: 333333';
                                }
                            }
                        }
                        
                        $mysql->close();
                    ?>
                </form>
            </div>
        </div>
    </main>
</body>
</html>