let filterStudent = $('.filter-student')
let studentRowContainer = $('.student-row-container')
let studentTotal = $('.student-total')
let studentHeader = $('.student-header')

filteringStudent()

function filteringStudent() {
  filterStudent.change(function() {
    let url = new URL(window.location)
    url.searchParams.delete('page')
    url.searchParams.set('filter', filterStudent.val())
    window.history.pushState({}, '', url)

    $('.student-pagination').addClass('d-none')
    
    $.get(`/filtering_student/${$(this).val()}`, function(students) {
      let studentRowStack = ''
      let deleteMethod = `<?php echo json_encode({{ method_field('DELETE') }})?>`
      let csrf = `<?php echo json_encode({{ csrf_field() }})?>`

      studentHeader.html(students[0].classroom.name)
      students.forEach((student, i) => {
        studentRowStack += studentRow(student, i)
        studentTotal.html(i + 1)

        studentRowContainer.html(studentRowStack)
      })
    })
  })
}

function studentRow(student, i) {
  return `<tr>
            <td>
              <a href="/student/${student.slug}/edit" class="text-decoration-none text-dark">
                ${1 + i++}
              </a>
            </td>
            <td>
              <a href="/student/${student.slug}/edit" class="text-decoration-none text-dark">
                ${student.name}
              </a>
            </td>
            <td class="student-nis">
              <a href="/student/${student.slug}/edit" class="text-decoration-none text-dark">
                ${student.nis}
              </a>
            </td>
            <td class="student-class">
              <a href="/classroom/${student.classroom.slug}/edit" class="text-decoration-none text-dark">
                ${student.classroom.name}
              </a>
            </td>
          </tr>`
}