function makePage(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState==4 && xmlhttp.status==200){
            var createA = document.createElement('a');
            var createAText = document.createTextNode(xmlhttp.responseText);
            createA.setAttribute('href', xmlhttp.responseText);
            createA.appendChild(createAText);
            document.body.appendChild(createA);
        }
    }
}