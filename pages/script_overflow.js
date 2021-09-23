var timeout;
$('#bottom_left, #bottom_right').on("scroll", function callback(){
    // effacez le 'timeout' à chaque appel d'événement 'scroll' 
    // pour éviter de réassigner l'événement 'scroll' à un autre élément
    // avant la fin du défilement
    clearTimeout(timeout);

    // obtenir les éléments utilisés
    var source = $(this),
        target = $(source.is("#bottom_left") ? '#bottom_right' : '#bottom_left');

    // supprimer le rappel de l'autre 'div' et définir le 'scrollTop'
    target.off("scroll").scrollTop(source.scrollTop());

    // créer un nouveau 'timeout' et réaffecter l'événement 'scroll'
    // à un autre 'div' 100 ms après le dernier appel d'événement
    timeout = setTimeout(function(){
        target.on("scroll", callback);
    }, 100);
});

function overflowY(){
    var top_right = document.getElementById("top_right");
    var bottom_right = document.getElementById("bottom_right");

    top_right.scrollLeft = bottom_right.scrollLeft;
}