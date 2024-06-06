<?php

trait Select
{

    //    public function SUM($A, $b, $c, $d=4)
//     {

    //     }

    //     SUM(1,5,7);



    public function Select(string $table, string $row = null, string $where = null, string $orderBY = null, string $limit = null)
    {

        /**
         * variable/variate/changeble data
         * SELECT * FROM table 
         * SELECT name,email FROM table WHERE `id`
         * SELECT password FROM table WHERE orderby DESC
         * SELECT * FROM table WHERE  orderby DESC LIMIT  offset/start 
         */

        if ($row == null) {
            $row = "*";
        }

        $this->query = "SELECT {$row} FROM `{$table}` ";


        if ($where != null) {
            $this->query .= " WHERE {$where}";
        }

        if ($orderBY != null) {
            $this->query .= " ORDER BY {$orderBY}";
        }

        if ($limit != null) {
            $this->query .=" LIMIT {$limit}";
        }

        $this->exe= $this->conn->query($this->query);
        
        if ($this->exe) {
            // echo $this->query;

            
            return true;
        }
        else{
            return false;
        }




    }
}

?>