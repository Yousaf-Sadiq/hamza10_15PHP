<?php

declare(strict_types=1);
namespace app\database;

// code optimization
require_once dirname(__FILE__) . "/trait/insert.php";
require_once dirname(__FILE__) . "/trait/checkTable.php";
require_once dirname(__FILE__) . "/trait/select.php";
require_once dirname(__FILE__) . "/trait/Mysql.php";
require_once dirname(__FILE__) . "/trait/getResult.php";
require_once dirname(__FILE__) . "/trait/update.php";

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



    //   \ => global name space symbol 
    use \INSERT, \checkTable, \Select, \Mysql, \Result, \Update;





}


class helper extends Mysqli
{

    public function File_upload(string $input, array $ext, string $to)
    {

        $status = [
            "error" => 0,
            "msg" => []
        ];

        $file = $_FILES[$input];

        $file_name = $file["name"];
        $file_tmp_name = $file["tmp_name"];

        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); // PNG=> png

        if (!in_array($file_ext, $ext)) {
            $status["error"]++;
            $string = implode(" , ", $ext);
            $string = strtoupper($string);
            array_push($status["msg"], "{$string} ONLY ALLOWED");
        }


        if ($status["error"] > 0) {
            return json_encode($status);
        }
        
    }

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