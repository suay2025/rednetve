new Swiper('.cardO-wrapper', {
  // Optional parameters
  loop: true,
  slidesPerView:"auto",
  spaceBetween: 35,

  autoplay: {
      delay: 5000,
    },

  // pagination bullets
  pagination: {
    el: '.swiper-pagination',
    clickable:true,
    dynamicBullets: true
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // Responsive breakpoints
  breakpoints: {
      0: {
          slidesPerView: 1
      },
      768: {
          slidesPerView: 3
      },
      1024: {
          slidesPerView: 1
      },

  }

});