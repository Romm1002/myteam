
var form = document.querySelector("#saisirDate");
var input = form.querySelector("input");

input.addEventListener("change", function(){
    console.log(form);
    form.submit();
});

function btnCalendrier(event,date){
    event.preventDefault();
    input.setAttribute("value",date);
    form.submit();
}

function expandColor(){
    if(document.getElementById("color-choice").style.maxHeight == "50vh"){
        document.getElementById("color-choice").style.maxHeight = "0px";
        document.getElementById("color-choice").style.padding = "0px";

    }else{
        document.getElementById("color-choice").style.maxHeight = "50vh";
        document.getElementById("color-choice").style.padding = "10px";
    }
    document.getElementById("color-choice").addEventListener("mouseleave", e =>{
        document.getElementById("color-choice").style.maxHeight = "0px";
        document.getElementById("color-choice").style.padding = "0px";
    })
}

function preview(e){
    document.getElementById("color-button-preview").style.backgroundColor = e.path[0].style.backgroundColor;
}

