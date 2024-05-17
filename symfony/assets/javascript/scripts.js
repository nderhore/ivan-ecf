/* Name of the page - START */

let currentPage = window.location.pathname

/* Name of the page - END */




/* Popup for the sources of the images in the footer - START */

let footerCourtesyButton = document.getElementById('footer_courtesy');
let footerCourtesyPopup = document.getElementById('footer_courtesy_popup');

footerCourtesyButton.addEventListener('click', ()=> {
  if(footerCourtesyPopup.classList.contains('invisible')) {
    footerCourtesyPopup.classList.replace('invisible', 'visible');
  } else {
    footerCourtesyPopup.classList.replace('visible', 'invisible');
  }
});

/* Popup for the sources of the images in the footer- END */


/* Sale page : filter of the ads - START */

if (currentPage == '/prestations/4') {

  let saleArticleFilters = document.getElementsByClassName('sale_article_filters')[0];

  saleArticleFilters.addEventListener('keyup', filterAds, false);
  saleArticleFilters.addEventListener('click', filterAds, false);
  
  function filterAds() {
    let carAds = document.getElementsByClassName('sale_article_car');
    let filterValue = [];
  
    // Put the filters values (min km, max km, min price, max price, min year, max year) in an array 
    for (let i = 0; i < 6; i++) {
      let filterInput = document.getElementsByTagName('input')[i];
      if (filterInput.value != '') {
        filterValue[i] = filterInput.value;
      } else {
        filterValue[i] = 0;
      }
    }
    
    for (let i = 0; i < carAds.length; i++) {
      // Remove the class invisible of all cars
      carAds[i].classList.remove('invisible');
  
      // Pick up the number of kilometer of the car
      let carAdKm = parseInt(carAds[i].getElementsByClassName('km')[0].innerText);
      // Pick up the price of the car
      let carAdPrice = parseInt(carAds[i].getElementsByClassName('price')[0].innerText);
      // Pick up the year of the car
      let carAdYear = parseInt(carAds[i].getElementsByClassName('year')[0].innerText);
  
      // Compare the filter values with the car values
      if ((filterValue[0] > carAdKm) || (filterValue[1] < carAdKm)
      || (filterValue[2] > carAdPrice) || (filterValue[3] < carAdPrice)
      || (filterValue[4] > carAdYear) || (filterValue[5] < carAdYear)) {
        carAds[i].classList.add('invisible');
      } else {
        carAds[i].classList.remove('invisible');
      }
    }
  };
}

/* Sale page : filter of the ads - END */


/* Home page : Carousel of the opinions - START */

if (currentPage == '/') {

  let previousButton = document.getElementById('previous_button');
  let nextButton = document.getElementById('next_button');
  
  let slides = document.querySelectorAll('.slide');
  
  let elementNumber = slides.length;
  let activeKey = 0;
  let nextKey = 0;

  displayCarousel(activeKey, elementNumber, slides);

  previousButton.addEventListener('click', ()=> {
    nextKey =  (activeKey - 1);
    if (nextKey > 0) 
    {
      activeKey = (activeKey - 1);
    } else
    {
      activeKey = (elementNumber - 1);
    }
    displayCarousel(activeKey, elementNumber, slides);
  });

  nextButton.addEventListener('click', ()=> {
    nextKey =  (activeKey + 1);
    if (nextKey < (elementNumber)) 
    {
      activeKey = (activeKey + 1);
    } else
    {
      activeKey = 0;
    }
    displayCarousel(activeKey, elementNumber, slides);
  });
}

function displayCarousel(activeKey, elementNumber, slides) {
  for (let i = 0; i < elementNumber; i++) {
    if (i == activeKey) {
      slides[i].classList.remove('invisible');
    }
    else
    {
      slides[i].classList.add('invisible');
    }
  };
}

/* Home page : Carousel of the opinions - START */