const slides = document.querySelectorAll(".slide");
let maxSlide = slides.length - 1;
let curSlide = 0;

slides.forEach((slide, index) => {
    slide.style.transform = `translateX(${index * 100}%)`;
});

let nextSlide = document.querySelector("#btn-next");

nextSlide.addEventListener("click", function () {
    if (curSlide === maxSlide) {
        curSlide = 0;
    } else {
        curSlide++;
    }

    slides.forEach((slide, index) => {
        slide.style.transform = `translateX(${100 * (index - curSlide)}%)`;
    });
});

const prevSlide = document.querySelector("#btn-prev");

prevSlide.addEventListener("click", function () {
    if (curSlide === 0) {
        curSlide = maxSlide;
    } else {
        curSlide--;
    }

    slides.forEach((slide, index) => {
        slide.style.transform = `translateX(${100 * (index - curSlide)}%)`;
    });
});