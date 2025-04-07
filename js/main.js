document.addEventListener("DOMContentLoaded", function(){
    let photoThumbnail = document.querySelectorAll(".photo-thumbnail");
    let previousPic =  document.querySelector(".previous");
    let nextPic =  document.querySelector(".next");

    let arrowPrev = document.querySelector(".nav-prev");
    let arrowNext = document.querySelector(".nav-next");

    photoThumbnail.forEach(function(item){
        item.style.display = "none";
    })

    if (arrowPrev && previousPic) {
        arrowPrev.addEventListener("mouseenter", function () {
            previousPic.style.display = "block";
        });
        arrowPrev.addEventListener("mouseleave", function () {
            previousPic.style.display = "none";
        });
    }
    if (arrowNext && nextPic) {
        arrowNext.addEventListener("mouseenter", function () {
            nextPic.style.display = "block";
        });
        arrowNext.addEventListener("mouseleave", function () {
            nextPic.style.display = "none";
        });
    }

   

});