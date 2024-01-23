export default function fetchToLogout(){
    fetch("/api/auth/logout")
    .then( (response) => {
        console.log(response)
        if (response.ok) {
        return response.json();
        }
    })
    .then(data => {
        if (data.message == "Successfully logged out") {
            window.location.href = "/";
            return false;
        }
    })
    .catch(error => {
        console.log(error)
    })
}
