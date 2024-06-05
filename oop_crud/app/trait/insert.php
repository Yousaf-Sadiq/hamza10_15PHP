<?php 

trait INSERT{
    public function Myinsert(string $table, array $data, $emailCheck = false)
    {

        $status = [
            "error" => 0,
            "msg" => []
        ];

        // INSERT INTO `users`(`id`, `user_name`, `email`, `password`, `ptoken`, `address_id`, `role_id`) 
        // VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')


        if ($this->CheckTable($table)) {

            

            $col = "`" . implode("` , `", array_keys($data)) . "`";

            $values = "'" . implode("' , '", array_values($data)) . "'";
            

            $this->query = "INSERT INTO `{$table}` ({$col}) VALUES  ({$values})";

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


    
}

?>