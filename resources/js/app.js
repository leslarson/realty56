import './bootstrap';

$(document).ready(function(){

  $(".email-btn").click(function(e) {
    alert("If this were a real realty application, this would present an email form allowing you to contact the listing agent about this propertty");
    e.preventDefault();
  });

  $(".favback").click(function(e) {
    togglefavorite(this['id']);
    e.preventDefault();
  });

  $("#fav-icon").click(function() {
    showMyFavorites();
  });

  $(".modal-body select").on('change', function() {
    let opposite = $(this).attr('id').slice(0, $(this).attr('id').length-1) + (+ !parseInt($(this).attr('id').slice(-1)))
    let selector = parseInt($(this).attr('id').slice(-1));
    let selected = parseInt($(this).val());

    $("#"+opposite+" > option").each((index, element) => {
      let compared = parseInt(element.value);
      if (selector) {
        // Selecting a value on the right:
        // If the polled left 'compared' value is greater then the right 'selected' value 
        // AND the right 'selected' value is NOT the 'No Max' zero value
        // AND the left value is not the 'No Min' zero
        // then hide the left value
        // Otherwise, show the left polled value (option element)
        compared > selected && selected && compared ? element.style.display='none' : element.style.display='initial';
      } else {
        // Selecting a value on the left:
        // If the polled right 'compared' value is less then the left 'selected' value 
        // AND the right value is not the 'No Max' zero, then hide the right value
        // Otherwise, show the right polled value (option element)
        compared < selected && compared ? element.style.display='none' : element.style.display='initial';
      }
    });
  });

    getSearchPresets();
});

function getSearchPresets() {
  var urlParams = new URLSearchParams(window.location.search);
  const selects = ["price", "beds", "baths", "sqft", "lot"];
  selects.forEach((select) => {
    if (urlParams.has(select)) {
      setSelect(select, urlParams.get(select).split("-"));
    }
  });
}

function setSelect(select, values) {
  $("#mdl-"+select+"-0").val(values[0]).change();
  $("#mdl-"+select+"-1").val(values[1]).change();
}


// favId is the id of the heart symbol that was clicked
// The format is "fav-7479508684" as an example
async function togglefavorite(favId) {
  const response = await axios.post("/favorite", {"favId": favId});
  
  if (response.data[0] == "set") {
    $("#"+favId).removeClass("fa-regular");
    $("#"+favId).addClass("fa-solid");
  } else {
    $("#"+favId).addClass("fa-regular");
    $("#"+favId).removeClass("fa-solid");
  }

  // Change the appearance of the user's favorite icon in nav
  if(response.data[1] > 0) {
    $("#fav-icon").removeClass("fa-regular");
    $("#fav-icon").addClass("hand-pointer");
    $("#fav-icon").addClass("fa-solid");
  } else {
    $("#fav-icon").addClass("fa-regular");
    $("#fav-icon").removeClass("hand-pointer");
    $("#fav-icon").removeClass("fa-solid");
    window.location.replace('/');
  }
}

async function showMyFavorites() {
  if ($("#fav-icon").hasClass("fa-solid")) {
    window.location.replace('/favorites');
  }
}
