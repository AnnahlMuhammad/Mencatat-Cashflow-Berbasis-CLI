<?php 
namespace Config{

    use PDO;

    class Database{
        static public function getConnection():PDO{
            $servername = "localhost";
            $port = 3306;
            $username = "root";
            $password = "annahl88";
            $dbname = "php_financial_planner";

            return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        }
    }

}



?>