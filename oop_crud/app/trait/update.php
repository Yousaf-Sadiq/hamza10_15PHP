<?php

trait Update
{

    public function update(string $table, array $data, string $where)
    {

        // UPDATE `table_name` SET `col_name1`='val',`col_name2`='val' WHERE 
        // id = 20

        /**
         * [
         * email=>val,
         * password => 1234 
         *  ]
         */
        $status = [
            "error" => 0,
            "msg" => []
        ];
        if ($this->CheckTable($table)) {
            $key_val = "";

            foreach ($data as $key => $value) {


                $key_val .= " `{$key}` = '{$value}' , ";
            }
            $key_val = rtrim($key_val, " ,");

            // echo $key_val;

            $this->query = "UPDATE `{$table}`  SET  $key_val  WHERE  $where";

            $this->exe = $this->conn->query($this->query);

            if ($this->exe) {

                if ($this->conn->affected_rows > 0) {

                    array_push($status["msg"], "DATA HAS BEEN UPDATED");

                } else {

                    $status["error"]++;

                    array_push($status["msg"], "DATA REMAIN SAME");
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