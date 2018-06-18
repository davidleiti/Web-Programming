$("document").ready(function () {
    $("#showAll").click(function () {
        $.get("Targets/GetTargets",
            function (data, status) {
                $("#resultsDiv").html(data);
            }
        )
    })
    $("#showWithID").click(function () {
        $.get("Targets/GetTargets", { TargetID: $("#TargetID").val() },
            function (data, status) {
                $("#resultsDiv").html(data);
            }
        )
    })
    $("#insert").click(function () {
        $.post("Targets/AddTarget", {
            Name: $("#Name").val(),
            Description: $("#Description").val(),
            Price: $("#Price").val(),
            DestinationID: $("#DestinationID").val()
        },
            function (data, status) {
                $("#resultsDiv").html("<br><h3>" + data + "</h3>");
            });
    })
    $("#delete").click(function () {
        $.ajax({
            url: "Targets/DeleteTarget",
            data: {
                TargetID: $("#TargetID").val()
            },
            success: function (data) {
                $("#resultsDiv").html("<br><h3>" + data + "</h3>");
            }
        })
    })
    $("#update").click(function () {
        $.ajax({
            url: "Targets/UpdateTarget",
            type: "POST",
            data: {
                TargetID: $("#TargetID").val(),
                Name: $("#Name").val(),
                Description: $("#Description").val(),
                Price: $("#Price").val(),
                DestinationID: $("#DestinationID").val()
            },
            success: function (data) {
                $("#resultsDiv").html("<br><h3>" + data + "</h3>");
            }
        })
    })
})