/**
 * App eCommerce Add Product Script
 */
'use strict';

//Javascript to handle the e-commerce product add page

//Jquery to handle the e-commerce product add page

$(function () {
  // const completeRegisterForm = document.getElementById('completeRegisterForm');
  const submitButton = document.querySelector('button[type="submit"]');
  $('#completeRegisterForm').on('submit', function (event) {
      event.preventDefault();
      var form = $(this);
      var url = form.attr('action');
      var method = form.attr('method');
      var formData = form.serialize();
      
      submitButton.setAttribute('disabled', true);

    $.ajax({
      url: url,
      method: method,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response, status, xhr) {
        if (xhr.status === 200) {
          // Handle a successful response
          Swal.fire({
            title: '',
            text: response.message,
            icon: 'success',
            confirmButtonText: doneTranslation,
            customClass: {
              confirmButton: 'btn btn-success'
            }
          }).then(result => {
            if (result.isConfirmed) {
              // location.reload();
              form.trigger('reset');
              window.location.href = '../dashboard';
            }
          });
        }
      },
      error: function (response, xhr, status, error) {
        // Handle the error response here
        var errorMessages = Object.values(response.responseJSON.errors).flat();
        // Format error messages with line breaks
        var formattedErrorMessages = errorMessages.join('<br>'); // Join the error messages with <br> tags
        // Create the Swal alert
        Swal.fire({
          title: response.responseJSON.message,
          html: formattedErrorMessages,
          icon: 'error',
          confirmButtonText: doneTranslation,
          customClass: {
            confirmButton: 'btn btn-primary'
          },
          buttonsStyling: false
        });
        submitButton.removeAttribute('disabled');
      }
    });
  });
});
