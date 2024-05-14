<?php

require_once dirname(__FILE__) . "/layout/user/header.php";

use app\database\Mysqli as DB;


$obj= new DB;

$alldata= [
    "user_name"=>"xyz",
    "email"=>"xyz@gmail.com",
    "password"=>"1234",
    "ptoken"=>"1234",

];

$obj->Myinsert("users",$alldata)




?>



<?php

require_once dirname(__FILE__) . "/layout/user/footer.php";
?>