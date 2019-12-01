window.onload = function() {
    var homeLink = document.getElementById("home");
    var adduserLink = document.getElementById("adduser");
    var newissueLink = document.getElementById("newissue");
    var logoutLink = document.getElementById("logout");

    homeLink.onclick = loadHome;
    adduserLink.onclick = loadAddUser;
    newissueLink.onclick = loadNewIssue;
    logoutLink.onclick = loadLogout;

    function loadHome() {
        event.preventDefault();
        let page = "home.php";
        let stateObj = {page: "home"};
        history.pushState(stateObj, null, "home");

    }

    function loadAddUser() {
        event.preventDefault();
    }

    function loadNewIssue() {
        event.preventDefault();
    }

    function loadLogout() {
        event.preventDefault();
    }
}