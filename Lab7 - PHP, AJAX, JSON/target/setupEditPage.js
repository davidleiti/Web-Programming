$("document").ready(function(){
    $("#showAll").click(function(){
        $.ajax({
            url: "targetsController.php",
            type: "GET",
            data: {
                methodName: "showAll"
            },
            success: function(data){
                $("#targets").html(data);
            }
        })
    })
    $("#showWithID").click(function(){
        $.ajax({
            url: "targetsController.php",
            type: "GET",
            data:{
                methodName: "showWithID",
                id: $("#TargetID").val()
            },
            success: function(data){
                $("#targets").html(data);
            }
        })
    })
    $("#insert").click(function(){
        $.ajax({
            url: "targetsController.php",
            type: "POST",
            data:{
                methodName: "insert",
                name: $("#Name").val(),
                description: $("#Description").val(),
                price: $("#Price").val(),
                destinationID: $("#DestinationID").val()
            },
            success: function(data){
                $("#targets").html(data);
            }
        })
    })
    $("#delete").click(function(){
        $.ajax({
            url: "targetsController.php",
            type: "DELETE",
            data:{
                methodName: "delete",
                id: $("#TargetID").val()
            },
            success: function(data){
                $("#targets").html(data);
            }
        })
    })
    $("#update").click(function(){
        $.ajax({
            url: "targetsController.php",
            type: "POST",
            data:{
                methodName: "update",
                id: $("#TargetID").val(),
                name: $("#Name").val(),
                description: $("#Description").val(),
                price: $("#Price").val(),
                destinationID: $("#DestinationID").val()
            },
            success: function(data){
                $("#targets").html(data);
            }
        })
    })
})