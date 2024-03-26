
'use strict';

$(function () {
  // Select2
  const submitButton = document.querySelector('button[type="submit"]');

  $('#addParcelTypeForm :submit').on('click', function (event) {
    // Trigger the form submission when the button is clicked
    $(this).closest('form').submit();
  });

  $('#addParcelTypeForm').on('submit', function (event) {
    event.preventDefault();
    submitButton.setAttribute('disabled', true);
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

  $(document).on('click', 'a.editParcelType', function () {
    $("#editParcelTypeForm").trigger('reset');

    var parcelTypeId = $(this).data('type-id');
    // Reference to the modal
    var editParcelTypeModal = $('#editParcelTypeModal');

    // Uncheck all checkboxes before updating
    $.ajax({
      url: './parcel_types/' + parcelTypeId,
      method: 'GET',
      success: function (response) {

        editParcelTypeModal.find('#edit_name').val(response.parcelType.name);
        editParcelTypeModal.find('[name="id"]').val(response.parcelType.id);

      },
      error: function (error) {
        // handle errors
        console.error(error);
      }
    });
    // var data = dt_user.row($(this).closest('tr')).data();
    // $('#editUserForm').trigger("reset");
    // $('#editUserForm').find('[name="name"]').val(data.name);
    // $('#editUserForm').find('[name="email"]').val(data.email);
    // $('#editUserForm').find('[name="id"]').val(data.id);
  });

  $('#editParcelTypeForm').submit(function (event) {
    event.preventDefault(); // Prevent default form submission
    // Make an AJAX request
    $.ajax({
      url: 'parcel_types/' + $('#editParcelTypeForm').find('[name="id"]').val(),
      method: 'PUT',
      data: $(this).serialize(),
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'json',
      processData: false,
      success: function (response, status, xhr) {
        if (xhr.status === 200) {
          // Handle a successful response
          // offcanvasEditUser.hide();
          $("#editParcelTypeForm").trigger('reset');
          // dt_user.ajax.url('get-users').load();
          $('#editParcelTypeModal').modal('hide');

          Swal.fire({
            icon: 'success',
            title: '',
            text: response.message,
            confirmButtonText: doneTranslation,
            customClass: {
                confirmButton: 'btn btn-success'
            },
            allowOutsideClick: false  // This prevents the user from clicking outside the modal
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload(); // Reload the page
            }
        });
        
        

        } else {
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
          customClass: {
            confirmButton: 'btn btn-primary'
          },
          buttonsStyling: false
        });
      }
    });
  });
  
});
