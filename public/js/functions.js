var gLocale = 'en'
var gServiceId = -1
var gServiceName = ''

function drawServices (pServices) {
  gServiceId = -1
  gServiceName = ''
  var lTotal = pServices.total
  var lServiceStr = '<div class="row header">' +
      '<div class="col-xs-2"></div>' +
      '<div class="col-xs-3" style="font-weight:bold">Servicio</div>' +
      '<div class="col-xs-6" style="font-weight:bold">Descripcion</div>' +
    '</div>'

  var lStyle = 'oddRow'
  for (var i = 0; i < lTotal; i++) {
    lStyle = i % 2 ? 'oddRow' : 'evenRow'
    lServiceStr += '<div class="row ' + lStyle + '">' +
        '<div class="col-xs-1"></div>' +
        '<div class="col-xs-1"><i class="fa fa-arrow-circle-right campaign-list-info" onclick="drawService(' + pServices.data[i].id + ', \'' + pServices.data[i].name + '\');"></i></div>' +
        '<div class="col-xs-3">' + pServices.data[i].name + '</div>' +
        '<div class="col-xs-6"><p>' + pServices.data[i].description + '</p></div>' +
      '</div>'
  };

  $('#container').html(lServiceStr)
}

function drawService (pServiceId, pServiceName) {
  gServiceId = pServiceId
  gServiceName = pServiceName
  var lServiceStr = '<div class="row">' +
    '<div class="col-xs-1"></div>' +
    '<div class="col-xs-10 center"><h3>' + gServiceName + '</h3></div>' +
  '</div>' +
  '<div class="row">' +
    '<div class="col-xs-1"></div>' +
    '<div class="col-xs-10 center"><h5>Seleccione las fechas para buscar disponibilidad</h5></div>' +
  '</div>' +
  '<div class="row">' +
    '<div class="col-xs-2"></div>' +
    '<div class="col-xs-4 center bold">Fecha inicio</div>' +
    '<div class="col-xs-4 center bold">Fecha fin</div>' +
  '</div>' +
  '<div class="row">' +
    '<div class="col-xs-2"></div>' +
    '<div class="col-xs-4 center">' +
      '<div class="form-group">' +
        '<div class="input-group date" id="dtpFrom">' +
          '<input type="text" id="txtDateFrom" class="form-control" />' +
          '<span class="input-group-addon">' +
            '<span class="fa fa-calendar"></span>' +
          '</span>' +
        '</div>' +
      '</div>' +
    '</div>' +
    '<div class="col-xs-4 center">' +
      '<div class="form-group">' +
        '<div class="input-group date" id="dtpTo">' +
          '<input type="text" id="txtDateTo" class="form-control" />' +
          '<span class="input-group-addon">' +
            '<span class="fa fa-calendar"></span>' +
          '</span>' +
        '</div>' +
      '</div>' +
    '</div>' +
    '<div class="col-xs-1" id="btnBuscar">' +
      '<i class="fa fa-search fa-lg campaign-list-info" onclick="loadTimetable(' + gServiceId + ');"></i>' +
    '</div>' +
  '</div>'

  $('#container').html(lServiceStr)
  $('#dtpFrom').datetimepicker({
    format: 'DD/MM/YYYY',
    locale: gLocale
  })
  $('#dtpTo').datetimepicker({
    format: 'DD/MM/YYYY',
    locale: gLocale
  })
}

function drawTimetable (pTimetable) {
  var lTimetableStr = '<div class="row header">' +
      '<div class="col-xs-2"></div>' +
      '<div class="col-xs-3" style="font-weight:bold">Fecha</div>' +
      '<div class="col-xs-3" style="font-weight:bold">Inicio</div>' +
      '<div class="col-xs-3" style="font-weight:bold">Fin</div>' +
    '</div>'
  var lStyle = ''
  for (var i in pTimetable) {
    lStyle = pTimetable[i].booked ? 'booked' : 'available'
    lTimetableStr += '<div class="row ' + lStyle + '">'

    if (pTimetable[i].booked) {
      lTimetableStr += '<div class="col-xs-2"></div>'
    }
    else {
      lTimetableStr += '<div class="col-xs-1"></div>' +
        '<div class="col-xs-1"><i class="fa fa-arrow-circle-right campaign-list-info" onclick="alert(\'Reserva de servicio\')"></i></div>'
    }

    lTimetableStr += '<div class="col-xs-3">' + pTimetable[i].date + '</div>' +
        '<div class="col-xs-3">' + pTimetable[i].start + '</div>' +
        '<div class="col-xs-3">' + pTimetable[i].end + '</div>' +
      '</div>'
  }

  $('#container').html(lTimetableStr)
}

function loadTimetable() {
  var lFrom = $('#txtDateFrom').val().split('/')
  var lTo = $('#txtDateTo').val().split('/')

  var lDateFrom = new Date(lFrom[2], lFrom[1] - 1, lFrom[0])
  var lDateTo = new Date(lTo[2], lTo[1] - 1, lTo[0])

  if (!lDateFrom || !lDateTo || lDateFrom > lDateTo) {
    alert('Las fechas indicadas no son correctas')
  }
  else {
    getAvailableTimetableByHour (gServiceId, lDateFrom, lDateTo)
  }

  /*var date = new Date();
  date.yyyymmdd();*/
}

$(function () {
  $('.dropdown-menu a').click(function () {
    $('.btn.dropdown-toggle:first-child').text($(this).text())
    $('.btn.dropdown-toggle:first-child').val($(this).text())
    gLocale = $(this).attr('data-locale')
    getServices(gLocale)
  })
})
