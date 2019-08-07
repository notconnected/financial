<?php

/**
 * Все объединено в один модуль, но на реальном проекте операции по счету лучше вынести в отдельный
 * В данном случае для упрощения не использованы пространства имен, но при разбиении класса на логические модули для них лучше использовать
 *
 *
 */
if (!defined('IN_FIN')) {
    die();
}

require_once 'model.php';

class users {

    private $user_session, $model, $dbh;

    public function __construct(PDO $dbh) {
        $this->dbh = $dbh;
        $this->model = new users_model($dbh);
        $this->user_session = & $_SESSION['user_session'];
    }

    public function addUser() : bool {
        if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['repassword'])) {
            if (strlen($_POST['login']) > 2 && strlen($_POST['password']) > 2) {
                if ($_POST['password'] == $_POST['repassword']) {
                    return $this->model->addUser(htmlspecialchars(trim($_POST['login'])), trim(md5($_POST['password']))); //без соли для простоты
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function login() : bool {
        if (strlen($_POST['login']) > 0 && strlen($_POST['password']) > 0) {
            $user = $this->model->getUserByLogin(htmlspecialchars(trim($_POST['login'])));
            if (!isset($user['login'])) {
                return false;
            }
            if (md5($_POST['password']) == $user['password']) { //упрощенная проверка
                session_regenerate_id();
                $this->user_session['is_authorized'] = 1;
                $this->user_session['user']['id'] = $user['id'];
                $this->user_session['user']['login'] = $user['login'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function logOut() : void {
        $this->user_session['is_authorized'] = 0;
        session_regenerate_id();
        session_write_close();
        return;
    }

    public function getUserData() : array {
        $user = $this->model->getUserByLogin($this->user_session['user']['login']);
        if (isset($user['login'])) {
            return $user;
        } else {
            return false;
        }
    }

    public function withDraw() : bool {
        if (is_numeric($_POST['sum'])) {
            $this->dbh->beginTransaction();
            $user = $this->model->getUserByLoginWithLock($this->user_session['user']['login']);
            if (isset($user['login'])) {
                if ($_POST['sum'] <= $user['account']) {
                    //выводим
                    $sum = $user['account'] - $_POST['sum'];
                    $this->model->updateAccount($user['id'], $sum);
                    $this->dbh->commit();
                    return true;
                } else {
                    $this->dbh->rollBack();
                    return false;
                }
            } else {
                $this->dbh->rollBack();
                return false;
            }
        } else {
            return false;
        }
    }

    public function deposit() : bool {
        if (is_numeric($_POST['sum'])) {
            $user = $this->model->getUserByLogin($this->user_session['user']['login']);
            if (isset($user['login'])) {
                $sum = $user['account'] + $_POST['sum'];
                $this->model->updateAccount($user['id'], $sum);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
