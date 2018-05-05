var draggables = []
var draggableWidth;
var draggableHeight;
var mouseHeldDown = false;
var selectedIndex;

$(document).ready(function(){
    //code
    positionDivs();
    let mouseHeldDown = false;
    $(".draggable").mousedown(function(event){
      mouseHeldDown = true;
      selectedIndex = $(".draggable").index(event.target);
      console.log("selected index: ", selectedIndex);
    })
    .mousemove(function(event){
      console.log("selected index: ", selectedIndex);
      if (mouseHeldDown == true){
        // let child = event.target;
        // let parent = event.target.parentNode;
        // let mousePos = {
        //   x: parent.offsetWidth - event.pageX,
        //   y: child.offsetHeight - parent.offsetHeight
        // }
        x = event.pageX;
        y = event.pageY;  
        let draggable = document.getElementById("item-" + (selectedIndex+1));
        draggable.style.left = x - draggableWidth / 2 + "px";
        draggable.style.top = y - draggableHeight / 2+ "px";
        console.log("moving id: ", selectedIndex);
      }
    })
    .mouseup(function(){
      mouseHeldDown = false;
      console.log("mouse up");
      selectedIndex = -1;
      console.log("selected index: ", selectedIndex);
    })


    // draggables.forEach(function(d){
    //   d.addEventListener("mousedown", elemClicked, false);
    // })

})

$("body").mouseup(function(){
    mouseHeldDown = false;
    console.log("released");
})

function positionDivs(){
  draggables = Array.prototype.slice.call(document.getElementsByClassName("draggable"));
  draggableWidth = draggables[0].offsetWidth;
  draggableHeight =  draggables[0].offsetHeight;
}