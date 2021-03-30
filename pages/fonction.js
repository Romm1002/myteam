// Fonction qui permet d'afficher le mdp
function togglePassword(id){
    input = document.getElementById(id);
    if(input.getAttribute("type") == "password"){
        input.setAttribute("type","text");
    }else{
        input.setAttribute("type","password");
    } 
}

function openPublications(){
    document.getElementById("clickPublications").style.display = "block";
}

function closePublications(){
    document.getElementById("clickPublications").style.display = "none";
}

function ajoutHashtag(){
    document.getElementById("textarea").value += "#";
}

function filtreDecroissant(){
    document.getElementById("main-section").style.flexDirection = "column-reverse";
}

function filtreCroissant(){
    document.getElementById("main-section").style.flexDirection = "column";
}

