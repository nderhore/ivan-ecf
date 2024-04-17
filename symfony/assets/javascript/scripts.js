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
let saleArticleFilters = document.getElementsByClassName('sale_article_filters')[0];

if (typeof saleArticleFilters !== 'undefined') {

  saleArticleFilters.addEventListener('keyup', filterAds, false);
  saleArticleFilters.addEventListener('click', filterAds, false);
  
  function filterAds() {
    console.log('test');
    console.log('test2');
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

let previousButton = document.getElementById('previous_button');
let nextButton = document.getElementById('next_button');
let carouselComment = document.getElementById('carousel_comment');
let carouselLastname = document.getElementById('carousel_lastname');

if (typeof previousButton !== 'undefined') {

  previousButton.addEventListener('click', ()=> {
    console.log("j'ai cliqué sur le bouton previous");
    console.log(carouselComment);
  });

  nextButton.addEventListener('click', ()=> {
    console.log("j'ai cliqué sur le bouton next");
    console.log(carouselLastname);
  });

}

/* Home page : Carousel of the opinions - START */