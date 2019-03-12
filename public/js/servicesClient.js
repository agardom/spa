var servicesUrl = 'http://localhost:8000/api/'

function getServices (pLocale) {
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: servicesUrl + 'services',
    headers: {
      'Accept': 'application/json',
      'X-localization': pLocale
    },
    success: function (pData) {
      drawServices(pData)
    },
    error: function (pRequest, pError) {
      console.log(arguments)
      alert('An error has ocurred getting services: ' + pError)
    }
  })
}

function formatDate (pDate) {
  var lMonth = '' + (pDate.getMonth() + 1)
  var lDay = '' + pDate.getDate()
  var lYear = pDate.getFullYear()

  if (lMonth.length < 2) lMonth = '0' + lMonth
  if (lDay.length < 2) lDay = '0' + lDay

  return [lYear, lMonth, lDay].join('')
}

function getAvailableTimetableByHour (pServiceId, pStartDate, pEndDate) {
  var lStartDate = formatDate(pStartDate)
  var lEndDate = formatDate(pEndDate)
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: servicesUrl + 'serviceAvailableTimetableByHour/' + pServiceId + '/' + lStartDate + '/' + lEndDate,
    headers: {
      'Accept': 'application/json'
    },
    success: function (data) {
      drawTimetable(data)
    },
    error: function (request, error) {
      console.log(arguments)
      alert('An error has ocurred getting bookings: ' + error)
    }
  })
}

function postBooking (pServiceId, pClient, pComments, pDatetime) {

  var lData = {
    'clientName': pClient,
    'comments': pComments,
    'date': pDatetime,
    'serviceId': pServiceId,
    'price': 0
  }

  $.ajax({
    type: 'POST',
    dataType: 'json',
    data: lData,
    url: servicesUrl + 'booking',
    headers: {
      'Accept': 'application/json'
    },
    success: function (pData) {
      alert('Servicio reservado correctamente')
    },
    error: function (pRequest, pError) {
      console.log(arguments)
      alert('Ha ocurrido un error al reservar el servicio: ' + pError)
    }
  })

}
