window.onload = ()=> {

    let submit = document.getElementById("submit");
    let title = document.getElementById("title");
    let description = document.getElementById("description");
    let assignedTo = document.getElementById("")

    let inputs = document.querySelectorAll(".createissue2 p input")


    

    submit.addEventListener('click', function(){

        let send = true;
        

        inputs.forEach((e,i) => e.style.backgroundColor = "white");

        if(title.value.length === 0){
            alert("Please add a title!");

            title.style.backgroundColor = "red";
            send = false;

        } if(description.value.length === 0){
            alert("Please add a description");
            //set border to red to illustrate it is required
            alert("Please add description");
            send = false;

        } if(validate_dropdown(assignedTo)){
            //do something
            alert("i'm here")
        }else {
            event.preventDefault();
        }


    });

    function validate_dropdown(){

        //let indexOption = assignedTo.options[assignedTo.selectedIndex].value;
        let indexOptionText = assignedTo.options[assignedTo.selectedIndex].value.text;

        if(indexOptionText === 0){
            alert("please select an option");

        }else{
            break;
        }

        
    }
}
