import fetchToLogout from "../modules/fetchToLogout.js";
import {showPopUp} from "../modules/invalid.js";

let _btn_to_to_logout = document.getElementById("_btn_to_to_logout");
let _btn_to_follow_to_main = document.getElementById("_btn_to_follow_to_main");

let _btn_edit_profile_cancel = document.getElementById("_btn_edit_profile_cancel");
let _btn_edit_profile = document.getElementById("_btn_edit_profile");
let _change_password_form = document.getElementById("_change_password");
let _btn_edit_profile_send = document.getElementById("_btn_edit_profile_send");

let _nameDiv = document.getElementById("_name");
let _emailDiv = document.getElementById("_email");
let _phoneDiv = document.getElementById("_phone");

let _name_input = document.getElementById("_name_input");
let _email_input = document.getElementById("_email_input");
let _phone_input = document.getElementById("_phone_input");
let _old_password_input = document.getElementById("_old_password_input");
let _new_password_input = document.getElementById("_new_password_input");

_btn_to_follow_to_main.addEventListener("click", (event) => {
    event.preventDefault()
    window.location.href = "/";
})
  
_btn_to_to_logout.addEventListener("click", (event) => {
    event.preventDefault()
    fetchToLogout()
})

_btn_edit_profile.addEventListener("click", (event) => {
    event.preventDefault()
    document.querySelectorAll("div.toShow").forEach(element => {
        element.style.display = "none"
    });

    _change_password_form.style.display = "block";
    document.querySelectorAll("input.toEdit").forEach(element => {
        element.style.display = "block"
    })

    _name_input.value = _nameDiv.textContent.replaceAll(" ", "");
    _email_input.value = _emailDiv.textContent.replaceAll(" ", "");
    _phone_input.value = _phoneDiv.textContent.replaceAll(" ", "");

    _btn_edit_profile.style.display = "none";
    _btn_edit_profile_cancel.style.display = "block";
    _btn_edit_profile_send.style.display = "block";
})

_btn_edit_profile_cancel.addEventListener("click", (event) => {
    event.preventDefault()
    cancel()
})

_btn_edit_profile_send.addEventListener("click", (event) => {
    event.preventDefault()
    fetchToEdit()
})

function fetchToEdit(){
    let data = new FormData();
    data.append("name", _name_input.value);
    data.append("email", _email_input.value);
    data.append("phone", _phone_input.value);
    if (_new_password_input.value != "") {
        data.append("password_old", _old_password_input.value);
        data.append("password_new", _new_password_input.value);
    }
    fetch("/api/profile/store", {
        method: "post",
        body:data
    })
    .then( (response) => {
        if (response.ok) {
            return response.json();
        }
    })
    .then(data => {
        if (!!data.error && data.error.includes('Invalid')) {
            showPopUp(data.error);
            return;
        } 
        if (data.message == "Successfully updated") {
            _nameDiv.textContent = _name_input.value;
            _emailDiv.textContent = _email_input.value;
            _phoneDiv.textContent = _phone_input.value;
            cancel()
        }
    })
    .catch(error => {
        console.log(error)
    })
}


function cancel(){
    document.querySelectorAll("div.toShow").forEach(element => {
        element.style.display = "block"
    });

    _change_password_form.style.display = "none";
    document.querySelectorAll("input.toEdit").forEach(element => {
        element.style.display = "none"
    })

    _btn_edit_profile.style.display = "block";
    _btn_edit_profile_cancel.style.display = "none";
    _btn_edit_profile_send.style.display = "none";
}