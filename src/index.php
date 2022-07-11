<?php

/**
 * Точка входа
 *
 *
 *
 */

declare(strict_types = 1);

define('IN_FIN', true);
session_start();

require_once '../inc/config.php';

if (isset($_GET['p'])) {
    $p = strtolower($_GET['p']);
} else {
    $p = '';
}

$user_session = & $_SESSION['user_session'];

switch ($p) {
    case 'adduser':
        require_once 'modules/users/controller.php'; //подключение 
        $users = new users($dbh);
        require 'templates/adduser.php';
        break;
    case 'login':
        require_once 'modules/users/controller.php'; //подключение 
        $users = new users($dbh);
        require 'templates/login.php';
        break;
    case 'deposit':
        require_once 'modules/users/controller.php'; //подключение 
        $users = new users($dbh);
        require 'templates/deposit.php';
        break;
        break;
    case 'withdraw':
        require_once 'modules/users/controller.php'; //подключение 
        $users = new users($dbh);
        require 'templates/withdraw.php';
        break;
    case 'logout':
        require_once 'modules/users/controller.php'; //подключение 
        $users = new users($dbh);
        require 'templates/logout.php';
        break;
    default: //показать информацию о счете
        require_once 'modules/users/controller.php'; //подключение 
        $users = new users($dbh);
        require 'templates/start.php';
        break;
}

require 'templates/footer.php';
