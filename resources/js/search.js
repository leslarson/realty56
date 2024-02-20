
// Tom Select stuff
const cityzip = document.querySelector('#cityzip');
let newOption = document.createElement("option");
let cityziptscontrol = document.querySelector('#cityzip-ts-control');

$("#sort-by").on('change', function() {
    let params = buildQueryString();

    if (params.length == 1) {
        window.location.replace('/');
    } else {
        window.location.replace('/custom/' + params);
    }
});

$('.modal-footer button').on('click', function(event) {
    var theButton = $(event.target); // The clicked button
    
    $(this).closest('.modal').one('hidden.bs.modal', function() {
        if (theButton[0].id == "saveChanges") {

            let params = buildQueryString();

            if (params.length == 1) {
                window.location.replace('/');
            } else {
                window.location.replace('/custom/' + params);
            }
        }

    });
});

function buildQueryString() {

    // variable to hold the built-up query string
    let queryString = '?';

    if (Boolean(parseInt($("#mdl-price-0").val()) || parseInt($("#mdl-price-1").val()))) {
        queryString += "price=" + parseInt($("#mdl-price-0").val()) + "-" + parseInt($("#mdl-price-1").val());
    }
    if (Boolean(parseInt($("#mdl-beds-0").val()) || parseInt($("#mdl-beds-1").val()))) {
        queryString += ((queryString.slice(-1) == "?") ? "beds=" : "&beds=") + parseInt($("#mdl-beds-0").val()) + "-" + parseInt($("#mdl-beds-1").val());
    }
    if (Boolean(parseInt($("#mdl-baths-0").val()) || parseInt($("#mdl-baths-1").val()))) {
        queryString += ((queryString.slice(-1) == "?") ? "baths=" : "&baths=") + parseInt($("#mdl-baths-0").val()) + "-" + parseInt($("#mdl-baths-1").val());
    }
    if (Boolean(parseInt($("#mdl-sqft-0").val()) || parseInt($("#mdl-sqft-1").val()))) {
        queryString += ((queryString.slice(-1) == "?") ? "sqft=" : "&sqft=") + parseInt($("#mdl-sqft-0").val()) + "-" + parseInt($("#mdl-sqft-1").val());
    }
    if (Boolean(parseInt($("#mdl-lot-0").val()) || parseInt($("#mdl-lot-1").val()))) {
        queryString += ((queryString.slice(-1) == "?") ? "lot=" : "&lot=") + parseInt($("#mdl-lot-0").val()) + "-" + parseInt($("#mdl-lot-1").val());
    }

    // this adds to the query string if a previous "simple" search for city/zip was done
    if ($("#include-region").length > 0) {
        if ($("#include-region").prop('checked')) {
            let region = '';
            if ($.isNumeric($("#current-region").text())){
                region = "zip";
            } else {
                region = "city";
            }
            queryString += ((queryString.slice(-1) == "?") ? region + "=" : "&" + region + "=") + $("#current-region").text();
        }
    }

    // get setting of "sort listings" control
    if ($("#sort-by").val()) {
        queryString += ((queryString.slice(-1) == "?") ? "orderby=" : "&orderby=") + $("#sort-by").val();
    }

    return queryString;
}

function useSuggestion(selection) {
    if ($.isNumeric(selection)) {
        window.location.replace('/custom?zip='+selection);
    } else {
        window.location.replace('/custom?city='+selection);
    }
}

async function getCityData() {
    const response = await axios.get("/loadcity");
    const thisData = response.data;
    thisData.forEach(ele => {
        if (ele['address_city']) {
            newOption = document.createElement("option");
            newOption.innerHTML = ele['address_city'];
            cityzip.appendChild(newOption);
        }
    });

    getPostalData();
}

async function getPostalData() {
    const response = await axios.get("/loadpostal");
    const thisData = response.data;
    thisData.forEach(ele => {
        if (ele['address_postal_code']) {
            newOption = document.createElement("option");
            newOption.innerHTML = ele['address_postal_code'];
            cityzip.appendChild(newOption);
        }
    });
    
    // This is here so that by the time TomSelect gets created,
    // #cityzip has been fully populated with city/zip data
    new TomSelect("#cityzip", {
        create: false,
        openOnFocus: false,
        closeAfterSelect: true,
        maxItems: 1,
        maxOptions: 5,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    cityziptscontrol = document.querySelector('#cityzip-ts-control');

    $("#cityzip-ts-control").keyup(function() {
        if (this.value == '') {
            cityziptscontrol.dispatchEvent(new KeyboardEvent('keydown', { keyCode: 27 }));
        }
    });

    $("#cityzip").change(function() {
        if (this.value) {
            useSuggestion(this.value);
        }
    });
}

getCityData();
