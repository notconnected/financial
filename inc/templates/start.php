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
?>

<a href="?p=adduser">Добавить пользователя</a><br />

<?php
if ($_SESSION['user_session']['is_authorized']) {
    $user = $users->getUserData();
    ?>
    <h2>Личный кабинет</h2>
    Добро пожаловать, <?= $user['login']; ?>!<br />
    На Вашем счету: <?= $user['account']; ?> рублей.
    <br /><br /><br />
    <h3>Вывод средств</h3>
    Вывести
    <form method="POST" action="?p=withdraw">
        <input type="text" name="sum" value="" placeholder="Сумма">
        <input type="submit" name="submit" value="Вывести">
    </form>
    <br /><br /><br />
    <h3>Внести средства</h3>
    Внести
    <form method="POST" action="?p=deposit">
        <input type="text" name="sum" value="" placeholder="Сумма">
        <input type="submit" name="submit" value="Внести">
    </form>
    <br />
    <a href="?p=logout">Выход</a>
<?php } else { ?>
    <h2>Авторизация</h2>
    <form method="POST" action="?p=login">
        Логин: <input type="text" name="login" value="" placeholder="Логин"><br />
        Пароль: <input type="password" name="password" value=""><br />
        <input type="submit" name="submit" value="Отправить">
    </form>
<?php } ?>