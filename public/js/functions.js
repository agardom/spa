function getServices() {
  $('#bookings').hide();
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: 'http://localhost:8000/api/services',
    headers: {
      'Accept':'application/json',
      'X-localization':$('#selIdioma').val()
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

function getBookings() {
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: 'http://localhost:8000/api/bookings/3/20190210/20180215',
    headers: {
      'Accept':'application/json',
      'X-localization':$('#selIdioma').val()
    },
    success: function(data){
      drawAvailableBookings(data);
    },
    error: function (request, error) {
      console.log(arguments);
      alert('An error has ocurred getting bookings: ' + error);
    }
  });
}

function drawServices(services) {
  var total = services.total;
  var serviceStr = '';

  serviceStr += '<div class="row">' +
      '<div class="col-2"></div>' +
      '<div class="col-3" style="font-weight:bold">Servicio</div>' +
      '<div class="col-6" style="font-weight:bold">Descripcion</div>'+
    '</div>';

  for (var i = 0; i < total; i++) {
    serviceStr += '<div class="row">' +
        '<div class="col-1"></div>' +
        '<div class="col-1"><i class="fa fa-calendar-check campaign-list-info" onclick="selectService(' + services.data[i].id + ', \'' + services.data[i].name +'\');"></i></div>' +
        '<div class="col-3">' + services.data[i].name + '</div>' +
        '<div class="col-6"><p>' + services.data[i].description + '</p></div>' +
      '</div>'
  };

  $('#services').html(serviceStr);
  $('#services').show();
}

function selectService(serviceId, serviceName) {
  alert(serviceName);
  $('#serviceSelected').html('Seleccione las fechas entre las que desea buscar disponibilidad para ' + serviceName);
  $('#services').hide();
  $('#bookings').show();
}
