const createAccountToo = $('#createAccountToo')
const createAccount = $('.create-account')

$('.user-email').val($('.email').val())
$('.email').keyup(() => $('.user-email').val($('.email').val()))

if ($('.class-name').html() != '...') {
  $('.release-btn').removeClass('d-none')
}


createAccountToo.change(function() {
  if ($(this)[0].checked) {
    createAccount.css('display', 'block')
  } else {
    createAccount.css('display', 'none')
  }
})

if (createAccountToo[0].checked) {
  createAccount.css('display', 'block')
}
