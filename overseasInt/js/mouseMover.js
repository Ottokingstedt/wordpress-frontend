document.addEventListener("DOMContentLoaded", function() {
    let innerCursor = document.querySelector(".inner-cursor");
    let outerCursor = document.querySelector(".outer-cursor");

    document.addEventListener("mousemove", moveCursor);

    function moveCursor(e){
        let x = e.clientX;
        let y = e.clientY;
        innerCursor.style.left = `${x}px`;
        innerCursor.style.top = `${y}px`;
        outerCursor.style.left = `${x}px`;
        outerCursor.style.top = `${y}px`;
    }

    let links = Array.from(document.querySelectorAll("a, .heading, .container-content"));

    links.forEach((link) => {
        link.addEventListener('mouseover', () => {
            innerCursor.classList.add('grow')
        })
        link.addEventListener('mouseleave', () => {
            innerCursor.classList.remove('grow')
        })
    })

    let teamImages = Array.from(document.querySelectorAll("#teamCont .member .img"));

    teamImages.forEach((teamImg) =>{
        teamImg.addEventListener("mouseover", ()=> {
            innerCursor.style.display = "none";
            outerCursor.style.display = "none";
        });
        teamImg.addEventListener("mouseleave", () => {
            innerCursor.style.display = "";
            outerCursor.style.display = "";
        });
    });
});