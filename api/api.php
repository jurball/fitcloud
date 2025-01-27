<style>
.db__error {
    background-color: rgb(220, 84, 84);
    padding: 20px;
    border-radius: 6px;
    width: 200px;
    position: fixed;
}
</style>
<?php
    $servername = 'localhost:3310'; // Конфиг
    $username = 'root'; $password = '1234';
    /*

        ** store ** = таблица с товарами
        ** orders ** = таблица с заказами
        ** users ** = таблица с пользователями
        ** support ** = таблица для связи с клиентами

    */
    $create_sheema = "CREATE SCHEMA IF NOT EXISTS sportmi;";

    $create_orders = "CREATE TABLE IF NOT EXISTS orders (
                    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    `product` VARCHAR(50) NOT NULL,
                    `ind` INT NOT NULL,
                    `city` VARCHAR(50) NOT NULL,
                    `street` VARCHAR(100) NOT NULL,
                    `log` VARCHAR(100) NOT NULL,
                    PRIMARY KEY (`id`))
                    ENGINE = InnoDB;";
    $create_store = "CREATE TABLE IF NOT EXISTS store (
                    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    `product` VARCHAR(22) NOT NULL,
                    `price` INT NOT NULL,
                    `description` VARCHAR(2000) NOT NULL,
                    `quantity` INT NOT NULL,
                    `img` LONGBLOB,
                    PRIMARY KEY (`id`),
                    UNIQUE INDEX `product` (`product` ASC) VISIBLE)
                    ENGINE = InnoDB;";
    $create_users = "CREATE TABLE IF NOT EXISTS support (
                    `id` INT NOT NULL AUTO_INCREMENT,
                    `name` VARCHAR(24) NOT NULL,
                    `tele` VARCHAR(22) NOT NULL,
                    `mail` VARCHAR(70) NOT NULL,
                    `message` VARCHAR(5000) NOT NULL,
                    PRIMARY KEY (`id`))
                    ENGINE = InnoDB;";
    $create_support = "CREATE TABLE IF NOT EXISTS users (
                    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    `name` VARCHAR(22) NOT NULL,
                    `last` VARCHAR(22) NOT NULL,
                    `telep` VARCHAR(19) NOT NULL,
                    `email` VARCHAR(70) NOT NULL,
                    `pass` VARCHAR(32) NOT NULL,
                    PRIMARY KEY (`id`),
                    UNIQUE INDEX `telep` (`telep` ASC) VISIBLE,
                    UNIQUE INDEX `email` (`email` ASC) VISIBLE)
                    ENGINE = InnoDB;";

    try {
        //code...
        $mysql = new mysqli($servername, $username, $password); 
    } catch (Exception $th) {
        //throw $th;
        echo '<div style="display:flex; justify-content: center; align-items: center; height: 100vh;">
                <div><h1>БАЗА ДАННЫХ УТЕРЕНА!!! ;$%@@#23!@3</h1></div>
              </div>';
        exit;
    }
    
    $mysql->query($create_sheema);
    $mysql->close();

    $dbname = 'sportmi';
    $mysql = new mysqli($servername, $username, $password, $dbname); 

    $mysql->query($create_orders); // 1
    $mysql->query($create_store); // 2
    $mysql->query($create_users); // 3
    $mysql->query($create_support); // 4


    if($mysql->connect_error) { // Проверка на подключения
        echo '<div class="db__error">
                <p>Number error:' . $mysql->connect_errno . '</p>
                <p>Error:' . $mysql->connect_error . ' </p>
                <p>Ошибка</p>
            </div>';
    }

    //$mysql->close(); не закрываем
?>