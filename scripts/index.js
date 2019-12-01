window.onload = function() {
    var httpRequest;
    var homeLink = document.getElementById("home");
    var adduserLink = document.getElementById("adduser");
    var newissueLink = document.getElementById("newissue");
    var logoutLink = document.getElementById("logout");
    var allbtn = document.getElementById("allbtn");
    var openbtn = document.getElementById("openbtn");
    loadHome();
    homeLink.onclick = loadHome;
    adduserLink.onclick = loadAddUser;
    newissueLink.onclick = loadNewIssue;
    logoutLink.onclick = loadLogout;
    allbtn.onclick=queryall;
    openbtn.onclick=queryopen;
    //just testing
   
    function queryall(){
        event.preventDefault();
        let page = "home.php";
        let stateObj = {page: "home"};
        history.pushState(stateObj, null, "home");
        requestContent("scripts/"+page+"?home='all'");
        document.title = 'BugMe Tracker | Home';
    }

    function queryopen(){
        event.preventDefault();
        let page = "home.php";
        let stateObj = {page: "home"};
        history.pushState(stateObj, null, "home");
        requestContent("scripts/"+page+"?home='open'");
        document.title = 'BugMe Tracker | Home';
    }

    function loadHome() {
        event.preventDefault();
        let page = "home.php";
        let stateObj = {page: "home"};
        history.pushState(stateObj, null, "home");
        requestContent("scripts/"+page+"?home='home'");
        document.title = 'BugMe Tracker | Home';

    }

    function loadAddUser() {
        event.preventDefault();
        let page = "adduser.php";
        let stateObj = {page: "adduser"};
        history.pushState(stateObj, null, "adduser");
        requestContent("scripts/"+page);
        document.title = 'BugMe Tracker | Add User';
    }

    function loadNewIssue() {
        event.preventDefault();
        let page = "newissue.php";
        let stateObj = {page: "newissue"};
        history.pushState(stateObj, null, "newissue");
        requestContent("scripts/"+page);
        document.title = 'BugMe Tracker | New Issue';
    }

    function loadLogout() {
        event.preventDefault();
        let page = "logout.php";
        let stateObj = {page: "logout"};
        history.pushState(stateObj, null, "logout");
        requestContent("scripts/"+page);
        document.title = 'BugMe Tracker | Logout';
    }

    function requestContent(filename) {
        httpRequest = new XMLHttpRequest();
        var url = filename;
        httpRequest.onreadystatechange = loadPage;
        httpRequest.open('GET', url);
        httpRequest.send();
    }


    window.onpopstate = function(event) {
        let page = history.state.page;
        let filename = page + ".php";
    
        // load the page and put it's contents in the main element.
        requestContent("scripts/"+filename);
    
        // Update the page title in the browser tab
        document.title = 'BugMe Tracker | ' + page;
    
      };

    function loadPage() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                var response = httpRequest.responseText;
                document.getElementById("result").innerHTML = response;
                
            } else {
                alert('There was a problem with the request.');
            }
        }
    }
}