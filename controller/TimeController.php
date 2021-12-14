<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include $domain . "/service/DB.php";

class TimeController
{
    private $connect;
    private $auth;

    public function __construct()
    {
        $db = new DBController;
        $this->connect = $db->connect();
        $this->auth = $_SESSION['auth'];
    }

    public function select_time($request)
    {
        $user_id = $this->auth['id'];
        $select_time = $request['select_time'];
        date_default_timezone_set('UTC');
        $date_start = date('Y-m-d H:i:s');
        switch ($select_time) {
            case "Select_0" :
                $count_time = 30;
                break;
            case "Select_1" :
                $count_time = 60;
                break;
            case "Select_2" :
                $count_time = 90;
                break;
            default :
                return [
                    'code' => 1,
                    'text' => "Error attribute select_time",
                ];
        }
//        echo (DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')))->modify("+$time minute")->format('Y-m-d H:i:s');


        $sql = "INSERT INTO `users_times` (`id`, `user_id`, `times_start`, `count_time`, `status`) VALUES (NULL, '$user_id', '$date_start', '$count_time', '2');";
        $result = mysqli_query($this->connect, $sql);
        if ($result) {
            return [
                'code' => 0,
                'text' => 'Success save',
            ];
        } else {
            return [
                'code' => 1,
                'text' => 'Error other save',
            ];
        }
    }
}
