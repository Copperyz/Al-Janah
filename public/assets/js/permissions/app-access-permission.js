/**
 * App user list (jquery)
 */

'use strict';

$(function () {
  var dataTablePermissions = $('.datatables-permissions'),
  dt_permission;

// Initialize Users List DataTable
  if (dataTablePermissions.length) {
    dt_permission = dataTablePermissions.DataTable({
        ajax: 'get-permissions',
        processing: true,  // Show processing indicator
        serverSide: true,  // Enable server-side processing
        scrollY: '450px', // Set a fixed height for the DataTable
        scrollCollapse: false, // Allow table height to shrink if less data is available
        columns: [
            { data: null, orderable: false, searchable: false }, // Control column
            { data: 'name' },
            { data: 'carbonDate' },
            { data: 'options', orderable: false, searchable: false } // Actions column
        ],
        columnDefs: [
            {
                targets: 0, // Control column
                render: function () {
                    return ''; // Placeholder for control column
                }
            },
        ],
        order: [[1, 'asc']], // Default order by name
        dom: '<"row mx-1"<"col-sm-12 col-md-3" l><"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: {
            search: searchTranslation,
            lengthMenu: `${showTranslation} _MENU_`,
            info: `${showingTranslation} _START_ ${toTranslation} _END_ ${ofTranslation} _TOTAL_ ${entriesTranslation}`,
            paginate: {
                next: nextTranslation,
                previous: previousTranslation
            },
            emptyTable: noEntriesAvailableTranslation,
            loadingRecords: ''
        },
        buttons: [
            addButton
        ]
    });
  }


  // // If you have a submit button inside the form, you can bind the click event to it
  // $("#addPermissionForm :submit").on("click", function (event) {
  //   // Trigger the form submission when the button is clicked
  //   $(this).closest('form').submit();
  // });


  $("#addPermissionForm").on("submit", function (event) {
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
          dt_permission.ajax.url('get-permissions').load();
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
              $("#addPermissionForm").trigger('reset');
              $('#addPermissionModal').modal('hide');
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

  $(document).on('click', 'button.editPermission', function () {
    $("#editPermissionForm").trigger('reset');
    var data = dt_permission.row($(this).closest('tr')).data();
    $('#editPermissionForm').find('[name="name"]').val(data.name);
    $('#editPermissionForm').find('[name="id"]').val(data.id);
  });

  $('#editPermissionForm').submit(function (event) {
    event.preventDefault(); // Prevent default form submission
    // Make an AJAX request
    $.ajax({
      url: 'permissions/' + $('#editPermissionForm').find('[name="id"]').val(),
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
          $("#editPermissionForm").trigger('reset');
          dt_permission.ajax.url('get-permissions').load();
          Swal.fire({
            icon: 'success',
            title: '',
            text: response.message,
            confirmButtonText: doneTranslation,
            customClass: {
              confirmButton: 'btn btn-success'
            }
          });
          $('#editPermissionModal').modal('hide');

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

  // Delete Record
  $('.datatables-permissions tbody').on('click', '.delete-record', function () {
    var data = dt_permission.row($(this).closest('tr')).data();
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
    }).then((result) => {
      if (result.isConfirmed) {
        // Perform the deletion action here
        $.ajax({
          url: './permissions/' + data.id,
          type: 'DELETE',

          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            dt_permission.ajax.url('get-permissions').load();
            Swal.fire({
              icon: 'success',
              title: '',
              text: response.message,
              confirmButtonText: doneTranslation,
              customClass: {
                confirmButton: 'btn btn-success'
              }
            });
          },
          error: function (xhr, status, error) {
            Swal.fire({
              title: `{{ __('An error occurred while deleting.') }}`,
              text: `{{ __('This record cannot be deleted as it has related data associated with it.') }}`,
              icon: 'error',
              confirmButtonText: `{{ __('Back') }}`,
              confirmButtonColor: '#dc3545',
            });
          },
        });
      }
    });
  });

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});