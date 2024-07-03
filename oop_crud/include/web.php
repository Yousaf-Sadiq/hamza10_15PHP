<?php 


// http://localhost/hamza_10_15/oop_crud/dashboard.php


define("ROOTPATH","http://localhost/");

define("FOLDER","hamza_10_15/oop_crud");


define("ROOTPATH2",$_SERVER["DOCUMENT_ROOT"]);

// E:\xampp2\htdocs\hamza_10_15 relative path 
// http://localhost/hamza_10_15  absolute path
define("domain1",ROOTPATH.FOLDER);
define("domain2",ROOTPATH2."/".FOLDER);



define("DASHBOARD",domain1."/dashboard.php");

define("form_action",domain1."/action/form_action.php");



?>