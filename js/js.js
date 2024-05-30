var input = document.querySelector("#name");
input.addEventListener("keypress", function(e) {
    if(!checkChar(e)) {
      e.preventDefault();
  }
});
function checkChar(e) {
    var char = String.fromCharCode(e.keyCode);
  
 
    var pattern = '[0-9]';
    if (char.match(pattern)) {
      return true;
  }
}

var input = document.querySelector("#name2");
input.addEventListener("keypress", function(e) {
    if(!check(e)) {
      e.preventDefault();
  }
});

function check(e) {
    var char = String.fromCharCode(e.keyCode);
  
 
    var pattern = '[0-9- ]';
    if (char.match(pattern)) {
      return true;
  }
}
var input = document.querySelector("#name3");
input.addEventListener("keypress", function(e) {
    if(!checkar(e)) {
      e.preventDefault();
  }
});
function checkar(e) {
    var char = String.fromCharCode(e.keyCode);
  

    var pattern = '[a-z-A-Z-á-ú-Á-Ú-â-û-Â-Û-Ã-Õ-ã-õ- ]';
    if (char.match(pattern)) {
      return true;
  }
}

var input = document.querySelector("#name5");
input.addEventListener("keypress", function(e) {
    if(!checkar(e)) {
      e.preventDefault();
  }
});


var input = document.querySelector("#name0");
input.addEventListener("keypress", function(e) {
    if(!checkChar(e)) {
      e.preventDefault();
  }
});
