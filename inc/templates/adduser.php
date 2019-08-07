<?php
/**
 * Добавление пользователя
 *
 *
 *
 */
if (!defined('IN_FIN')) {
    die();
}

require 'templates/header.php';

if (isset($_POST['submit'])) {
    if ($users->addUser()) {
        echo 'Пользователь добавлен';
    } else {
        echo 'Ошибка! Что-то пошло не так!';
    }
    echo '<br /><a href="?p=">Назад</a>';
} else {
    ?>
    <form method="POST">
        Логин: <input type="text" name="login" value="" placeholder="Логин"><br />
        Пароль: <input type="password" name="password" value=""><br />
        Повтор пароля: <input type="password" name="repassword" value=""><br />
        <input type="submit" name="submit" value="Добавить">
    </form>
<?php }
?>