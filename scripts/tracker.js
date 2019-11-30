window.onload = function() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var loginBtn = document.getElementById("loginBtn");

    loginBtn.onclick = login;
    
    function login() {
        event.preventDefault();
        httpRequest = new XMLHttpRequest();
        var url = "scripts/tracker.php";
        httpRequest.onreadystatechange = processLogin;
        httpRequest.open('POST', url);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.send('email=' + encodeURIComponent(email) + "&password=" + encodeURIComponent(password));
    }

    function processLogin() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                var response = httpRequest.responseText;
                if(response) {
                    alert("Login successful");
                    window.location = "Issues.html";
                }
            } else {
                alert('There was a problem with the request.');
            }
        }
    }
}