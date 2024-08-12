<?php

// inheritance 

class fToC_CToF
{

    protected $celsuis;
    protected $farenheight;

    protected $result;


}


class calculate extends fToC_CToF
{


    public function SetCal($q)
    {
        $this->celsuis = $q;
    }

    public function setFaren($f)
    {
        $this->farenheight = $f;
    }
    public function calulateCToF()
    {
        $this->result = ((9 / 5) * $this->celsuis) + 32;

        return $this->result;
    }


    public function calculateFtoC()
    {
        $this->result = ($this->farenheight - 32) * (5 / 9);
        // °C = (°F - 32) × 5/9
        return $this->result;
    }

}



$obj = new calculate;
// $obj->SetCal(34);
// echo $obj->calulateCToF();

$obj->setFaren(99);

echo $obj->calculateFtoC()

?>