function selView(n, litag) {
  var indexview = "none";
  var mapview = "none";
  var exportview = "none";
  switch(n) {
    case 1:
      indexview = "inline";
      break;
    case 2:
      mapview = "inline";
      break;
    case 3:
      exportview = "inline";
      break;   
      // add how many cases you need
    default:
      break;
  }

  document.getElementById("indextab").style.display = indexview;
  document.getElementById("maptab").style.display = mapview;
  document.getElementById("exporttab").style.display = exportview;
  var tabs = document.getElementById("tabs");
  var ca = Array.prototype.slice.call(tabs.querySelectorAll("li"));
  ca.map(function(elem) {
    elem.style.background="#F0F0F0";
    elem.style.borderBottom="1px solid #5B788C"
  });

  litag.style.borderBottom = "1px solid #ED8B00";
  litag.style.background = "#ED8B00";

}

function selInit() {
  var tabs = document.getElementById("tabs");
  var litag = tabs.querySelector("li");   // first li
  litag.style.borderBottom = "1px solid #ED8B00";
  litag.style.background = "#ED8B00";
}