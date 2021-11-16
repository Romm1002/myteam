function afficherContacts(){
    var rot;
    if(document.getElementById("btn-contact").style.transform == ""){
        rot = 180;
    }else if(document.getElementById("btn-contact").style.transform.substr(7,3) == "900"){
        rot = 0;
    }else{
        rot = parseInt(document.getElementById("btn-contact").style.transform.substr(7,3)) + 180;
    }


    if(document.getElementById("accueil-left").style.transform != "translateX(0px)"){
        document.getElementById("accueil-left").style.transform = "translateX(0px)"
        document.getElementById("btn-contact").style.transform = "rotate(" + rot + "deg)"
        document.getElementById("block").style.display = "block"
    }else{
            document.getElementById("accueil-left").style.transform = ""
            document.getElementById("btn-contact").style.transform = "rotate("+ rot +"deg)"
        document.getElementById("block").style.display = ""
            
    }
}