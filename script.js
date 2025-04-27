const bar=document.getElementById('bar');
const close=document.getElementById('close');
const nav=document.getElementById('navbar');

if(bar){
    bar.addEventListener('click' ,() => {
        nav.classList.add('active');
    })
}
if(close){
    close.addEventListener('click' ,() => {
        nav.classList.remove('active');
    })
}

let slideIndex = 0;
const slidesContent = [
    { h4: "Special Offer", h1: "Huge Discounts", p: "Limited Time Only" },
    { h4: "New Arrivals", h1: "Explore Now", p: "Get the latest products" }
    // Add more objects for additional slides
];

showSlides();

function showSlides() {
    let slides = document.querySelectorAll('.slide');
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none';
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    slides[slideIndex - 1].style.display = 'block';

    // Update content for the current slide
    let currentContent = slidesContent[slideIndex - 1];
    let contentElements = slides[slideIndex - 1].querySelector('.content');
    contentElements.querySelector('h4').textContent = currentContent.h4;
    contentElements.querySelector('h1').textContent = currentContent.h1;
    contentElements.querySelector('p').textContent = currentContent.p;

    setTimeout(showSlides, 5000); // Change slide every 5 seconds
}
