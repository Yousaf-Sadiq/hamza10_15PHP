<?php

/**
 * oop behaviour 
 * 1. encapsulation 
 * 2. inheritance
 * 3. abstraction 
 * 4. polymorphis
 */

//  class and object 

// with in class variable we called properties 
// with in class function we called methods
class BASE
{
    // access modifier 

    // public private protected 

    private $name;


    public function SetName($a)
    {

        $this->name = $a;
    }


    public function GetName()
    {
        return $this->name;
    }
}


$obj = new BASE;


$obj->SetName("new name");

echo $obj->GetName();



//
/**
1. Find the area of a rectangle where the length
 is 5 and the width is 8.
2. Find the area of a triangle where the base is 4 and the height is 3.
3. Find the area of a circle where the radius is 3.
4. Convert temperatures from Celsius to Fahrenheit and Fahrenheit to Celsius.

*/

// ==================================================
// $obj2 = new BASE;


class areaOfRectangle
{

    // private $width, $length;
    private $width;
    private $length;


    public function setWidth($w)
    {
        $this->width = $w;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }

    public function Calculate()
    {
        $result = $this->width * $this->length;
        return $result;
    }

}


$abc= new areaOfRectangle;


$abc->setWidth(8);
$abc->setLength(10);

echo $abc->Calculate();