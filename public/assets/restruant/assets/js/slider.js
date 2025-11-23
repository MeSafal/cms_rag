document.addEventListener("DOMContentLoaded", function () {
    const section = document.getElementById("slideshow-section");
    const overlay = document.getElementById("overlay");
    const subtitle = document.getElementById("slideshow-subtitle");
    const title = document.getElementById("slideshow-title");
    const description = document.getElementById("slideshow-description");
    const buttonText = document.getElementById("slideshow-btn-text");
    const buttonLink = document.getElementById("slideshow-btn-link");

    // Get all the slides from HTML
    const slides = document.querySelectorAll("#slideshow-items .slide");
    let currentIndex = 0;

    // Function to display a specific slide immediately (without fade)
    function displaySlide(index) {
        const slide = slides[index];
        section.style.backgroundImage = `url('${slide.getAttribute('data-image')}')`;
        overlay.style.opacity = 0.8;
        subtitle.textContent = slide.getAttribute('data-subtitle');
        title.textContent = slide.getAttribute('data-title');
        description.textContent = slide.getAttribute('data-description');
        buttonText.textContent = slide.getAttribute('data-button-text');
        buttonLink.href = slide.getAttribute('data-button-link');
    }

    // Generic function to fade out current content and then fade in a given slide.
    // duration is in ms.
    function fadeOutIn(duration, nextIndex, callback) {
        // Set transitions
        section.style.transition = `opacity ${duration}ms ease-in-out`;
        overlay.style.transition = `opacity ${duration}ms ease-in-out`;
        subtitle.style.transition = `opacity ${duration}ms ease-in-out`;
        title.style.transition = `opacity ${duration}ms ease-in-out`;
        description.style.transition = `opacity ${duration}ms ease-in-out`;
        buttonText.style.transition = `opacity ${duration}ms ease-in-out`;
        buttonLink.style.transition = `opacity ${duration}ms ease-in-out`;

        // Fade out all content
        section.style.opacity = 0;
        overlay.style.opacity = 0;
        subtitle.style.opacity = 0;
        title.style.opacity = 0;
        description.style.opacity = 0;
        buttonText.style.opacity = 0;
        buttonLink.style.opacity = 0;

        setTimeout(function () {
            // Update to next slide
            displaySlide(nextIndex);
            // Fade in new content
            section.style.opacity = 1;
            overlay.style.opacity = 0.8;
            subtitle.style.opacity = 1;
            title.style.opacity = 1;
            description.style.opacity = 1;
            buttonText.style.opacity = 1;
            buttonLink.style.opacity = 1;
            if (callback) callback();
        }, duration);
    }

    // Special quick cycle: first -> second -> first in rapid succession.
    function specialCycle() {
        // If there's only one slide, go back and forth between the first slide.
        if (slides.length === 1) {
            // Quick fade (200ms) to the first slide and then back to the first slide
            fadeOutIn(0, 0, function () {
                // fadeOutIn(0, 0, function () {
                //     // startNormalSlideshow();
                // });
            });
        } else {
            // If there are more than one slide, follow the normal quick cycle: first -> second -> first
            fadeOutIn(0, 1, function () {
                fadeOutIn(0, 0, function () {
                    currentIndex = 1;
                    startNormalSlideshow();
                });
            });
        }
    }


    // Normal slideshow fade function (using 1000ms fade duration)
    function normalFadeContent() {
        fadeOutIn(1000, currentIndex, function () {
            currentIndex = (currentIndex + 1) % slides.length;
        });
    }

    // Start normal slideshow using setInterval
    function startNormalSlideshow() {
        setInterval(normalFadeContent, 5000);
    }

    // 1. Immediately display the first slide (slide 0)
    displaySlide(0);
    // 2. After a very short delay, run the special cycle: first->second->first
    setTimeout(specialCycle, 100);

    // Remove the loading slide once content is ready.
    const loadingSlide = document.getElementById('loading-slide');
    if (loadingSlide) {
        loadingSlide.style.display = 'none';
    }
});

window.addEventListener("load", () => {
    const loader = document.getElementById("loading-slide");
    const content = document.getElementById("main-content");

    // Fade out the loader.
    loader.style.opacity = "0";
    loader.style.transition = "opacity 1s ease";

    // After fade-out, hide the loader and show the main content.
    setTimeout(() => {
        loader.style.display = "none";
        if (content) {
            content.style.display = "block";
        }
    }, 1000);
});
