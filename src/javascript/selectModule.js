function selectModule(){
    var x =document.getElementById("module").value;

    $.ajax({
        url:"../php/showModule.php",
        method: "POST",
        data: {
            id : x
        },
        success: function(data){
            $("#ans").html(data);
        }
    })

}