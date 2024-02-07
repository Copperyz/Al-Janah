/**
 *  Form Wizard
 */

'use strict';

// rateyo (jquery)
$(function () {
  var readOnlyRating = $('.read-only-ratings');

  // Star rating
  if (readOnlyRating) {
    readOnlyRating.rateYo({
      rtl: isRtl,
      padding: '0px',
      rating: 4,
      starWidth: '20px',
      spacing: '2px', // Spacing between the stars
      starSvg:
        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star-filled" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" stroke-width="0" /></svg>'
    });
  }
});

(function () {
  $('#applyCoupon').on('click', function () {
    var couponValue = $('input[name="couponCode"]').val();
    var shipmentAmount = deliveryCost;
    var totalItems = totalItemsPrice;
    $.ajax({
      url: './coupon-verified/' + couponValue,
      method: 'GET',
      data: { shipmentAmount: shipmentAmount },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response, status, xhr) {
        if (xhr.status === 200) {
          // Handle a successful response
          // console.log(response)
          $('.deliveryCost').each(function () {
            $(this).html(`<s class="text-muted">$${deliveryCost}</s>`);
          });
          if (response.shipmentDiscount == 0) {
            $('.deliveryAfterDiscount').html('<span class="badge bg-label-success ms-1">Free</span>');
          } else {
            $('.deliveryAfterDiscount').text('$' + response.shipmentDiscount);
          }
          // $('#totalAmount').text('$'+(totalItems + response.shipmentDiscount))
          $('.totalAmount').each(function () {
            $(this).text('$' + (totalItems + response.shipmentDiscount));
          });
          $('#applyCoupon').prop('disabled', true);
        } else {
          Swal.fire({
            title: 'dkdjfkjdfk',
            icon: 'error',
            confirmButtonText: doneTranslation,
            customClass: {
              confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
          });
        }
      },
      error: function (response, xhr, status, error) {
        // Handle the error response here
        if (response.responseJSON.message) {
          Swal.fire({
            title: response.responseJSON.message,
            icon: 'error',
            confirmButtonText: doneTranslation,
            customClass: {
              confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
          });
        } else {
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
      }
    });
  });
  // Init custom option check
  window.Helpers.initCustomOptionCheck();

  // libs
  const creditCardMask = document.querySelector('.credit-card-mask'),
    expiryDateMask = document.querySelector('.expiry-date-mask'),
    cvvMask = document.querySelector('.cvv-code-mask');

  // Credit Card
  if (creditCardMask) {
    new Cleave(creditCardMask, {
      creditCard: true,
      onCreditCardTypeChanged: function (type) {
        if (type != '' && type != 'unknown') {
          document.querySelector('.card-type').innerHTML =
            '<img src="' + assetsPath + 'img/icons/payments/' + type + '-cc.png" height="28"/>';
        } else {
          document.querySelector('.card-type').innerHTML = '';
        }
      }
    });
  }
  // Expiry Date Mask
  if (expiryDateMask) {
    new Cleave(expiryDateMask, {
      date: true,
      delimiter: '/',
      datePattern: ['m', 'y']
    });
  }

  // CVV
  if (cvvMask) {
    new Cleave(cvvMask, {
      numeral: true,
      numeralPositiveOnly: true
    });
  }

  // Wizard Checkout
  // --------------------------------------------------------------------

  const wizardCheckout = document.querySelector('#wizard-checkout');
  if (typeof wizardCheckout !== undefined && wizardCheckout !== null) {
    // Wizard form
    const wizardCheckoutForm = wizardCheckout.querySelector('#wizard-checkout-form');
    // Wizard steps
    const wizardCheckoutFormStep1 = wizardCheckoutForm.querySelector('#checkout-cart');
    const wizardCheckoutFormStep3 = wizardCheckoutForm.querySelector('#checkout-payment');
    // Wizard next prev button
    const wizardCheckoutNext = [].slice.call(wizardCheckoutForm.querySelectorAll('.btn-next'));
    const wizardCheckoutPrev = [].slice.call(wizardCheckoutForm.querySelectorAll('.btn-prev'));
    const wizardCheckoutSubmit = wizardCheckoutForm.querySelector('.btn-submit');
    console.log(wizardCheckoutSubmit);
    let validationStepper = new Stepper(wizardCheckout, {
      linear: false
    });

    // Cart
    

    // Payment
      if(wizardCheckoutNext){
        wizardCheckoutNext.forEach(item => {
          item.addEventListener('click', event => {
            // When click the Next button, we will validate the current step
            validationStepper.next();
            
          });
        });
      }
      if(wizardCheckoutPrev){
        wizardCheckoutPrev.forEach(item => {
          item.addEventListener('click', event => {
            // When click the Next button, we will validate the current step
            validationStepper.previous();
            
          });
        });
      }
      if(wizardCheckoutSubmit){
        wizardCheckoutSubmit.addEventListener('click', event =>{

          var form = $(wizardCheckoutSubmit).closest('form');
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
                    // }).then(result => {
                    //   if (result.isConfirmed) {
                    //     location.reload();
                    //     // $('#addPaymentForm').trigger('reset');
                    //   }
                    });
                  } else {
                    // Handle other status codes
                  }
                },
                error: function (response, xhr, status, error) {
                  // Handle the error response here
                  if (response.responseJSON.message) {
                    Swal.fire({
                      title: response.responseJSON.message,
                      icon: 'error',
                      confirmButtonText: doneTranslation,
                      customClass: {
                        confirmButton: 'btn btn-primary'
                      },
                      buttonsStyling: false
                    });
                  } else {
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
                }
              });
            }
          });
        })
            // When click the Next button, we will validate the current step
      }
      

    // wizardCheckoutNext.forEach(item => {
    //   item.addEventListener('click', event => {
    //     // When click the Next button, we will validate the current step
        
    //   });
    // });

    // wizardCheckoutPrev.forEach(item => {
    //   item.addEventListener('click', event => {
        
    //   });
    // });
  }
})();
