<?php

require_once dirname(__DIR__) . "/app/database.php";
require_once dirname(__DIR__) . "/include/web.php";

use app\database\Mysqli as DB;
use app\database\helper as help;


$database = new DB;

$help = new help;
?>

<?php
// use to upload file
if (isset($_POST["uploads"]) && !empty($_POST["uploads"])) {




    $ext = ["jpg", "png", "jpeg"];
    $input = "profile2";
    $to = "asset/upload/";

    $user_id = $help->Filter_data(base64_decode($_POST["token"]));

    $image_chk = "SELECT * FROM `address` WHERE `user_id`='{$user_id}'";

    $check = $database->mysql($image_chk, true);

    if ($check) {

        $f_image = $database->GetResult();
        $f_image = $f_image[0]["image"];
        $f_image = json_decode($f_image, true);

        if (file_exists($f_image["relative_key"])) {
            # code...
            unlink($f_image["relative_key"]);
        }
        /**
          0=>[
            "address_id",
            "image"->"",
            "user_id"=>""
          ] 
    **/

    }

    echo $help->File_upload($input, $ext, $to);
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

    $checKEmail = "SELECT * FROM `users` WHERE `email`='{$email}'";

    $check = $database->mysql($checKEmail, true);

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

    $address = $help->Filter_data($_POST["address"]);
    $profile = $_POST["profile"];

    // $profile = json_encode( $profile);

    // $help->pre($profile);


    // "{&quot;relative_key&quot;:&quot;E:/xampp2/htdocs/hamza_10_15/oop_crud/asset/upload/1_wallpaperflare.com_wallpaper.jpg&quot;,&quot;abs_key&quot;:&quot;http://localhost/hamza_10_15/oop_crud/asset/upload/1_wallpaperflare.com_wallpaper.jpg&quot;}"
    // die();

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

    $checKEmail = "SELECT * FROM `users` WHERE `email`='{$email}' AND id <> {$user_id}";

    $check = $database->mysql($checKEmail, true);

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



        echo $database->update("users", $data, "id = '{$user_id}'");


        if (isset($profile) && !empty($profile)) {

            $profile = [
                "relative_key" => $profile[0],
                "abs_key" => $profile[1]
            ];

            $profile = json_encode($profile);

            $data_address = [
                "image" => $profile,
                "address_name" => $address,
                "user_id" => $user_id,
            ];


            $check_address = "SELECT * FROM `address` WHERE `user_id`='{$user_id}'";
            $check = $database->mysql($check_address, true);
            // true for update 

            // false for insert 
            if ($check) {
                $database->update("address", $data_address, " `user_id`='{$user_id}'");
            } else {
                $database->Myinsert("address", $data_address);
            }

        } else {


            $data_address = [
                "address_name" => $address,
                "user_id" => $user_id,
            ];


            $check_address = "SELECT * FROM `address` WHERE `user_id`='{$user_id}'";
            $check = $database->mysql($check_address, true);
            // true for update 

            // false for insert 
            if ($check) {
                $database->update("address", $data_address, " `user_id`='{$user_id}'");
            } else {
                $database->Myinsert("address", $data_address);
            }


        }

    }
}


?>