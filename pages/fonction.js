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
    document.getElementById("clickPublications").style.display = "flex";
}

function closePublications(){
    document.getElementById("clickPublications").style.display = "none";
}

function ajoutHashtag(){
    document.getElementById("textarea").value += "#";
}

function filtreDecroissant(){
    document.getElementById("right-content").style.flexDirection = "column-reverse";
}

function filtreCroissant(){
    document.getElementById("right-content").style.flexDirection = "column";
}

function showRepondre(id){
    var div = document.getElementById(id);
    if(div.style.display == "none"){
        document.getElementById(id).style.display = "block";
    }else{
        document.getElementById(id).style.display = "none";
    }
}