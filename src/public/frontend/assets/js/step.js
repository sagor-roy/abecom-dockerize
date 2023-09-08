const secondPage = document.querySelector(".second-page");
const firstPage = document.querySelector(".first-page");
const loader = document.querySelector(".loader");
const firtNextBtn = document.querySelector(".nextBtn");
const submitBtn = document.querySelector(".Submit");
const prevBtnSec = document.querySelector(".prev-1");

const progressText = document.querySelectorAll(".step p");
const progressCheck = document.querySelectorAll(".step .check");
const bullet = document.querySelectorAll(".step");
const activebullet = document.querySelectorAll(".step .bullet");

let max = 2;
let current = 1;

//next button
firtNextBtn.addEventListener("click", function(){
	loader.style.display = "block";
	setTimeout(function(){ 
		firstPage.style.display = "none";
		secondPage.style.display = "block";
		loader.style.display = "none"; 
	}, 600);
	
	// bullet[ current - 1 ].classList.add("active");
	// progressCheck[ current - 1 ].classList.add("active");
	// progressText[ current - 1 ].classList.add("active");
	// current += 1; 
});

//next button

//prev button
prevBtnSec.addEventListener("click", function(){
	// slidePage.style.marginLeft = "0%";
	// bullet[ current - 2 ].classList.remove("active");
	// progressCheck[ current - 2 ].classList.remove("active");
	// progressText[ current - 2 ].classList.remove("active");
	// current -= 1; 
	loader.style.display = "block";
	setTimeout(function(){ 
		firstPage.style.display = "block";
		secondPage.style.display = "none";
		loader.style.display = "none";
	}, 600);
	
});

//prev button