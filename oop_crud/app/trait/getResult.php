<?php

use app\database\helper as help;

trait Result
{
    public function GetResult()
    {
      
        // $rows = $this->exe->fetch_assoc();

        while ($rows = $this->exe->fetch_assoc()) {
            // echo "ok while";

            array_push($this->result, $rows);

        }

      

        return $this->result;

    }


}


?>