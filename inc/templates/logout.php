<?php

/**
 * Выход
 *
 *
 *
 */
if (!defined('IN_FIN')) {
    die();
}

$users->logOut();
header('location: ?p=');
