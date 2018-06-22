$("document").ready(function(){
   console.log($("img").attr("src"));
   $("#firstFriends").click(function(){
      $.ajax({
          url: "PersonController",
          type: "GET",
          data: {
              action: "firstFriends"
          },
          success: function(data){
              $("#resultDiv").html(data);
          }
      })
   });
    $("#secondFriends").click(function(){
        $.ajax({
            url: "PersonController",
            type: "GET",
            data: {
                action: "secondFriends"
            },
            success: function(data){
                $("#resultDiv").html(data);
            }
        })
    });
   loadFamilyMembers();
});

function loadFamilyMembers(){
    console.log("val: ", $("#familyMembers").text());
    $.ajax({
        url: "PersonController",
        type: "GET",
        data: {
            action: "familyMembers",
            val: $("#familyMembers").text()
        },
        success: function(data){
            console.log(data);
            $("#familyMembers").html(data);
        }
    })
}