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
        if (!isset($_SESSION['auth'])) {
            exit(json_encode([
                'code' => 503,
                'text' => 'You not authorization',
            ]));
        }
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
        $sql = "INSERT INTO `users_times` (`id`, `user_id`, `times_start`, `count_time`, `status`,`created_at`, `closed_at`) VALUES (NULL, '$user_id', NULL , '$count_time', '2', '$date_start', NULL);";
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

    public function get_time()
    {
        $sql = "SELECT * FROM `users_times` WHERE `user_id` = '" . $this->auth['id'] . "' AND `status` = 0";
        $sql_result = mysqli_query($this->connect, $sql);
        if ($sql_result->num_rows > 0) {
            $data = mysqli_fetch_array($sql_result);
            $test = date("Y-m-d H:i:s", strtotime($data['times_start']));

            $now = new DateTime();
            $date = DateTime::createFromFormat("Y-m-d H:i:s", $test);
            $interval = $now->diff($date);

            $day = $interval->d;
            $hours = $interval->h;
            $minutes = $interval->i;
            $seconds = $interval->s;
            $fool_time = ($day * 3600 * 24) + $hours * 3600 + $minutes * 60 + $seconds;
            if ($date < $now) {
                $fool_time *= -1;
            }
            return [
                'code' => 0,
                'text' => 'Successful save',
                'data' => [
                    'time_start' => $data['times_start'],
                    'count_time' => $data['count_time'],
                    'fool_second' => $fool_time,
                ]
            ];
        } else {
            return [
                'code' => 1,
                'text' => 'Error other save',
            ];
        }
    }
}
