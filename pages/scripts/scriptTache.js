var checkboxes = document.querySelectorAll("input[name=terminer]");
checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        var form = document.querySelector("#form-" + checkbox.id);
        if(this.checked){
            form.submit();
        }
    });
    
});

// Ce script envoie le formulaire lorsqu'une checkbox est cochée