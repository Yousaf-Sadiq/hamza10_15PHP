<?php 


// http://localhost/hamza_10_15/oop_crud/dashboard.php


define("ROOTPATH","http://localhost/");

define("FOLDER","hamza_10_15/oop_crud");


define("ROOTPATH2",$_SERVER["DOCUMENT_ROOT"]);


// E:\xampp2\htdocs\hamza_10_15\oop_crud relative path  // uploading / deleting


// http://localhost/hamza_10_15/oop_crud absolute path  // fetching / getting 



define("domain1",ROOTPATH.FOLDER); // absolute path 


define("domain2",ROOTPATH2."/".FOLDER); // relative path 



define("DASHBOARD",domain1."/dashboard.php");

define("form_action",domain1."/action/form_action.php");



?>