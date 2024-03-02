/**
 * App eCommerce Add Product Script
 */
'use strict';

//Javascript to handle the e-commerce product add page

//Jquery to handle the e-commerce product add page

$(function () {
  // Select2

  
  //For form validation
  const addCountryForm = document.getElementById('addCountryForm');
  const submitButton = document.querySelector('button[type="submit"]');
  let form = $(addCountryForm);
  // Add New customer Form Validation
  FormValidation.formValidation(addCountryForm, {
    fields: {
      countryd: {
        validators: {
          notEmpty: {
            message: window.translations.required.replace(':attribute', window.translations.attributes.country)
          },
          
        }
      },
      
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        // Use this for enabling/changing valid/invalid class
        eleValidClass: 'is-valid',
        rowSelector: function (field, ele) {
          // field is the field name & ele is the field element
          return '.mb-3';
        }
      }),
      submitButton: new FormValidation.plugins.SubmitButton(),
      // Submit the form when all fields are valid
      // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
      autoFocus: new FormValidation.plugins.AutoFocus()
    }
  }).on('core.form.valid', function () {
    // Send the form data to back-end
    // You need to grab the form data and create an Ajax request to send them
    submitButton.setAttribute('disabled', true);
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
            }
          }).then(result => {
            if (result.isConfirmed) {
              // location.reload();
              form.trigger('reset');
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
        submitButton.removeAttribute('disabled');
      }
    });
  });

  
});
