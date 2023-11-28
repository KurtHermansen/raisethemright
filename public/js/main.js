document.getElementById('menuBtn').addEventListener('click', function() {
    var navLinks = document.getElementById('navLinks');
    var logo = document.querySelector('.header-logo');
    var hamburger = document.querySelector('.hamburger');
    var close = document.querySelector('.close');
    var header = document.querySelector('.header');

    navLinks.classList.toggle('hidden');
    hamburger.classList.toggle('hidden');
    close.classList.toggle('hidden');
    logo.classList.toggle('header-expanded');
    header.classList.toggle('flex-col');
    header.classList.toggle('flex-row');
});


// document.getElementById('learnMoreLink').addEventListener('click', function(event) {
//     event.preventDefault();  // Prevent the default action (i.e., the link from navigating anywhere)
//     const hiddenText = document.getElementById('hiddenText');
//     if (hiddenText.classList.contains('hidden')) {
//         hiddenText.classList.remove('hidden');
//     } else {
//         hiddenText.classList.add('hidden');
//     }
// });

function playPause() {
    var video = document.getElementById("featuredVideo");
    if (video.paused) {
        video.play();
    } else {
        video.pause();
    }
}

// document.getElementById('menuBtn').addEventListener('click', function(){
//     var navLinks = document.getElementById('navLinks');
//     if(navLinks.style.display === "none" || navLinks.style.display === ""){
//         navLinks.style.display = "flex";
//     } else {
//         navLinks.style.display = "none";
//     }
// });
