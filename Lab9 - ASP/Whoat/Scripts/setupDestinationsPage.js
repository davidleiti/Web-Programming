$("document").ready(function () {
    $("#showAll").click(function () {
        $.get("Destinations/GetDestinations",
            function (data, status) {
                $("#resultsDiv").html(data);
            }
        )
    })
    $("#showWithID").click(function () {
        $.get("Destinations/GetDestinations", { DestinationID: $("#DestinationID").val() },
            function (data, status) {
                $("#resultsDiv").html(data);
            }
        )
    })
    $("#insert").click(function () {
        $.post("Destinations/AddDestination", {
            Country: $("#Country").val(),
            City: $("#City").val(),
            Address: $("#Address").val(),
            Description: $("#Description").val()
        },
            function (data, status) {
                $("#resultsDiv").html("<br><h3>" + data + "</h3>");
            });
    })
    $("#delete").click(function () {
        $.ajax({
            url: "Destinations/DeleteDestination",
            data: {
                DestinationID: $("#DestinationID").val()
            },
            success: function (data) {
                $("#resultsDiv").html("<br><h3>" + data + "</h3>");
            }
        })
    })
    $("#update").click(function () {
        $.ajax({
            url: "Destinations/UpdateDestination",
            type: "POST",
            data: {
                DestinationID: $("#DestinationID").val(),
                Country: $("#Country").val(),
                City: $("#City").val(),
                Address: $("#Address").val(),
                Description: $("#Description").val()
            },
            success: function (data) {
                $("#resultsDiv").html("<br><h3>" + data + "</h3>");
            }
        })
    })
})