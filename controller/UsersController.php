<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include $domain . "/service/DB.php";

class UsersController
{
    private $connect;

    public function __construct()
    {
        $db = new DBController;
        $this->connect = $db->connect();
    }

    public function register($request)
    {
        $first_name = $request['first_name'] ?? null;
        $last_name = $request['last_name'] ?? null;
        $login = $request['login'] ?? null;
        $password = $request['password'] ?? null;

        $re_password = $request['re_password'] ?? null;
        $weight = $request['weight'] ?? null;
        $height = $request['height'] ?? null;
        $date_birth = $request['date_birth'] ?? null;
        $floor = $request['floor'] ?? null;
        $error_message = [];
        //Проверки
        //--пароль
        if ($password != $re_password) {
            $error_message['password'][] = "Password mismatch. ";
        }
        if (strlen($password) < 8) {
            $error_message['password'][] = "Password min 8 characters. ";
        }
        if (strlen($password) > 36) {
            $error_message['password'][] = "Password max 36 characters. ";
        }
        //--login
        $login_sql = mysqli_query($this->connect, "SELECT * FROM `users` WHERE `login` = '$login'");
        if ($login_sql->num_rows > 0) {
            $error_message['login'][] = "This login already exists";
        }
        if (strlen($login) < 4) {
            $error_message['login'][] = "Login min 4 characters. ";
        }
        if (strlen($login) > 36) {
            $error_message['login'][] = "Login max 36 characters. ";
        }
        if (!count($error_message)) {
            $sql = "INSERT INTO `users` (`id`, `first_name`, `last_name`, `login`, `password`) VALUES (NULL, '$first_name', '$last_name', '$login', '$password')";
            $sql_query = mysqli_query($this->connect, $sql);
            if ($sql_query > 0)
                return [
                    'code' => 0,
                    'text' => 'Saved successfully',
                ];
            else
                return [
                    'code' => 1,
                    'text' => 'Save error',
                    'error_message' => ['other_error' => ["Неизвестная ошибка"]]
                ];
        } else
            return [
                'code' => 1,
                'text' => 'Save error',
                'error_message' => $error_message
            ];
    }

    public function auth($request)
    {
        $login = $request['login'];
        $password = $request['password'];

        $login_sql = mysqli_query($this->connect, "SELECT * FROM `users` WHERE `login` = '$login'");

        if ($login_sql->num_rows <= 0) {
            return [
                'code' => 1,
                'text' => 'Login is not defined',
            ];
        } else {
            $users_query = $login_sql->fetch_array();
            if ($users_query['password'] === $password) {
                $_SESSION['auth'] = [
                    'id' => $users_query['id'],
                    'login' => $login,
                    'password' => $password
                ];
                return [
                    'code' => 0,
                    'text' => 'Success authorization',
                ];
            } else {
                return [
                    'code' => 1,
                    'text' => 'password in not defined',
                ];
            }
        }
    }
    public function logout(){
        if (!isset($_SESSION['auth'])){
            unset($_SESSION['auth']);
            return [
                'code' => 1,
                'text' => 'You not authorization',
            ];
        }else{
            unset($_SESSION['auth']);

            return [
                'code' => 0,
                'text' => 'You logout in account',
            ];
        }

    }
}



