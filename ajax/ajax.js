$(document).ready(function() {
    $("#form-nouvellePublication").on("submit", function(e) {

        var form = $("#form-nouvellePublication").serialize();

        $.ajax({
            type: "POST",
            url: "../traitements/accueil.php",
            data: form,
            success: function(){
                console.log("OKOK (naps)");
            }
        });
    });
});