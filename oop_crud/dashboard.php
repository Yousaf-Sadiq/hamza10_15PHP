<?php

require_once dirname(__FILE__) . "/layout/user/header.php";

use app\database\Mysqli as DB;


$obj = new DB;

// $alldata= [
//     "user_name"=>"xyz",
//     "email"=>"xyz@gmail.com",
//     "password"=>"1234",
//     "ptoken"=>"1234",

// ];

// //  echo $obj->Myinsert("users",$alldata)



?>


<form class="p-5 m-5 text-bg-dark" id="MyFORM">

    <input type="hidden" name="insert" value="insert">

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="pswd" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php

require_once dirname(__FILE__) . "/layout/user/footer.php";
?>

<script>

    let form = document.querySelector("#MyFORM");

    form.addEventListener("submit", async function (event) {
        event.preventDefault();

        let formData = new FormData(form);


        var options = {
            method: 'POST',
            body: formData,
        }

        let data = await fetch("<?php echo form_action; ?>",options);

        let response = await data.json();

        console.log(response);
        
    });

</script>