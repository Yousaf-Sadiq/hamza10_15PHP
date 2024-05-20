<?php

declare(strict_types=1);
namespace app\database;

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


    public function Myinsert(string $table, array $data)
    {

        $status = [
            "error" => 0,
            "msg" => []
        ];

        // INSERT INTO `users`(`id`, `user_name`, `email`, `password`, `ptoken`, `address_id`, `role_id`) 
        // VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')


        if ($this->CheckTable($table)) {

            $this->query = "INSERT INTO `{$table}` ";

            $keys = "`" . implode("` , `", array_keys($data)) . "`";

            $values = "'" . implode("' , '", array_values($data)) . "'";

            $this->query .= " ({$keys}) VALUES  ({$values})";

            $this->exe = $this->conn->query($this->query);


            if ($this->exe) {

                if ($this->conn->affected_rows > 0) {

                    array_push($status["msg"], "DATA HAS BEEN INSERTED");

                } else {

                    $status["error"]++;

                    array_push($status["msg"], "DATA HAS NOT BEEN INSERTED {$this->query}");
                }

            } else {
                $status["error"]++;
                array_push($status["msg"], "ERROR IN QUERY {$this->query}");

            }

        } else {

            $status["error"]++;
            array_push($status["msg"], "TABLE `{$table}` IS NOT EXISTED");

        }



        return json_encode($status);

    }


    private function CheckTable(string $table)
    {
        $this->query = "SELECT * 
        FROM information_schema.tables
        WHERE table_schema = '{$this->db}' 
            AND table_name = '{$table}'
        LIMIT 1;";
        $this->exe = $this->conn->query($this->query);

        if ($this->exe->num_rows > 0) {
            return true;
        } else {
            return false;
        }

    }




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
}
?>