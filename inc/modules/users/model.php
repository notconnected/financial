<?php

/**
 * 
 * Модель модуля Users
 *
 *
 */
if (!defined('IN_FIN')) {
    die();
}

class users_model {

    private $dbh;

    public function __construct(PDO $dbh) {
        $this->dbh = $dbh;
    }

    public function addUser(string $login, string $password) : bool {
        $sth = $this->dbh->prepare('INSERT INTO `users` (`id` ,`login` ,`password`, `account`) VALUES (? , ?, ?, ?);');
        return $sth->execute(['NULL', $login, $password, 100]);
    }

    public function getUserByLogin(string $login) : array {
        $sth = $this->dbh->prepare('SELECT * FROM `users` WHERE `users`.`login` = ?;');
        $sth->execute([$login]);
        return $sth->fetch();
    }

    public function getUserByLoginWithLock(string $login) : array {
        $sth = $this->dbh->prepare('SELECT * FROM `users` WHERE `users`.`login` = ? FOR UPDATE;');
        $sth->execute([$login]);
        return $sth->fetch();
    }

    public function updateAccount(string $user_id, float $sum) : bool {
        $sth = $this->dbh->prepare('UPDATE `users` SET `account` = ? WHERE `users`.`id` = ?;');
        return $sth->execute([$sum, $user_id]);
    }

}
