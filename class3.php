<?php
namespace class3File;
// abstraction 


abstract class commonFunction
{



    abstract public function display();
}

trait allFunction
{
    public function showMessage($message)
    {
        echo $message;
    }
}


interface test
{
    public function display();
}

interface test2
{
    public function show();
}

class A implements test, test2
{
    use allFunction;
    public function display()
    {

    }


    public function show()
    {

    }
}



$obj= new A;
$obj->showMessage("trait");

?>