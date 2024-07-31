<?php 

trait Deletes{

    public function deletes(string $table, string $where)
    {

        // DELETE  FROM `table_name` WHERE `id` = '20'




        $status = [
            "error" => 0,
            "msg" => []
        ];
        if ($this->CheckTable($table)) {


          

            $this->query = "DELETE FROM `{$table}` WHERE  $where";



            $this->exe = $this->conn->query($this->query);

            if ($this->exe) {

                if ($this->conn->affected_rows > 0) {

                    array_push($status["msg"], "DATA HAS BEEN DELETED");

                } else {

                    $status["error"]++;

                    array_push($status["msg"], "DATA HAS NOT BEEN DELETED");
                }

            } else {
                $status["error"]++;
                array_push($status["msg"], "ERROR IN QUERY {$this->query}");

            }

        } else {
            $status["error"]++;
            array_push($status["msg"], "TABLE DOES NOT EXIST");
        }

        return json_encode($status);
    }

}

?>