<?php

/**
 * User Class to hadnle user login, register, redirect, check user login, check login name and email availability
 */


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "DbConnect.php";

class User extends DbConnect
{
    /**
     * @var string
     */
    private $table;

    /**
     * __construct create parent __construct
     * and set the table name
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = "users";
    }

    /**
     * function to handle user  login
     *
     * @param user login name $loginamea
     * @param user password $password
     * @return boolean (true||false)
     */
    public function loginUser($loginame, $password)
    {

        $conn = $this->getConnection();

        $params = [$loginame, md5($password)];

        $stmt = $conn->prepare("SELECT * FROM " . $this->table . " WHERE loginame = ? AND password= ?");
        $stmt->execute($params);
        $return_row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($return_row) && !empty($return_row)) {
            unset($return_row['password']);
            $_SESSION['user_session'] = $return_row;
            return true;
        } else {
            return false;
        }

        $stmt = null;
        //var_export($return_row);

    }

    /**
     * function to handle user registration
     *
     * @param arayr registration details $register
     * @return boolean false OR redirect user to login after successully user register
     */
    public function registerUser($register)
    {
        $password = md5($register['password']);
        $conn = $this->getConnection();

        $sql = "INSERT INTO " . $this->table . " (fullname, loginame, password, email) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $process = 0;
        if (!empty($register['loginame']) && !empty($password) && !empty($register['email'])) {
            try {
                $stmt->execute([$register['fullname'], $register['loginame'], $password, $register['email']]);
                $process = 1;
            } catch (Exception $e) {
                //throw $e;
                $process = 0;
            }
        }

        if ($process == 1) {
            $url = "\login.php?_success";
            $this->redirect($url);
        } else {
            return false;
        }
    }

    /**
     * function to handle user logged or not
     * @return boolean true
     */
    public function is_logged_in()
    {
        // Check if user session has been set
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }

    /**
     * function to handle redirection
     * @param  $url 
     * @return boolean true
     */
    public function redirect($url)
    {
        header("Location: $url");
    }

    /**
     * function to handle log out of user
     * destroy user login session
     */

    public function log_out()
    {
        // Destroy and unset active session
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }

    /**
     * function to handle user email and login name availability 
     * @param $loginame string  user login name OR user email 
     * @param $checkfield string as email or loginame
     * @return boolean 1 OR 0
     */
    public function checkAvailability($loginame, $checkfield)
    {
        $params = [$loginame];
        $conn = $this->getConnection();
        if ($checkfield == "loginname") {
            $stmt = $conn->prepare("SELECT * FROM users WHERE loginame = ?");
        } elseif ($checkfield == "email") {
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        }

        $stmt->execute($params);
        $return_row = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;

        if (isset($return_row) && !empty($return_row)) {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     * function to get the users listing
     * @return $result array user list
     */
    public function getUsers()
    {
        $conn = $this->getConnection();
        $sth = $conn->prepare("SELECT id,fullname,loginame,password,email,created_at FROM users");
        $sth->execute();
        /* Fetch all of the remaining rows in the result set */
        //print("Fetch all of the remaining rows in the result set:\n");
        try {
            $result = $sth->fetchAll();
        } catch (Exception $e) {
            $result = [];
        }
        return $result;
    }
}
