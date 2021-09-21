function changeInputType(id){
    // var textContent = event.target.parentNode.parentNode.childNodes[0];
    // console.log(textContent);
    var input = document.getElementById(id);
    if(input.getAttribute("type") == "hidden"){
        input.setAttribute("type","text");
    }else{
        input.setAttribute("type","hidden");
    } 
}