let date = $('.date-time-picker')

$(document).ready(function() {
  $('.date-time-picker').flatpickr({
    inline: true,
    prevArrow: "<span title=\"Previous month\">&laquo;</span>",
    nextArrow: "<span title=\"Next month\">&raquo;</span>",
    defaultDate: date.data('value')
  })
})

$('.date-time-picker').change(function() {
  $('.date-report').html($(this).val())
  $.get(`/getAttendanceReport/${$(this).data('classroom_id')}/${$(this).val()}`, function(reports) {
    if (reports.length == 0) {
      $('.row-container').html('<tr><th colspan="3">No Data</th></tr>')
    }

    let rowStack = ''
    let presentTotal = 0
    let permissionTotal = 0
    let notPresentTotal = 0
    let reportTotal = reports.length

    reports.forEach((report, i) => {
      rowStack += row(report, i)
      $('.row-container').html(rowStack)

      if (report.status == 'present') {
        presentTotal += 1
      } else if (report.status == 'permission') {
        permissionTotal += 1
      } else {
        notPresentTotal += 1
      }
    })

    $('.present-total').html(presentTotal)
    $('.permission-total').html(permissionTotal)
    $('.not-present-total').html(notPresentTotal)
    $('.report-total').html(reportTotal)
  })
})

$.get(`/getAttendanceReport/${date.data('classroom_id')}/${date.data('value')}`, function(reports) {
  $('.date-report').html(date.data('value'))

  if (reports.length == 0) {
    $('.row-container').html('<tr><th colspan="3">No Data</th></tr>')
  }

  let rowStack = ''
  let presentTotal = 0
  let permissionTotal = 0
  let notPresentTotal = 0
  let reportTotal = reports.length

  reports.forEach((report, i) => {
    rowStack += row(report, i)
    $('.row-container').html(rowStack)

    if (report.status == 'present') {
      presentTotal += 1
    } else if (report.status == 'permission') {
      permissionTotal += 1
    } else {
      notPresentTotal += 1
    }
  })

  $('.present-total').html(presentTotal)
  $('.permission-total').html(permissionTotal)
  $('.not-present-total').html(notPresentTotal)
  $('.report-total').html(reportTotal)
})

function row(report, i) {
  return `<tr>
            <td>${1 + i++}</td>
            <td>${report.student.name}</td>
            <td>${report.status}</td>
          </tr>`
}