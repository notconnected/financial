<?php

/**
 * Внесение
 *
 *
 *
 */
if (!defined('IN_FIN')) {
    die();
}

if (isset($_POST['submit'])) {
    if ($users->deposit()) {
        header('location: ?p=');
    } else {
        require 'templates/header.php';
        echo 'Ошибка! Неверно введена сумма!<br /><a href="?p=">Назад</a>';
    }
}