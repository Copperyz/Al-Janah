
'use strict';

(function () {
  // If you have a submit button inside the form, you can bind the click event to it
  $('#addCashForm :submit').on('click', function (event) {
    // Trigger the form submission when the button is clicked
    $(this).closest('form').submit();
  });

  $('#addCashForm').on('submit', function (event) {
    event.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var method = form.attr('method');
    var formData = form.serialize();
    Swal.fire({
      title: areYouSureTranslation,
      text: areYouSureTextTranslation,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: submitTranslation,
      cancelButtonText: cancelTranslation,
      customClass: {
        confirmButton: 'btn btn-primary me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(result => {
      if (result.isConfirmed) {
        $.ajax({
          url: url,
          method: method,
          data: formData,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response, status, xhr) {
            if (xhr.status === 200) {
                console.log(response);
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
                  location.reload();
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
          }
        });
      }
    });
  });
  $('#addCouponForm :submit').on('click', function (event) {
    // Trigger the form submission when the button is clicked
    $(this).closest('form').submit();
  });
  $('#addCouponForm').on('submit', function (event) {
    event.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var method = form.attr('method');
    var formData = form.serialize();
    Swal.fire({
      title: areYouSureTranslation,
      text: areYouSureTextTranslation,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: submitTranslation,
      cancelButtonText: cancelTranslation,
      customClass: {
        confirmButton: 'btn btn-primary me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(result => {
      if (result.isConfirmed) {
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
                  location.reload();
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
          }
        });
      }
    });
  });
})();
