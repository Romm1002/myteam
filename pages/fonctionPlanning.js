
var form = document.querySelector("#saisirDate");
var input = form.querySelector("input");

input.addEventListener("change", function(){
    console.log(form);
    form.submit();
});


// inputs.forEach(function(input){
//     input.addEventListener("change", function(){
//         console.log(form);
//         form.submit();
//     });
// });

function btnCalendrier(event,date){
    event.preventDefault();
    input.setAttribute("value",date);
    form.submit();
}

