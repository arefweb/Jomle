/*
 * Jomle Plugin scripts
 */


let x = document.querySelectorAll(".jomle-settings");
for(i=1 ; i<x.length ; i++){
  x[i].style.display = "none";
}
/* Tab toggle */
function tabToggle(){
  let x = document.querySelectorAll(".jomle-settings");
  let y = document.getElementsByClassName("nav-tab-link-active");
  // with each click 'display = none' all last <a> elements
  for(i=0 ; i<x.length ; i++){
    x[i].style.display = "none";
  }
  for(i=0 ; i<y.length ; i++){
    y[i].classList.remove("nav-tab-link-active");
  }
  this.classList.add("nav-tab-link-active");
  // then 'display = block' the clicked element <div>(event target href = id)
  let id = this.href.split('#')[1] ;
  document.getElementById(id).style.display = "block";
}

function eventListenerList(elems, event, tabToggle) {
  for (var i = 0 ; i < elems.length ; i++) {
    elems[i].addEventListener(event, tabToggle);
  }
}

var elems = document.querySelectorAll('a.nav-tab-link');
eventListenerList(elems, 'click', tabToggle);

