<?php
class DBController{
    public function connect(){
        $connect_localhost = 'localhost';
        if ($_SERVER["SERVER_NAME"] == $connect_localhost || $_SERVER["SERVER_NAME"] == "www.playpoint.com") {
            $connect_name = 'root';
            $connect_password = "";
            $connect_db_name = "playpoint";
        } else {
            $connect_name = 'id17346577_playpoint';
            $connect_password = '$QSQBX}_[1D$Ug?$';
            $connect_db_name = "id17346577_play_point";
        }
        return mysqli_connect($connect_localhost, $connect_name, $connect_password, $connect_db_name);


    }
}

