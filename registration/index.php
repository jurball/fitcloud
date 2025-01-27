<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Интернет магазин - FitCloud. Регистрация</title>
    <link rel="stylesheet" href="../styles/regis.css">
</head>
<body>
    <?php require_once("../api/api.php")?>
    <header class="header"> 
        <div class="header__block">
            <a href="/"><h1 class="header__logo"><span class="header__title">Fit</span>Cloud</h1></a>
        </div>
    </header>
    <main class="main">
        <div class="data">
            <div class="data__form">
                <form action="" class="data__get" method="POST">
                    <input type="text" class="data__name" placeholder="Имя" name="name">
                    <input type="text" class="data__last" placeholder="Фамилия" name="last">
                    <input type="tel" class="data__phone" placeholder="Телефон" name="tel">
                    <input type="email" class="data__mail" placeholder="e-mail" name="mail">
                    <input type="password" class="data__password" placeholder="Пароль" name="pass">
                    <button class="data__accept">Отправить</button>
                    <?php
                        if(empty($_POST["name"]) || empty($_POST["last"])|| empty($_POST["tel"]) || empty($_POST["mail"]) || empty($_POST["pass"])) {
                            printf("Не заполнено поля!");
                        } else {
                            printf("Заполнено");
                            $q = "INSERT INTO users (id, name, last, telep, email, pass) VALUES (NULL, '". $_POST["name"] ."', '".$_POST["last"]."', '".$_POST["tel"]."', '".$_POST["mail"]."', '".$_POST["pass"]."')";
                            if($mysql->query($q) === TRUE) {
                                echo "<br> Успешно";
                                $mysql->close();
                            } else {
                                printf("Промах");
                            }
                        }
                    ?>
                </form>
                
            </div>
        </div>
    </main>
</body>
</html>