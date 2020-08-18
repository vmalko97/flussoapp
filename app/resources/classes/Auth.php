<?php


class Auth
{
    public $user;
    public $username;
    public $auth_hash;
    public $exist;
    public $password;

    public function __construct(string $username, string $password)
    {
//        global $mysqli;
//        global $datetime_expire;
        $this->username = $username;
        $this->password = $password;
//        $this->user = $mysqli->query('SELECT * FROM WF_USERS WHERE username ="' . $username . '" AND password = "' . $password . '"')->fetch_object();
//        $this->auth_hash = md5($this->user->username . $datetime_expire);
//        $_SESSION['auth_hash'] = $this->auth_hash;
//        $mysqli->query("REPLACE INTO WF_LOGGED_IN (ID_USER, AUTH_HASH, EXPIRE) VALUES ('" . $this->user->id . "','" . $this->auth_hash . "','" . $datetime_expire . "')");
    }

    public function authorize()
    {
        global $mysqli;
        global $datetime_expire;
        $this->user = $mysqli->query('SELECT * FROM wf_users WHERE username ="' . $this->username . '" AND password = "' . md5($this->password) . '"')->fetch_object();
        $this->auth_hash = md5($this->user->username);
        $_SESSION['uid'] = $this->user->id;
        $_SESSION['auth_hash'] = $this->auth_hash;
        $mysqli->query("REPLACE INTO wf_logged_in (ID_USER, AUTH_HASH, EXPIRE) VALUES ('" . $this->user->id . "','" . $this->auth_hash . "','" . $datetime_expire . "')");
    }

    public function isExist()
    {
        global $mysqli;
        $this->exist = $mysqli->query('SELECT * FROM wf_users WHERE username ="' . $this->username . '" AND password = "' . md5($this->password) . '"')->num_rows;
        return $this->exist;
    }

    static function destroySession($auth_hash)
    {
        global $mysqli;
        $mysqli->query('DELETE FROM wf_logged_in WHERE auth_hash = "' . $auth_hash . '"');
        session_destroy();
    }

}