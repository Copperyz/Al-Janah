/**
 * Add Payment Offcanvas
 */

'use strict';

(function () {

  // Invoice amount
  const paymentAmount = document.querySelector('.invoice-amount');

  // Prefix
  if (paymentAmount) {
    new Cleave(paymentAmount, {
      numeral: true
    });
  }

  // Datepicker
  const date = new Date(),
    invoiceDateList = document.querySelectorAll('.invoice-date');

  if (invoiceDateList) {
    invoiceDateList.forEach(function (invoiceDateEl) {
      invoiceDateEl.flatpickr({
        monthSelectorType: 'static',
        defaultDate: date
      });
    });
  }

  var offcanvasAddPayment = new bootstrap.Offcanvas($('#addPaymentOffcanvas'));

  $("#addPaymentForm").on("submit", function (event) {
    event.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var method = form.attr('method');
    var formData = form.serialize();

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
            },
          }).then((result) => {
            if (result.isConfirmed) {
              offcanvasAddPayment.hide();
              // location.reload();
              $("#addPaymentForm").trigger('reset');
            }
          });
        }
        else {
          // Handle other status codes
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
  });
})();
