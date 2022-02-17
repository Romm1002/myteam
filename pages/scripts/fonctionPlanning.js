
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

window.onload = function(){
    var editInputs = document.querySelectorAll(".editEvenement");
    editInputs.forEach(editInput => editInput.style.width = editInput.value.length + "ch");
};

function editEvenement(id){
    var evenement = document.getElementById(id);
    var editInputsSelected = document.querySelectorAll(".editEvenementSelected");
    editInputsSelected.forEach(editInputSelected => editInputSelected.className = "editEvenement");

    evenement.readOnly = false;
    evenement.className = "editEvenementSelected";
    evenement.addEventListener('input', function(){this.style.width = this.value.length + "ch";}); 
}