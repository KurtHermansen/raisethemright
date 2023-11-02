document.getElementById('learnMoreLink').addEventListener('click', function(event) {
    event.preventDefault();  // Prevent the default action (i.e., the link from navigating anywhere)
    const hiddenText = document.getElementById('hiddenText');
    if (hiddenText.classList.contains('hidden')) {
        hiddenText.classList.remove('hidden');
    } else {
        hiddenText.classList.add('hidden');
    }
});

function playPause() {
    var video = document.getElementById("featuredVideo");
    if (video.paused) {
        video.play();
    } else {
        video.pause();
    }
}

document.getElementById('menuBtn').addEventListener('click', function(){
    var navLinks = document.getElementById('navLinks');
    if(navLinks.style.display === "none" || navLinks.style.display === ""){
        navLinks.style.display = "flex";
    } else {
        navLinks.style.display = "none";
    }
});
