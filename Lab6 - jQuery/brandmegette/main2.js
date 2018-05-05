var draggables = []
var draggableWidth = 400;
var draggableHeight = 60;
var containerWidth;
var containerHeight;
var selectedId = "";
var collapsed = false;
var expanded = false;
var expandedPos = -1;

$(document).ready(function () {
    let indx = 0;
    containerWidth = $("#container").width();
    containerHeight = $("#container").height();
    draggableX = containerWidth / 2 - draggableWidth / 2;
    console.log(draggableX);
    console.log(containerHeight, containerWidth);   
    positionDivs();
    $(".draggable").each(function(){
        draggables.push({id: $(this).attr('id'), x: $(this).position().left, y: $(this).position().top});
    });

    $(".draggable").mousedown(function (event) {
        selectedId = this.id;
    })
    .mousemove(function () {
        if (this.id == selectedId)
            moveElement(event.pageX, event.pageY);
    })
    .mouseup(function (event) {
        let indx = $('.draggable').index($('#' + selectedId));
        if (!collapsed && !expanded)
            $("#" + selectedId).animate({top: indx * 70, left: containerWidth / 2 - draggableWidth / 2}, "slow");
        else if (collapsed && !expanded){
            slideUp(indx);
            collapsed = false;
            $("#" + selectedId).animate({top: indx * 70, left: containerWidth / 2 - draggableWidth / 2}, "slow");
        }
        else if (collapsed && expanded){
            let top = event.pageY - draggableHeight / 2;
            let indx = Math.floor(top / 70);
            $("#" + selectedId).animate({top: indx * 70, left: containerWidth / 2 - draggableWidth / 2}, "slow");
            expanded = false;
            collapsed = false;
        }
           
        selectedId = "";
        // let indx = $('.draggable').index($('#' + selectedId));
        // whatever(indx);
        // console.log("dragged: ", $("#" + selectedId));
        // console.log("first: ", $(".draggable").first());
        // $("#" + selectedId).insertBefore($('.draggable').first());
        // 
        // let hmmm = "#" + selectedId;
        // console.log(hmmm);
        // // for (let i = 0; i < d.length; i++)
        //     console.log(d[i].id);
    })
})

function positionDivs() {
    let x = containerWidth / 2 - draggableWidth / 2;
    $(".draggable").css("left", x);
    for (let i = 0; i < 10; i++) {
        $("#container .draggable:nth-child(" + (i + 1) + ")").css("top", i * 70);
    }
}

function moveElement(x, y) {
    let left = x - draggableWidth;
    let top = y - draggableHeight / 2;
    let current = $("#" + selectedId);
    current.css("left", left + "px");
    current.css("top", top + "px");
    if (collapsed && left < containerWidth / 2 + draggableWidth / 2 && 
        left > containerWidth / 2 - draggableWidth / 2){
        let nr = Math.floor(top / 70);
        if (!expanded){ 
            slideUp(nr);
            console.log(nr);
            expanded = true;
            expandedPos = nr;
        }
    }
    if (left > containerWidth / 2 + draggableWidth / 2 || 
        left + draggableWidth < containerWidth / 2 - draggableWidth / 2){
        let indx = $('.draggable').index($('#' + selectedId));
        if (!collapsed){
            slideDown(indx);
            collapsed = true;
        }
        if (expanded){
            let nr = Math.floor(top / 70);
            slideDown(nr);
            console.log(nr);
            expanded = false;
        }
    }
}

function slideDown(indx){
    let pos = $('.draggable').index($('#' + selectedId));
    if (indx > pos)
        indx++;
    for (let i = indx; i > 0; i--)
        $("#container").find(".draggable:not(#"+selectedId+")")
            .filter(":nth-child(" + i + ")").animate({top: "+=70"}, "slow");
        //$("#container .draggable:nth-child(" + i + ")").animate({top: "+=70"}, "slow");
}

function slideUp(indx){
    let pos = $('.draggable').index($('#' + selectedId));
    if (indx > pos){console.log("occured");
    indx++;}
    for (let i = indx; i > 0; i--)
        $("#container").find(".draggable:not(#"+selectedId+")")
            .filter(":nth-child(" + i + ")").animate({top: "-=70"}, "slow");
}

$("html").mousemove(function (event) {
    if (selectedId != "")
        moveElement(event.pageX, event.pageY);
})

function slideRest() {
    var draggables = $('.draggable');
    for (d in draggables){
        console.log(d.id);
    }
    draggables.first().insertAfter(draggables.last());
    
}
