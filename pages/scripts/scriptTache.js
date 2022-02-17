var checkbox = document.querySelector("input[name=terminer]");
var form = document.querySelector("#taches");

checkbox.addEventListener('change', function() {
    if(this.checked){
        form.submit();
    }
});

// Ce script envoie le formulaire lorsqu'une checkbox est cochée