"use strict";
// sweat alert 
const toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

// Sticky menu
window.addEventListener("scroll", () => {
  const navBar = document.querySelector(".navBar")
  if (window.scrollY > 200) {
    navBar.classList.add("sticky");
  } else {
    navBar.classList.remove("sticky");
  }
})

// Back to Top 
function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  })
}

// Add Bottom Right
const AddBottomLeft = document.querySelector(".add-bottom-left");
const removeAdd = document.querySelector(".add-bottom-left-remove");
if(removeAdd){
  removeAdd.addEventListener("click", () => {
    AddBottomLeft.classList.add("removeAdd");
  });
}


// User Dropdown  
const user = document.querySelector(".user");
const userDropdown = document.querySelector(".user-dropdown");

if (user) {
  user.addEventListener("click", () => {
    userDropdown.classList.toggle("openDropdown");
  })
}

// Blog Banner slider
var swiper = new Swiper(".blog-banner", {
  slidesPerView: "auto",
  slidesPerView: 1,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    dynamicBullets: true,
    clickable: true,
    renderBullet: function (index, className) {
      return '<span class="' + className + '">' + (index + 1) + "</span>";
    },
  },
});


// Cookise
const hideCookie = (route) => {
  const Cookise = document.querySelector(".cookies-content");
  Cookise.classList.add("hide");
  hideCookieViaAjax(route)
};



// New Select

// CopyRight
const year = document.querySelector("#current_year");
year.innerHTML = new Date().getFullYear();









// Review 
let rateBox = Array.from(document.querySelectorAll(".rate-box"));
let globalValue = document.querySelector(".global-value");
let two = document.querySelector(".two");
let totalReviews = document.querySelector(".total-reviews");
let reviews = {
  5: 500000,
  4: 400000,
  3: 30000,
  2: 10000,
  1: 1000,
};
updateValues();

function updateValues() {
  rateBox.forEach((box) => {
    let valueBox = rateBox[rateBox.indexOf(box)].querySelector(".value");
    let countBox = rateBox[rateBox.indexOf(box)].querySelector(".count");
    let progress = rateBox[rateBox.indexOf(box)].querySelector(".progress");
    console.log(typeof reviews[valueBox.innerHTML]);
    countBox.innerHTML = nFormat(reviews[valueBox.innerHTML]);

    let progressValue = Math.round(
      (reviews[valueBox.innerHTML] / getTotal(reviews)) * 100
    );
    progress.style.width = `${progressValue}%`;
  });
  totalReviews.innerHTML = getTotal(reviews);
  finalRating();
}
function getTotal(reviews) {
  return Object.values(reviews).reduce((a, b) => a + b);
}

document.querySelectorAll(".value").forEach((element) => {
  element.addEventListener("click", () => {
    let target = element.innerHTML;
    reviews[target] += 1;
    updateValues();
  });
});

function finalRating() {
  let final = Object.entries(reviews)
    .map((val) => val[0] * val[1])
    .reduce((a, b) => a + b);
  let ratingValue = nFormat(parseFloat(final / getTotal(reviews)).toFixed(1));
  globalValue.innerHTML = ratingValue;
  // two.style.background = `linear-gradient(to right, #fea34c ${
  //   (ratingValue / 5) * 100
  // }%, #cfd8dc 100%)`;
}

function nFormat(number) {
  if (number >= 1000 && number < 1000000) {
    return `${number.toString().slice(0, -3)}k`;
  } else if (number >= 1000000 && number < 1000000000) {
    return `${number.toString().slice(0, -6)}m`;
  } else if (number >= 1000000000) {
    return `${number.toString().slice(0, -9)}md`;
  } else if (number === "NaN") {
    return `0.0`;
  } else {
    return number;
  }
}





//custom js start
function hideCookieViaAjax(routeName) {
  const data = {
    'hide-cookie': 'hide'
  };
  $.ajax({
    method: 'post',
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    url: routeName,
    data: {
      data
    },
    dataType: 'json'

  }).then(response =>{
    $('.cookies').hide()
  });
}

//single image preview js
const imagePreview = (file, id, className = 'preview-image') => {
  $(`#${id}`).append(
      `<img alt='${file.type}'class='mt-2 ${className} img-thumbnail me-2 f-left' src='${URL.createObjectURL(file)}'>`
  );
}
//empty ionput filed js
const emptyInputFiled = id => {
$(`#${id}`).html('');
}


//custom js end