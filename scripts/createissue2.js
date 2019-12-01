window.onload = ()=> {

    let submit = document.getElementById("submit");
    let title = document.getElementById("title");
    let description = document.getElementById("description");

    let inputs = document.querySelectorAll(".createissue2 p input")


    

    submit.addEventListener('click', function(){

        let send = true;
        event.preventDefault();

        inputs.forEach((e,i) => e.style.backgroundColor = "white");

        if(title.value.length === 0){
            alert("Please add a title!")
//sets borederder to to red
        } if (){

        }


    });
}