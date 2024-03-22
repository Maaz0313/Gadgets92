$(function () {
  var modal = $(".modal");
  var body = $(window);
  // Get modal size
  var w = modal.width();
  var h = modal.height();
  // Get window size
  var bw = body.width();
  var bh = body.height();

  // Update the css and center the modal on screen
  modal.css({
    "position": "absolute",
    "top": ((bh - h) / 2) + "px",
    "left": ((bw - w) / 2) + "px"
  })
});

const categoryHeadings = document.querySelectorAll(".category h3");

categoryHeadings.forEach(h=>{
  h.addEventListener("click", ()=> {
    h.classList.toggle("active");
    const table = h.nextElementSibling;
    
    if(h.classList.contains("active")){
      table.style.display = "table";
      return;
    }

    table.style.display = "none";
  })
})