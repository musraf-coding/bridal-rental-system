let currentIndex = 0;

function moveSlide(direction) {
    const slides = document.querySelector('.slides');
    const totalSlides = document.querySelectorAll('.slide').length;

    // Update current index
    currentIndex += direction;

    // Wrap around if out of bounds
    if (currentIndex < 0) {
        currentIndex = totalSlides - 1;
    } else if (currentIndex >= totalSlides) {
        currentIndex = 0;
    }

    // Move slides
    slides.style.transform = `translateX(-${currentIndex * 100}%)`;
}

// Auto slide every 5 seconds
setInterval(() => moveSlide(1), 5000);


document.addEventListener("DOMContentLoaded", () => {
    const loadingScreen = document.getElementById("loading");

    // Hide the loader after the page is fully loaded
    setTimeout(() => {
        loadingScreen.classList.add("hidden");
    }, 1000); // Adjust the timeout if needed
});

// Function to show the loader when redirecting to another page
function redirectWithLoader(url) {
    const loadingScreen = document.getElementById("loading");

    // Show the loader
    loadingScreen.classList.remove("hidden");

    // Redirect after a short delay to show the loader
    setTimeout(() => {
        window.location.href = url;
    }, 500);
}

function toggleMenu() {
 const nav = document.querySelector('header nav');
 const content = document.querySelector('.content');
 
 nav.classList.toggle('active');
 
 if (nav.classList.contains('active')) {
     content.style.marginTop = '100px'; // Adjust based on the navbar height
 } else {
     content.style.marginTop = '0';
 }
}

document.addEventListener('click', (event) => {
 const nav = document.querySelector('header nav');
 const menuIcon = document.querySelector('.menu-icon');
 const content = document.querySelector('.content');
 
 if (!nav.contains(event.target) && !menuIcon.contains(event.target)) {
     nav.classList.remove('active');
     content.style.marginTop = '0';
 }
});


    
