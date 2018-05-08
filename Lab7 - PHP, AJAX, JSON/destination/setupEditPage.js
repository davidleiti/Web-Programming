$("document").ready(function(){
    console.log("this is weird");
    $("#showAll").click(function(){
        $.ajax({
            url: "destinationsController.php",
            type: "GET",
            data: {
                methodName: "showAll"
            },
            success: function(data){
                $("#destinations").html(data);
            }
        })
    })
    $("#showWithID").click(function(){
        $.ajax({
            url: "destinationsController.php",
            type: "GET",
            data:{
                methodName: "showWithID",
                id: $("#DestinationID").val()
            },
            success: function(data){
                $("#destinations").html(data);
            }
        })
    })
    $("#insert").click(function(){
        $.ajax({
            url: "destinationsController.php",
            type: "POST",
            data:{
                methodName: "insert",
                country: $("#Country").val(),
                city: $("#City").val(),
                address: $("#Address").val(),
                description: $("#Description").val()
            },
            success: function(data){
                $("#destinations").html(data);
            }
        })
    })
    $("#delete").click(function(){
        $.ajax({
            url: "destinationsController.php",
            type: "DELETE",
            data:{
                methodName: "delete",
                id: $("#DestinationID").val()
            },
            success: function(data){
                $("#destinations").html(data);
            }
        })
    })
    $("#update").click(function(){
        $.ajax({
            url: "destinationsController.php",
            type: "POST",
            data:{
                methodName: "update",
                id: $("#DestinationID").val(),
                country: $("#Country").val(),
                city: $("#City").val(),
                address: $("#Address").val(),
                description: $("#Description").val()
            },
            success: function(data){
                $("#destinations").html(data);
            }
        })
    })
})