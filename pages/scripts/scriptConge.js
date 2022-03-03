function open_demande_conge(){
    modal = document.getElementById("background");

    if(modal.style.display == "none"){
        modal.style.display = "flex";
    }
    else if(modal.style.display == "flex"){
        modal.style.display = "none";
    }
}