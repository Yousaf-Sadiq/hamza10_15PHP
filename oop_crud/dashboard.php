<?php

require_once dirname(__FILE__) . "/layout/user/header.php";

use app\database\Mysqli as DB;
use app\database\helper as help;

$obj = new DB;
$help = new help;

$q = $obj->Select("users", null, null, "id ASC", null);

echo domain2;
if ($q) {
    // echo "ok query";
    $abc = $obj->GetResult();
}
// $help->pre($abc);

$alldata = [
    "user_name" => "xyz",
    "email" => "xyz@gmail.com",
    "password" => "1234",
    "ptoken" => "1234",

];

// //  echo $obj->Myinsert("users",$alldata)
//  echo $obj->update("users",$alldata,"id=20")




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


<div class="table-responsive">
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">username</th>
                <th scope="col">EMAIL</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($abc as $key => $value) {

                ?>
                <tr class="">
                    <td scope="row"><?php echo $value["id"] ?></td>
                    <td><?php echo $value["user_name"] ?></td>
                    <td><?php echo $value["email"] ?></td>
                    <?php
                    $id = base64_encode($value["id"]);
                    $email = $value["email"];
                    $user_name = $value["user_name"];
                    ?>
                    <td>
                        <a href="javascript:void(0)"
                            onclick="onEdit('<?php echo $id ?>','<?php echo $email ?>','<?php echo $user_name ?>')"> EDIT
                        </a>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="edit_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="edit_lable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="edit_lable">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-bg-dark">

                <form class="p-2 " id="Edit_FORM">

                    <input type="hidden" name="UPDATES" value="update">
                    <input type="hidden" name="_token" id="token">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="emails" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">USER NAME</label>
                        <input type="text" name="user_name" class="form-control" id="user_name">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">ADDRESS</label>
                        <input type="text" name="address" class="form-control" id="address">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Choose file</label>
                        <input type="file" class="form-control" name="profile2" id="profile2" placeholder=""
                            aria-describedby="fileHelpId" />

                        <div id="fileHelpId" class="form-text">Help text</div>

                        <input type="text" class="form-control" id="rel" name="profile[]">
                        <input type="text" class="form-control" id="abs" name="profile[]">
                        <!--
                        profile => [
                            0 => rel
                            1=> abs
                            ]

                    -->
                    </div>




                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div> -->
        </div>
    </div>
</div>
<?php
require_once dirname(__FILE__) . "/layout/user/footer.php";
?>




<script>

    let profile2 = document.querySelector("#profile2"); // input type file 

    profile2.addEventListener("change", async function () {

        let file = profile2.files[0]; // get current file 

        // console.log(file)

        let formData = new FormData();
        //                         
        formData.append('uploads', "upload");
        formData.append('profile2', file);

        let url = "<?php echo form_action; ?>";

        var options = {
            method: 'POST',
            body: formData,
        }

        let data = await fetch(url, options);


        console.log(data);
        
        let res = await data.json();
        
        console.log(res);
        
        let error = res.error;
        let msg = res.msg;

        if (error > 0) {
            for (const mseg of msg) {

                ShowMsg(mseg, "error", "danger")

            }

            profile2.value = ""

        } else {
            ShowMsg("FILE UPLOADED", "error", "success")

            let file_rel = document.querySelector("#rel")
            let file_abs = document.querySelector("#abs")

            console.log(res)

            file_rel.value = res.relative_key;
            file_abs.value = res.abs_key;
        }


    })


    function onEdit(id, email, userName) {
        let modal = document.querySelector("#edit_modal");

        let BootstrapModal = new bootstrap.Modal(modal)

        BootstrapModal.show(modal)

        let Email = document.querySelector("#emails");
        let user_name = document.querySelector("#user_name");
        let token = document.querySelector("#token");

        Email.value = email;
        user_name.value = userName;
        token.value = id;

    }


    // update ======================================================

    let edit_form = document.querySelector("#Edit_FORM");


    edit_form.addEventListener("submit", async function (e) {
        e.preventDefault();

        let formData = new FormData(edit_form);


        let url = "<?php echo form_action; ?>";

        var options = {
            method: 'POST',
            body: formData,
        }

        let data = await fetch(url, options);

        let response = await data.json();


        if (response.error > 0) {
            let msg = response.msg;

            for (const message of msg) {

                ShowMsg(message, "error", "danger")
            }

        }
        else {

            ShowMsg(response.msg, "error", "success");


            setTimeout(function () {
                const truck_modal = document.querySelector('#edit_modal');
                const modal = bootstrap.Modal.getInstance(truck_modal);
                modal.hide();

                setTimeout(function () {
                    location.reload();
                }, 700)
            }, 1000)
        }

    });







    // insert==============================================================================
    let form = document.querySelector("#MyFORM");

    form.addEventListener("submit", async function (event) {
        event.preventDefault();

        let formData = new FormData(form);


        var options = {
            method: 'POST',
            body: formData,
        }

        let data = await fetch("<?php echo form_action; ?>", options);

        let response = await data.json();

        if (response.error > 0) {
            let msg = response.msg;

            for (const message of msg) {

                ShowMsg(message, "error", "danger")
            }

        }
        else {
            ShowMsg(response.msg, "error", "success")
        }

    });

</script>

<!-- <script src="asset/js/insert.js"></script> -->