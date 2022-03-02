// Fonction qui permet d'afficher le mdp
function togglePassword(id){
    input = document.getElementById(id);
    if(input.getAttribute("type") == "password"){
        input.setAttribute("type","text");
    }else{
        input.setAttribute("type","password");
    } 
}

// Fonction qui permet d'ouvrir la popup pour écrire une publication
function openPublications(){
    document.getElementById("clickPublications").style.display = "flex";
}
// Fonction qui permet de fermer la popup pour écrire une publication
function closePublications(){
    document.getElementById("clickPublications").style.display = "none";
}
// Fonction qui permet d'ajouter un # dans une publication
function ajoutHashtag(){
    document.getElementById("textarea").value += "#";
}
// Fonction qui permet d'afficher les commantaires sous une publication
function showRepondre(id){
    var div = document.getElementById(id);
    if(div.style.display == "none"){
        document.getElementById(id).style.display = "block";
    }else{
        document.getElementById(id).style.display = "none";
    }
}

// Fonction qui permet d'ouvrir la popup des sondages
function open_sondage(){
	document.getElementById("sondage").style.display = "flex";
}
// Fonction qui permet la fermeture des sondages
function close_sondage(){
	document.getElementById("sondage").style.display = "none";
}

// Créer un nouveau choix sondage
var compteur = 1;
$(document).ready(function() {
    $('#add_choice').click(function() {
        $('#choix').append(
            $('<input>').prop({
                type: 'text',
                name: compteur,
		    placeholder: 'Choix ' + compteur,
		    id: 'id' + compteur
            })
        );
    compteur++;
    })
});