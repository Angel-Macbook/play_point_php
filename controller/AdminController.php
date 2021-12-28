<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
include $domain . "/controller/DefaultController.php";

class AdminController extends DefaultController
{

    public function __construct()
    {
        parent::__construct(); // Унаследование конструктора родителя
    }

    public function confirmTransaction($request): array
    {
        $status = null;
        $data_sql = [];
        date_default_timezone_set('UTC');
        $date_start = date('Y-m-d H:i:s');
        switch ($request['status']) {
            case 0:
                $data_sql[] = ["times_start", $date_start];
                $status = 0;
                break;
            case 1:
                $status = 1;
                break;
            case 3:
                $status = 3;
                break;
            default :
                return [
                    'code' => 1,
                    'text' => 'Status undefined',
                ];
        }
        $data_sql[] = ['status', $status];
        $update_price = $this->updateBD(
            'users_times',
            $data_sql, [
                ['id', $request['id']]
            ]
        );
        return [
            'code' => 0,
            'text' => 'Success save',
        ];
    }

    public function getTransactionList($status): array
    {
        $sql_get_transaction = "SELECT users_times.*, users.first_name, users.last_name ,COUNT(users_child.id) as count_children FROM users_times left JOIN users ON users_times.user_id = users.id left JOIN users_child ON users_times.user_id = users_child.parent_id WHERE users_times.status = $status GROUP BY users_times.id;";
        $data = $this->normalSQLBD($sql_get_transaction);
        $result_price_list = $this->getPriceList();
        return [
            'code' => 1,
            'text' => 'Error other save',
            'data' => $data,
            'price_list' => $result_price_list,
        ];
    }

    private function getPriceList()
    {

        $data = [];
        $get_price = $this->selectBD(
            'service',
            [
                ['group_name', "price_list"]
            ]);
        foreach ($get_price as $item) {
            $data[$item['name']] = $item['value'];
        }
        return $data;
    }
}
