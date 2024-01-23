import {showPopUp} from "../modules/invalid.js";

let _btn_to_follow_to_main = document.getElementById("_btn_to_follow_to_main");
let btn_login = document.getElementById("btn_login");

let smartToken = '';

let login = document.getElementById("login_email_phone");
let password = document.getElementById("login_password");

_btn_to_follow_to_main.addEventListener("click", (event) => {
    event.preventDefault()
    window.location.href = "/";
  })

btn_login.addEventListener("click", (event) => {
  event.preventDefault()
  fetchDataToLogin()
})

function fetchDataToLogin(){
  let data = new FormData();
  data.append("login", login.value);
  data.append("password", password.value);
  data.append("smartToken", smartToken);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/api/auth/login");

  xhr.send(data);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      let json = JSON.parse(xhr.responseText);
      if (xhr.status === 200) {
        if (!!json.error && json.error.includes('Invalid')) {
            if (json.error == "Invalid authorization") {
                setTimeout(() => {
                  window.location.reload();
                }, 5000);
            }
            showPopUp(json.error);
        } else {
          window.location.href = "/";
        }
      } else {
          showPopUp(json);
      }
    }
  }
}
function onCaptchaReady(token) {
  if (token) {
    smartToken = token;
    document.getElementById('btn_login').style.display = 'block';
    document.getElementById('captcha-container').style.display = 'none';
  } else {
    alert('Captcha validation failed. Please try again.');
  }
}

window.onCaptchaReady = onCaptchaReady;
