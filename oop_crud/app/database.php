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


        // INSERT INTO `users`(`id`, `user_name`, `email`, `password`, `ptoken`, `address_id`, `role_id`) 
        // VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')


        if ($this->CheckTable($table)) {

            $this->query = "INSERT INTO `{$table}`";

            $keys = "`" . implode("` , `", array_keys($data)) . "`";
            $values = "'" . implode("' , '", array_values($data)) . "'";

            $this->query .= " ({$keys}) VALUES  ({$values})";

        } else {

        }
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

?>