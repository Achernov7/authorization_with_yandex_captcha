import {showPopUp} from "../modules/invalid.js";

let name = document.getElementById("login");
let password = document.getElementById("password");
let password_confirm = document.getElementById("password_confirm");
let email = document.getElementById("email");
let phone = document.getElementById("phone");
let btn_registration = document.getElementById("btn_registration");
let _btn_to_follow_to_main = document.getElementById("_btn_to_follow_to_main");

function fetchData(){
  let data = new FormData();
  data.append("name", name.value);
  data.append("password", password.value);
  data.append("password_confirm", password_confirm.value);
  data.append("email", email.value);
  data.append("phone", phone.value);
  fetch("/api/auth/create", {
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
      } else {
        window.location.href = "/";
      }
  })
  .catch(error => {
    showPopUp(error);
  })
}

btn_registration.addEventListener("click", (event) => {
  event.preventDefault()
  fetchData()
})

_btn_to_follow_to_main.addEventListener("click", (event) => {
  event.preventDefault()
  window.location.href = "/";
})

