<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include $domain . "/service/DB.php";

class UsersChildController
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

    public function card_event($request)
    {
        $card_id = $request['card_id'];
        $user_id = $this->auth['id'];
        $type = $request['type'];
        if (!is_numeric($request['card_id'])) {
            return [
                'code' => 1,
                'text' => "ErrorSave: card_id is not number --" . $request['card_id'],
                'data_users' => "",
            ];
        }
        switch ($request['type']) {
            case 0:
                $sql = "DELETE FROM `users_child` WHERE `users_child`.`id` = $card_id";
                break;
            case 1:
                $sql = "DELETE FROM `users_child` WHERE `users_child`.`id` = $card_id";
                break;
            default :
                return [
                    'code' => 1,
                    'text' => 'ErrorSave: type is not define',
                    'data_users' => '',
                ];
        }
        $query = mysqli_query($this->connect, $sql);
        return [
            'code' => 0,
            'text' => 'Saved successfully',
            'data_users' => $request['card_id'],
        ];


    }

    public function add_child($request)
    {
        $name = $request['name'];
        $user_id = $this->auth['id'];
        $sql_insert = "INSERT INTO `users_child` (`id`, `parent_id`, `name`, `status`, `avatar`) VALUES (NULL, '$user_id', '$name', '0', NULL)";
        $query = mysqli_query($this->connect, $sql_insert);
        return [
            'code' => 0,
            'text' => 'Saved successfully',
            'data_users' => $query,
        ];
    }

    public function get_child_list()
    {
        $user_id = $this->auth['id'];
        $sql_get = "SELECT * FROM `users_child` WHERE `parent_id` = $user_id";
        $query = mysqli_query($this->connect, $sql_get);
        $dta_users = [];
        foreach ($query as $item) {
            $dta_users[] = $item;
        }
        return [
            'code' => 0,
            'text' => 'Saved successfully',
            'data_users' => $dta_users,
        ];
    }

    public function select_group($request)
    {
        $user_id = $this->auth['id'];
        $group_id = $request['group_id'];
        $sql = "INSERT INTO `users_group` (`id`, `user_id`, `group_id`) VALUES (NULL, '$user_id', '$group_id')";
        $query = mysqli_query($this->connect, $sql);
        return [
            'code' => 0,
            'text' => 'Saved successfully',
        ];
    }

    public function add_groups($request)
    {
        $code = 'FF231523';
        do {
            echo 1;
            $sql_get_code = "SELECT * FROM `groups` WHERE `code` LIKE '$code'";
            $code = $this->create_code();

        } while (mysqli_query($this->connect, $sql_get_code)->num_rows > 0);

        $sql = "INSERT INTO `groups` (`id`, `code`, `status`) VALUES (NULL, '$code', '0')";
        mysqli_query($this->connect, $sql);
        return [
            'code' => 0,
            'text' => 'Saved successfully',
        ];
    }

    public function get_groups_users($status)
    {
        switch ($status) {
            case 0 :
                $sql_get = "SELECT * FROM `groups` WHERE `status` = 0";
                break;
            case 1 :
                $sql_get = "SELECT * FROM `groups` WHERE `status` = 1";
                break;
            case 2 :
                $sql_get = "SELECT * FROM `groups` WHERE `status` = 2";
                break;
            case 3 :
                $sql_get = "SELECT * FROM `groups`";
                break;
        }
        $data_group = [];
        foreach (mysqli_query($this->connect, $sql_get) as $item) {
            $data_group[] = $item;
        }
        return [
            'code' => 0,
            'text' => 'Saved successfully',
            'data' => [
                'users_group' => $data_group,
            ]
        ];


    }

    private function create_code()
    {
        $arr_code = ['Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', 'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Z', 'X', 'C', 'V', 'B', 'N', 'M', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $code = '';
        while (iconv_strlen($code) < 6) {
            $code .= $arr_code[rand(0, 35)];
        }
        return $code;
    }
}