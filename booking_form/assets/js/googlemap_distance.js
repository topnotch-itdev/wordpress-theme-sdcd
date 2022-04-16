
function getAddressBy(postcode) {
  const url = `https://maps.googleapis.com/maps/api/geocode/json?address=${postcode}&key=AIzaSyCz2aeNYAclxfxUfHOyyxuGKZ1nDO_Q-Aw`;

  return new Promise((resolve, reject) => {
      $.get(url, function (res) {
          if (res.status === "OK") {
              resolve(res.results[0]);
          } 
          reject("failed");
      });
  });
}


function getDistanceMatrix(origin, destination) {

  var distanceService = new google.maps.DistanceMatrixService();
  return new Promise((resolve, reject) => {
      distanceService.getDistanceMatrix({
          origins: [origin], 
          destinations: [destination],
          travelMode: google.maps.TravelMode.DRIVING,
          unitSystem: google.maps.UnitSystem.IMPERIAL, //use "IMPERIAL" for Miles, "METRIC" for KMs
          travelMode: 'DRIVING',
          // durationInTraffic: true,
          // avoidHighways: false,
          // avoidTolls: false
       },
       function (response, status) {
          if (status !== google.maps.DistanceMatrixStatus.OK) {
              reject("failed");
              console.log('Error:', status);
          } else {
              resolve(response);
          }
       });
  })
}


function initPlacesMap() {
  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(-33.8902, 151.1759),
      new google.maps.LatLng(-33.8474, 151.2631));
  const options = {
      bounds: defaultBounds
  };
  const firstAddress = document.getElementById("first_address");
  const secondAddress = document.getElementById("second_address");

  new google.maps.places.SearchBox(firstAddress, options);
  new google.maps.places.SearchBox(secondAddress, options);
  
  
  const intouchOrigin = document.getElementById("intouch_origin");
  const intouchDest = document.getElementById("intouch_dest");
  new google.maps.places.SearchBox(intouchOrigin, options);
  new google.maps.places.SearchBox(intouchDest, options);
}