<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include $domain . "/service/DB.php";

class DefaultController
{
    public $connect;
    public $auth;

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

    public function selectBD($from, $where = [], $order = ""): array
    {
        $sql_where = $this->whereCompressor($where);
        $sql = "SELECT * FROM `$from` $sql_where ORDER BY `id` ASC";
        return $this->resultCompressor($sql);
    }

    public function updateBD($from, $set, $where, $order = ""): array
    {
        if (!$where) {
            return [
                'code' => 1,
                'text' => "Where is not defined",
            ];
        }
        if (!$set) {
            return [
                'code' => 1,
                'text' => "Set is not defined",
            ];
        }
        $set_sql = $this->setCompressor($set);
        $sql_where = $this->whereCompressor($where);

        $sql = "UPDATE `$from` SET $set_sql $sql_where";
        return [
            'code' => 0,
            'text' => "Successful update",
            'count_update' => mysqli_query($this->connect, $sql)
        ];
    }

    public function leftJoinBD($from, $join_where, $on, $select = "*", $where = []): array
    {
        $sql_where = $this->whereCompressor($where);
        $sql = "SELECT $select FROM $from LEFT JOIN $join_where ON $on";
        return $this->resultCompressor($sql);
    }

    public function normalSQLBD($sql_normal): array
    {
        return $this->resultCompressor($sql_normal);
    }

    private function resultCompressor($sql): array
    {
        $data = [];
        if ($query = mysqli_query($this->connect, $sql)) {
            foreach ($query as $item) {
                $data[] = $item;
            }
        }

        return $data;
    }

    private function whereCompressor($where): string
    {
        $sql_where = '';
        foreach ($where as $key => $item) {
            if ($key == 0) {
                $sql_where .= " WHERE ";
            } else {
                $sql_where .= " AND ";
            }
            if (count($item) == 2) {
                $sql_where .= "`$item[0]` = '$item[1]'";
            } else {
                $sql_where .= "`$item[0]` $item[1] '$item[2]'";
            }
        }
        return $sql_where;
    }

    private function setCompressor($where): string
    {
        $sql_where = '';
        foreach ($where as $key => $item) {
            if ($key == 0) {
                $sql_where .= " ";
            } else {
                $sql_where .= ", ";
            }
            if (count($item) == 2) {
                $sql_where .= "`$item[0]` = '$item[1]'";
            } else {
                $sql_where .= "`$item[0]` $item[1] '$item[2]'";
            }
            $sql_where .= " ";
        }
        return $sql_where;
    }
}
