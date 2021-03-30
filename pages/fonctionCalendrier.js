
// var form = document.querySelector("#good");
// var input = document.querySelector("#date");

// input.addEventListener("change", function(){
//     form.submit();
// });


var form = document.querySelector("form");
var inputs = document.querySelectorAll("input");

inputs.forEach(function(input){
    input.addEventListener("change", function(){
        form.submit();
    });
});

