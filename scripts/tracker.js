window.onload = function() {
    var httpRequest;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var loginBtn = document.getElementById("loginBtn");

    loginBtn.onclick = login;
    
    function login() {
        event.preventDefault();
        httpRequest = new XMLHttpRequest();
        var url = "scripts/home.php";
        httpRequest.onreadystatechange = processLogin;
        httpRequest.open('GET', url);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.send('emaillog=' + encodeURIComponent(email) + "&password=" + encodeURIComponent(password));
    }

    function processLogin() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                var response = httpRequest.responseText;
                if(response) {
                    alert("Login successful");
                    window.location = "index.html";
                }
            } else {
                // alert('There was a problem with the request.');
            }
        }
    }
}