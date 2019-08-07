<?php

/**
 * Конфигурационные файл
 *
 *
 *
 */
if (!defined('IN_FIN')) {
    die();
}

ini_set("include_path", "../inc/"); //подключение модуля по шаблону: require 'users.php'

$dsn = 'mysql:dbname=financial;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}