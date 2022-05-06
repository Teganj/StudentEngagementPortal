
function updateUser(){
    alert("Select User");

    var x =document.getElementById("updateUser").value;


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