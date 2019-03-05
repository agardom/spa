var locale = 'en';

function drawServices() {
  var total = services.total;
  var serviceStr = '';

  serviceStr += '<div class="row header">' +
      '<div class="col-2"></div>' +
      '<div class="col-3" style="font-weight:bold">Servicio</div>' +
      '<div class="col-6" style="font-weight:bold">Descripcion</div>'+
    '</div>';

  var style = "oddRow";
  for (var i = 0; i < total; i++) {
    style = i % 2 ? "oddRow" : "evenRow";
    serviceStr += '<div class="row ' + style + '">' +
        '<div class="col-1"></div>' +
        '<div class="col-1"><i class="fa fa-calendar-check campaign-list-info" onclick="selectService(' + services.data[i].id + ', \'' + services.data[i].name +'\');"></i></div>' +
        '<div class="col-3">' + services.data[i].name + '</div>' +
        '<div class="col-6"><p>' + services.data[i].description + '</p></div>' +
      '</div>'
  };

  $('#container').html(serviceStr);
}

function selectService(serviceId, serviceName) {
  alert(serviceName);
  $('#serviceSelected').html('Seleccione las fechas entre las que desea buscar disponibilidad para ' + serviceName);
}

$(function(){

    $(".dropdown-menu a").click(function(){

      $(".btn.dropdown-toggle:first-child").text($(this).text());
      $(".btn.dropdown-toggle:first-child").val($(this).text());

      locale = $(this).attr("data-locale");
      getServices(locale);
   });

});
