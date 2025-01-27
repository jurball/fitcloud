<?php
header("Access-Control-Allow-Origin: *");

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=724, initial-scale=1.0">
    <title>...</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php require_once("api/api.php")?>
    <header class="header">
        <div class="header__root">
            <div class="header__block">
                <h1 class="header__h"><a class="header__link" href="/"><span class="header__style">Fit</span>Cloud</a></h1>
                <div class="header__list">
                    <ul class="header__ul">
                        <li class="header__li"><a class="link" href="/#aboutlink">О нас</a></li>
                        <li class="header__li"><a class="link" href="/#idcatalog">Каталог</a></li>
                        <li class="header__li"><a class="link" href="/#contactlink">Контакты</a></li>
                        <li class="header__li"><a class="link" href="/admin">Админка</a></li>
                        <li class="header__li"><a class="link" href="/registration">Регистрация</a></li>
                        <li class="header__li"><a class="link" href="/openserver/phpmyadmin/index.php">PhpMyAdmin</a></li>
                        <li class="header__li"><a class="link" href="/payment?storeid=Очки">Купить очки</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
   
    <main class="main">
        <div class="super">
            <div class="super__root">
                <div class="super__block">
                    <h1 class="super__h title">Спортивный магазин</h1>
                    <div class="super__text border-dash">
                        Мы собрали самые качественные товары нашего производства! Ниже Вы можете выбрать свой первый товар
                    </div>
                    <div class="super__button">
                        <a href="#idcatalog"><button class="super__accept">Go Каталог</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="about" id="aboutlink">
            <div class="about__back">
                <div class="about__root">
                    <h2 class="about__h title border-line">О нас</h2>
                    <div class="about__blocks">
                        <div class="about__block">
                            <h2 class="about__h2 border-line">1. Кто мы?</h2>
                            <div class="about__text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eveniet asperiores laborum ad tempore tempora necessitatibus cum maiores quod quo accusamus illo, rem ex culpa, quas qui distinctio, modi facilis.
                            </div>
                        </div>
                        <div class="about__block">
                            <h2 class="about__h2 border-line">2. Почему у нас</h2>
                            <div class="about__text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eveniet asperiores laborum ad tempore tempora necessitatibus cum maiores quod quo accusamus illo, rem ex culpa, quas qui distinctio, modi facilis.
                            </div>
                        </div>
                        <div class="about__block">
                            <h2 class="about__h2 border-line">3. Только для спорсменов</h2>
                            <div class="about__text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eveniet asperiores laborum ad tempore tempora necessitatibus cum maiores quod quo accusamus illo, rem ex culpa, quas qui distinctio, modi facilis.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" id="idcatalog">
            <h1 class="card__h title">Каталог</h1>
            <div class="card__root">
                <?php
                $q = 'SELECT * FROM store'; //вывести все товары
                $product = $mysql->query($q);
                
                while($get = $product->fetch_assoc()) {
                    if($get["quantity"] > 0) {
                        $show_img = base64_encode($get["img"]);

                    echo '<div class="card__block">
                        <div class="card__img"><img src="data:image/jpeg;base64, ', $show_img ,'" alt=""></div>
                        <div class="card__root-desc">
                            <div class="card__desc">
                            <div class="card__name">';

                            print_r($get['product']);
                            echo '</div>';

                    echo '<div class="card__text">';
                    printf($get["description"]);
                    echo '</div>
                    </div>';

                    echo '<div class="card__buy">
                    <div class="card__price">';

                    print_r($get['price']); echo '$';
                    echo '</div>';

                    echo '<div class="card__button">';
                    echo '<a href="/payment?storeid='.$get["product"].'"><button class="card__accept">Купить</button></a>';
                    echo '</div>';
                    echo '</div>
                    </div>
                    </div>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="contact" id="contactlink">
            <div class="contact__root">
                <h2 class="contact__h2">Свяжитесь с нами если есть вопросы!</h2>
                <div class="contact__admin">
                    <div class="contact__form">
                        <form action="" class="contact__send" method="POST">
                            <input type="text" placeholder="Имя" class="contact__name" name="name">
                            <input type="tel" placeholder="Номер телефона" class="contact__num" name="tel">
                            <input type="email" placeholder="Почта" class="contact__mail" name="mail">
                            <textarea  placeholder="Введите сообщение" class="contact__textarea" id="" cols="" rows="" name="text"></textarea>
                            
                            <?php
                            if(isset($_POST["accept"])) {
                                if(!empty($_POST['name']) || !empty($_POST['tel']) || !empty($_POST['mail']) ||
                                !empty($_POST['text'])) {
                                    $q = "INSERT INTO support (id, name, tele, mail, message) VALUES (NULL, '".$_POST['name']."', 
                                    '".$_POST['tel']."', '".$_POST['mail']."', '".$_POST['text']."')";
                                    if($mysql->query($q)) {
                                        print_r("Отправлено! Ожидайте ответа по email или по телефону");
                                    } else {
                                        print("Промах");
                                    }
                                    
                                } else {
                                    print_r("Заполните поля!");
                                }
                            }
                            ?>
                            <button class="contact__accept" name="accept" type="submit">Отправить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer__block">
            <ul class="footer__social">
                <li class="footer__get"><a class="link" href="#">VK</a></li>
                <li class="footer__get"><a class="link" href="#">YT</a></li>
                <li class="footer__get"><a class="link" href="#">TG</a></li>
            </ul>
            <div class="footer__phone">
                <div class="link">+ 7 999 777 00 11</div>
                <div class="header__a-low link">+ 7 999 777 00 11</div> 
            </div>
        </div>
    </footer>
</body>
</html> 