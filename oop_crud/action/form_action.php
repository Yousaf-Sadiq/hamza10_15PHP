<?php

require_once dirname(__DIR__) . "/app/database.php";
require_once dirname(__DIR__) . "/include/web.php";

use app\database\Mysqli as DB;
use app\database\helper as help;


$database = new DB;

$help = new help;
?>

<?php

if (isset($_POST["uploads"]) && !empty($_POST["uploads"])) {
  
   echo $help->File_upload("profile2",["jpg","png","jpeg"],"asset/upload/"); 
}



if (isset($_POST["insert"]) && !empty($_POST["insert"])) {

    $email = $help->Filter_data($_POST["email"]);
    $password = $help->Filter_data($_POST["pswd"]);




    $status = [
        "error" => 0,
        "msg" => []
    ];



    if (!isset($email) || empty($email)) {
        $status["error"]++;

        array_push($status["msg"], "EMAIL IS REQUIRED");

    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $status["error"]++;

            array_push($status["msg"], "EMAIL FORMAT INVALID");
        }
    }




    if (!isset($password) || empty($password)) {
        $status["error"]++;

        array_push($status["msg"], "PASSWORD IS REQUIRED");
    }

    $checKEmail="SELECT * FROM `users` WHERE `email`='{$email}'";
    
    $check = $database->mysql($checKEmail,true); 

    if ($check) {
        $status["error"]++;

        array_push($status["msg"], "EMAIL ALREADY EXIST"); 
    }



    if ($status["error"] > 0) {
        echo json_encode($status);

       
    } else {

        $hash = password_hash($password, PASSWORD_BCRYPT);

        $encrypt = base64_encode($password);

        $data = [
            "email" => $email,
            "password" => $hash,
            "ptoken" => $encrypt
        ];


        echo $database->Myinsert("users", $data);

    }
}


if (isset($_POST["UPDATES"]) && !empty($_POST["UPDATES"])) {

    $email = $help->Filter_data($_POST["email"]);
    $user_name = $help->Filter_data($_POST["user_name"]);
    $user_id = $help->Filter_data(base64_decode($_POST["_token"]));
    $prfile = $help->Filter_data($_POST["profile"]);




    $status = [
        "error" => 0,
        "msg" => []
    ];



    if (!isset($email) || empty($email)) {
        $status["error"]++;

        array_push($status["msg"], "EMAIL IS REQUIRED");

    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $status["error"]++;

            array_push($status["msg"], "EMAIL FORMAT INVALID");
        }
    }




    if (!isset($user_name) || empty($user_name)) {
        $status["error"]++;

        array_push($status["msg"], "USERNAME IS REQUIRED");
    }

    $checKEmail="SELECT * FROM `users` WHERE `email`='{$email}' AND id <> {$user_id}";
    
    $check = $database->mysql($checKEmail,true); 

    if ($check) {
        $status["error"]++;

        array_push($status["msg"], "EMAIL ALREADY EXIST"); 
    }



    if ($status["error"] > 0) {
        echo json_encode($status);

       
    } else {

        // $hash = password_hash($password, PASSWORD_BCRYPT);

        // $encrypt = base64_encode($password);

        $data = [
            "email" => $email,
            "user_name" => $user_name,
        ];


        echo $database->update("users", $data,"id = '{$user_id}'");

    }
}


?>