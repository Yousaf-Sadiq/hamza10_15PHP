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