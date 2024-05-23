<?php

require_once dirname(__DIR__) . "/app/database.php";
require_once dirname(__DIR__) . "/include/web.php";

use app\database\Mysqli as DB;
use app\database\helper as help;


$database = new DB;

$help = new help;
?>

<?php

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





    if ($status["error"] > 0) {
        echo json_encode($status);

        // associative 

        // "name":"xyz"
        // name:"xyz"
    } else {

        $hash = password_hash($password, PASSWORD_BCRYPT);

        $encrypt = base64_encode($password);

        $data=[
            "email"=>$email,
            "password"=>$hash,
            "ptoken"=>$encrypt
        ];


     echo  $database->Myinsert("users",$data);

    }
}

?>