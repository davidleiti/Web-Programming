var items = []
var draggableWidth = 400;
var draggableHeight = 60;
var containerWidth;
var containerHeight;
var selectedId = "";
var draggedItem;
var collapsed = false;
var expanded = false;

$("html").mousemove(function (event) {
    if (selectedId != "")
        moveElement(event.pageX, event.pageY);
})

$(document).ready(function () {

    containerWidth = $("#container").width();
    containerHeight = $("#container").height();

    //Initial positioning of the items in the container based on order relative to their parent
    initItems();

    $(".draggable").mousedown(function (event) {
        selectedId = this.id;
    })
    .mousemove(function () {
        if (this.id == selectedId)  
            moveElement(event.pageX, event.pageY);
    })
    .mouseup(function (event) {
        let indx = getSelectedIndex();

        //Item released outside of the stack => make room for it because of the collapse and reinsert it
        if (collapsed && !expanded) {
            slideUp(getSelectedIndex());
            $("#" + selectedId).animate({ top: indx * 70, left: containerWidth / 2 - draggableWidth / 2 }, "slow");
            collapsed = false;
        }

        //Item didn't leave the stack => adjust its position
        else if (!collapsed && !expanded){
            $("#" + selectedId).animate({ top: indx * 70, left: containerWidth / 2 - draggableWidth / 2 }, "slow");
        }

        //Item being released inside the stack after leaving it => reinsert it and rearrange item order
        else if (collapsed && expanded){
            let top = event.pageY - draggableHeight / 2;
            let indx = Math.floor(top / 70);
            $("#" + selectedId).animate({top: indx * 70, left: containerWidth / 2 - draggableWidth / 2}, "slow");
            items = rearrangeList();
            expanded = false;
            collapsed = false;
        }

        //Release selection
        selectedId = "";
    })
})

//Change internal element order based on coordinates rather than DOM position
function rearrangeList(){
    let newList = [];
    for (let i = 0; i < items.length; i++){
        let y = Math.floor(items[i].position().top / 70);
        newList[y] = items[i];
    }
    return newList;
}

function initItems() {
    items = [];
    $(".draggable").each(function () { items.push($(this)) });
    for (let i = 0; i < items.length; i++) {
        items[i].css("top", i * 70);
        items[i].css("left", containerWidth / 2 - draggableWidth / 2);
    }
}

function moveElement(x, y) {
    //Change the position of the current item based on the given coordinates
    let left = x - draggableWidth;
    let top = y - draggableHeight / 2;
    let current = $("#" + selectedId);
    current.css("left", left + "px");
    current.css("top", top + "px");

    //Item dragged reinserted into stack, expanding is needed
    let cond1 = left < containerWidth / 2 + draggableWidth / 2 && 
        left > containerWidth / 2 - draggableWidth / 2;

    let cond2 = left + draggableWidth > containerWidth / 2 - draggableWidth / 2 &&
        left + draggableWidth < containerWidth / 2 + draggableWidth / 2
    if (collapsed && (cond1 || cond2)){
        let nr = Math.floor(top / 70);
        if (!expanded){ 
            slideUp(nr);
            expanded = true;
        }
    }

    //Item dragged outside of stack, need to collapse elements on top
    if (left > containerWidth / 2 + draggableWidth / 2 ||
        left + draggableWidth < containerWidth / 2 - draggableWidth / 2) {
        if (!collapsed) {
            slideDown(getSelectedIndex());
            collapsed = true;
        }
        if (expanded){
            let nr = Math.floor(top / 70);
            slideDown(nr+1);
            expanded = false;
        }
    }
}

//Get index within the item list of the selected item
function getSelectedIndex() {
    for (let i = 0; i < items.length; i++)
        if (items[i].attr('id') == selectedId)
            return i;
    return -1;
}

function slideDown(nr) {
    let index = getSelectedIndex();
    if (nr < index || (nr === index && expanded))
     nr--;
    for (let i = nr - 1; i >= 0; i--)
        if (items[i].attr('id') != selectedId)
            items[i].animate({top: "+=70"}, "slow");
}

function slideUp(nr) {
    let index = getSelectedIndex();
    if (nr > index)
        nr++;
    for (let i = nr - 1; i >= 0; i--)
        if (items[i].attr("id") != selectedId)
            items[i].animate({top: "-=70"}, "slow")
}
