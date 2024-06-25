<?php
// to execute custom query 
trait Mysql
{

    // $link->query();

    public function mysql(string $query, bool $checkRow = false)
    {
        $this->query = $query;

        $this->exe = $this->conn->query($this->query);


        if ($this->exe) {

            if ($checkRow) {

                if ($this->exe->num_rows > 0) {
                    return true;
                } else {
                    return false;
                }

            }
          

            return true;
        } else {
            return false;
        }

    }
}

?>