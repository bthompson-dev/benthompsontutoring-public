document.addEventListener("DOMContentLoaded", () => {
  let slides = document.querySelectorAll("#slider .slide");

  let currentSlide = 0;

  const nextButton = document.querySelector(".button-right");
  const prevButton = document.querySelector(".button-left");

  const nextSlide = () => {
    slides[currentSlide].className = "slide";
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].className = "slide showing";
  };

  const prevSlide = () => {
    slides[currentSlide].className = "slide";
    currentSlide = (currentSlide - 1) % slides.length;

    if (currentSlide == -1) {
      currentSlide = slides.length - 1;
    }

    slides[currentSlide].className = "slide showing";
  };

  nextButton.addEventListener("click", () => {
    nextSlide();
  });

  prevButton.addEventListener("click", () => {
    prevSlide();
  });

  setInterval(() => {
    nextSlide();
  }, 15000);
});
