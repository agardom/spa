function getServices(locale) {
  alert('Entra en getServices');
  alert(locale);
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: 'http://localhost:8000/api/services',
    headers: {
      'Accept':'application/json',
      'X-localization':locale
    },
    success: function(data){
      drawServices(data);
    },
    error: function (request, error) {
      console.log(arguments);
      alert('An error has ocurred getting services: ' + error);
    }
  });
};

function getBookings(locale) {
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: 'http://localhost:8000/api/bookings/3/20190210/20180215',
    headers: {
      'Accept':'application/json',
      'X-localization':locale
    },
    success: function(data){
      drawBookings(data);
    },
    error: function (request, error) {
      console.log(arguments);
      alert('An error has ocurred getting bookings: ' + error);
    }
  });
}
