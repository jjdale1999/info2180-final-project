window.onload = function() {
    var httpRequest;
    var homeLink = document.getElementById("home");
    var adduserLink = document.getElementById("adduser");
    var newissueLink = document.getElementById("newissue");
    var logoutLink = document.getElementById("logout");

    loadHome();

    homeLink.onclick = loadHome;
    adduserLink.onclick = loadAddUser;
    newissueLink.onclick = loadNewIssue;
    logoutLink.onclick = loadLogout;
    
    document.addEventListener("click", function(e) {
        if(e.target.id === "home-createNewUserBtn") {
            loadAddUser();
        } else if (e.target.id === "home-allBtn") {
            loadHome();
        } else if (e.target.id === "home-openBtn") {
            loadOpenTickets();
        } else if (e.target.id === "home-myTicketsBtn") {
            loadMyTickets();

        } else if (e.target.id === "adduser-submitBtn") {
            let firstname = document.getElementById("adduser-firstname").value;
            let lastname = document.getElementById("adduser-lastname").value;
            let password = document.getElementById("adduser-password").value;
            let email = document.getElementById("adduser-email").value;
            let emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
            if((firstname !== "") && (lastname !== "") && (password !== "") && (email !== "")) {
                if(passwordRegex.test(password)) {
                    if(emailRegex.test(email)) {
                        submitAddUser(firstname, lastname, password, email);
                    } else {
                        alert("Email address entered is invalid!");
                        loadAddUser();
                    }
                } else {
                    alert("Password too weak! Password must be at least eight(8) characters long, have at least one (1) uppsercase letter, one (1) lowercase letter and at least one (1) number!");
                    loadAddUser();
                }
            } else {
                alert("Please fill in all fields before submission");
                loadAddUser();
            }
            
        } else if (e.target.id === "newissue-submit") {
            let title = document.getElementById("newissue-title").value;
            let description = document.getElementById("newissue-description").value;
            let assignedTo = document.getElementById("newissue-assignedTo");
            let assignedToValue = assignedTo.options[assignedTo.selectedIndex].value;
            let type = document.getElementById("newissue-type");
            let typeValue = type.options[type.selectedIndex].value;
            let priority = document.getElementById("newissue-priority");
            let priorityValue = priority.options[priority.selectedIndex].value;

            if((title !== "") && (description !== "")) {
                submitIssue(title, description, assignedToValue, typeValue, priorityValue);
            } else {
                alert("Please fill in all fields before submission");
            }

        } else if (e.target.id === "page") {
            event.preventDefault();
            let title = e.target.innerHTML;            
            loadIssuePage(title);
        } else if (e.target.id === "page-closed") {
            let title = document.getElementById("page-title").innerHTML;
            closeTicket(title);
            alert("The \"" + title + "\" ticket was closed!");
            loadIssuePage(title)            
        } else if (e.target.id === "page-inprogress") {
            let title = document.getElementById("page-title").innerHTML;
            inProgressTicket(title);
            alert("The \"" + title + "\" ticket is now in progress!");
            loadIssuePage(title)            
        }
    });

    function loadHome() {
        event.preventDefault();
        let page = "home.php";
        let stateObj = {page: "home"};
        history.pushState(stateObj, null, "home");
        requestContent("scripts/"+page);
        document.title = 'BugMe Tracker | Home';

    }

    function loadAddUser() {
        event.preventDefault();
        let page = "adduser.php";
        let stateObj = {page: "adduser"};
        history.pushState(stateObj, null, "adduser");
        requestAddUser("scripts/"+page);
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

    function loadOpenTickets() {
        event.preventDefault();
        let page = "opentickets.php";
        let stateObj = {page: "opentickets"};
        history.pushState(stateObj, null, "opentickets");
        requestContent("scripts/"+page);
        document.title = 'BugMe Tracker | Home';

    }

    function loadMyTickets() {
        event.preventDefault();
        let page = "mytickets.php";
        let stateObj = {page: "mytickets"};
        history.pushState(stateObj, null, "mytickets");
        requestContent("scripts/"+page);
        document.title = 'BugMe Tracker | Home';

    }

    function loadIssuePage(title) {
        event.preventDefault();
        let page = "issuepage.php?title=" + title;
        let stateObj = {page: "issuepage"};
        history.pushState(stateObj, null, "issuepage");
        requestContent("scripts/"+page);
        document.title = 'BugMe Tracker | ' + title;
    }

    function submitAddUser(firstname, lastname, password, email) {
        event.preventDefault();
        httpRequest = new XMLHttpRequest();
        var url = "scripts/submitadduser.php";
        httpRequest.onreadystatechange = processAddUser;
        httpRequest.open('POST', url);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.send('firstname=' + encodeURIComponent(firstname) + '&lastname=' + encodeURIComponent(lastname) +  '&email=' + encodeURIComponent(email) + "&password=" + encodeURIComponent(password));
    }

    function submitIssue(title, description, assignedToValue, typeValue, priorityValue){
        event.preventDefault();
        httpRequest = new XMLHttpRequest();
        var url = "scripts/submitissue.php";
        httpRequest.onreadystatechange = processSubmitIssue;
        httpRequest.open('POST', url);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.send('title=' + encodeURIComponent(title) + '&description=' + encodeURIComponent(description) +  '&assignedTo=' + encodeURIComponent(assignedToValue) + "&type=" + encodeURIComponent(typeValue) + "&priority=" + encodeURIComponent(priorityValue));
    }

    function closeTicket(title) {
        httpRequest = new XMLHttpRequest();
        var url = "scripts/closeticket.php";
        httpRequest.onreadystatechange = processTicket(title);
        httpRequest.open('POST', url);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.send('title=' + encodeURIComponent(title));
    }

    function inProgressTicket(title) {
        httpRequest = new XMLHttpRequest();
        var url = "scripts/inprogressticket.php";
        httpRequest.onreadystatechange = processTicket(title);
        httpRequest.open('POST', url);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.send('title=' + encodeURIComponent(title));
    }

    function requestContent(filename) {
        httpRequest = new XMLHttpRequest();
        var url = filename;
        httpRequest.onreadystatechange = loadPage;
        httpRequest.open('GET', url);
        httpRequest.send();
    }

    function requestAddUser(filename) {
        httpRequest = new XMLHttpRequest();
        var url = filename;
        httpRequest.onreadystatechange = checkAddUser;
        httpRequest.open('GET', url);
        httpRequest.send();
    }

    function checkAddUser() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                let response = httpRequest.responseText;
                if(response === "false") {
                    alert("You are not an admin!");
                } else {
                    document.getElementById("result").innerHTML = response;
                }
            } else {
                alert('There was a problem with the request.');
            }
        }
    }

    function loadLogout() {
        event.preventDefault();
        httpRequest = new XMLHttpRequest();
        var url = "scripts/logout.php";
        httpRequest.onreadystatechange = processLogout;
        httpRequest.open('GET', url);
        httpRequest.send();
    }

    function processLogout() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                alert("You have been logged out. Bye!");
                window.location = "userlogin.html";
            }
        }
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
                let response = httpRequest.responseText;
                document.getElementById("result").innerHTML = response;
                
            } else {
                alert('There was a problem with the request.');
            }
        }
    }

    function processAddUser() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                let response = httpRequest.responseText;
                if(response === "true") {
                    alert("Successfully added to database!");
                    loadHome();
                } else {
                    alert("Email entered is already taken!");
                }
            } else {
                alert('There was a problem with the request.');
            }
        }
    }

    function processSubmitIssue() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                let response = httpRequest.responseText;
                if(response === "true") {
                    alert("Successfully added to database!");
                    loadHome();
                } else {
                    alert("There was a problem with adding the issue to the database");
                }
            } else {
                alert('There was a problem with the request.');
            }
        }
    }

    function processTicket(title) {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                let response = httpRequest.responseText;
                alert(response);
                if(response === "true") {
                    
                } else {
                    alert("There was a problem with updating the issue in the database");
                }
            } else {
                alert('There was a problem with the request.');
            }
        }
    }

}
