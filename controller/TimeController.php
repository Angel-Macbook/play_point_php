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
                $count_time = 999;
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
//    private function get_foll_second(){
//        TimeSecond = TimeFoolSecond;
//        TimeHours = Mathf.Floor(TimeSecond / 3600);
//        TimeSecond -= TimeHours * 3600;
//        TimeMinute = Mathf.Floor(TimeSecond / 60);
//        TimeSecond -= TimeMinute * 60;
//    }
    function seconds($time)
    {
        $time = $time->format("Y-m-d H:i:s");
        $time = strtotime($time);
        if ($time != -1)
            return $time - strtotime('00:00');
        else
            return false;
    }

    private function get_foll_second($data)
    {

//        print_r($data.date("m"));

        $day = $date_start = date('d', strtotime($data));
        $hours = $date_start = date('H', strtotime($data));
        $minutes = $date_start = date('i', strtotime($data));
        $seconds = $date_start = date('s', strtotime($data));
        return (($day * 3600 * 24) + (($hours * 3600) - 0) + $minutes * 60 + $seconds);
//
    }

    public function get_time()
    {
        $sql = "SELECT * FROM `users_times` WHERE `user_id` = '" . $this->auth['id'] . "' AND `status` = 0 ORDER BY `users_times`.`id` DESC";
        $sql_result = mysqli_query($this->connect, $sql);
        if ($sql_result->num_rows > 0) {
            $data = mysqli_fetch_array($sql_result);
            $test = date("Y-m-d H:i:s", strtotime($data['times_start']));
            define('TIMEZONE', 'Europe/London');
            date_default_timezone_set(TIMEZONE);

            $now = new DateTime();
            $date = DateTime::createFromFormat("Y-m-d H:i:s", $test);


            $x = $this->seconds($now);
            $y = $this->seconds($date);
            $z = $data['count_time'] * 60;


            if ($data['count_time'] !== "999") {
                $ananas = $z - ($x - $y);
            } else {
                $ananas = 86400 - $x;
            }


            $interval = $date->diff($now);

            $day = $interval->d;
            $hours = $interval->h;
            $minutes = $interval->i;
            $seconds = $interval->s;


            if ($date > $now) {
                $ananas *= -1;
            }
            return [
                'code' => 0,
                'text' => 'Successful save',
                'data' => [
                    'id' => $data['id'],
                    'time_start' => $data['times_start'],
                    'count_time' => $data['count_time'],
                    'fool_second' => $ananas,
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
