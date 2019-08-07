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

if (($_SESSION['user_session']['is_authorized'] != 1)) {
    if ($users->login()) {
        header('location: ?p=');
    } else {
        require 'templates/header.php';
        echo 'Ошибка! Неверно введен логин или пароль!<br /><a href="?p=">Назад</a>';
    }
}