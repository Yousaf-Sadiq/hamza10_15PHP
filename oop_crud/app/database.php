<?php

declare(strict_types=1);
namespace app\database;

// code optimization
require_once dirname(__FILE__) . "/trait/insert.php";
require_once dirname(__FILE__) . "/trait/checkTable.php";
require_once dirname(__FILE__) . "/trait/select.php";
require_once dirname(__FILE__) . "/trait/Mysql.php";
require_once dirname(__FILE__) . "/trait/getResult.php";

class Mysqli
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "oops_crud";
    protected $conn;
    private $result = [];
    private $query;

    private $exe;

    // private $status=[
    //     "success"=>0,
    //     "error"=>0,
    //     "success_msg"=>[],
    //     "error_msg"=>[],
    // ];

    function __destruct()
    {
        $this->conn->close();
    }
    // =======================================================
    function __construct()
    {
        $this->conn = new \mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->conn) {
            // echo "established";
        } else {
            echo $this->conn->connect_error;
        }
    }




    use \INSERT, \checkTable, \Select, \Mysql,\Result;





}


class helper extends Mysqli
{

    public function Filter_data(string $input)
    {
        $data = trim($input);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = $this->conn->real_escape_string($data);

        return $data;
    }
    public function pre($a)
    {
        echo "<pre>";
        print_r($a);
        echo "</pre>";
    }
}
?>