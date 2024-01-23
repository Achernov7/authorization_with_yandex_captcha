import fetchToLogout from "../modules/fetchToLogout.js";

let _btn_to_follow_to_register = document.getElementById("_btn_to_follow_to_register");
let _btn_to_follow_to_login = document.getElementById("_btn_to_follow_to_login");
let _btn_to_to_logout = document.getElementById("_btn_to_to_logout");
let _btn_to_follow_to_profile = document.getElementById("_btn_to_follow_to_profile");

if (_btn_to_follow_to_login != null) {
  _btn_to_follow_to_login.addEventListener("click", (event) => {
    event.preventDefault()
    window.location.href = "/login";
  })
}

if (_btn_to_follow_to_register != null) {
  _btn_to_follow_to_register.addEventListener("click", (event) => {
    event.preventDefault()
    window.location.href = "/registration";
  })
}

if (_btn_to_follow_to_profile != null) {
  _btn_to_follow_to_profile.addEventListener("click", (event) => {
    event.preventDefault()
    window.location.href = "/user/personal";
  })
}

if (_btn_to_to_logout != null) {
  _btn_to_to_logout.addEventListener("click", (event) => {
    event.preventDefault()
    fetchToLogout()
  })
}
