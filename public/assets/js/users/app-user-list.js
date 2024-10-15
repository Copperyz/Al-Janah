/**
 * Page User List
 */

'use strict';

// Datatable (jquery)
$(function () {


  var dt_user_table = $('.datatables-users');
  // statusObj = {
  //   1: { title: 'Pending', class: 'bg-label-warning' },
  //   2: { title: 'Active', class: 'bg-label-success' },
  //   3: { title: 'Inactive', class: 'bg-label-secondary' }
  // };

  // if (select2.length) {
  //   var $this = select2;
  //   $this.wrap('<div class="position-relative"></div>').select2({
  //     placeholder: 'Select Country',
  //     dropdownParent: $this.parent()
  //   });
  // }

  // Users datatable
  if (dt_user_table.length) {
    var dt_user = dt_user_table.DataTable({
      ajax: 'get-users', // JSON file to add data
      columns: [
        // columns according to JSON
        { data: '' },
        { data: 'name' },
        { data: 'email' },
        { data: 'roles[0].name' },
        { data: '' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          searchable: false,
          orderable: true,
          responsivePriority: 2,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          // For Responsive
          className: 'control',
          searchable: false,
          orderable: true,
          responsivePriority: 2,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          // Actions
          targets: -1,
          searchable: false,
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-flex align-items-center">' +
              '<a href="javascript:;" class="text-body editUser" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEditUser"><i class="ti ti-edit ti-sm me-2"></i></a>' +
              '<a href="javascript:;" class="text-body delete-record"><i class="ti ti-trash ti-sm mx-2"></i></a>' +
              '</div>'
            );
          }
        }
      ],
      order: [[1, 'desc']],
      dom:
        '<"row mx-1"' +
        '<"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-2"l<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3"B>>' +
        '<"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3"f<"order_status mb-3 mb-md-0">>' +
        '>t' +
        '<"row mx-2"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',

      "language": {
        "search": searchTranslation,
        "lengthMenu": `${showTranslation} _MENU_`,
        "info": ` ${showingTranslation} _START_ ${toTranslation} _END_ ${ofTranslation} _TOTAL_ ${entriesTranslation}`,
        "paginate": {
          "next": nextTranslation,      // Change "Next" text
          "previous": previousTranslation, // Change "Previous" text
        },
        "emptyTable": noEntriesAvailableTranslation
      },
      buttons: [
        {
          text: `<i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none"></span>`,
          className: 'btn btn-primary',
          action: function (e, dt, button, config) {
            window.location = './shipments/create';
          }
        }
      ]
  
      
    });
  }


  // If you have a submit button inside the form, you can bind the click event to it
  // $(".addNewUserForm :submit").on("click", function (event) {
  //   // Trigger the form submission when the button is clicked
  //   $(this).closest('form').submit();
  // });

  var offcanvasAddUser = new bootstrap.Offcanvas($('#offcanvasAddUser'));

  // $(".addNewUserForm").on("submit", function (event) {
  //   event.preventDefault();
  //   var form = $(this);
  //   var url = form.attr('action');
  //   var method = form.attr('method');
  //   var formData = form.serialize();

  //   $.ajax({
  //     url: url,
  //     method: method,
  //     data: formData,
  //     headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     },
  //     success: function (response, status, xhr) {
  //       if (xhr.status === 200) {
  //         // Handle a successful response
  //         Swal.fire({
  //           title: '',
  //           text: response.message,
  //           icon: 'success',
  //           confirmButtonText: doneTranslation,
  //           customClass: {
  //             confirmButton: 'btn btn-success'
  //           },
  //         }).then((result) => {
  //           if (result.isConfirmed) {
  //             offcanvasAddUser.hide();
  //             // location.reload();
  //             $("#addNewUserForm").trigger('reset');
  //             dt_user.ajax.url('get-users').load();
  //           }
  //         });
  //       }
  //       else {
  //         // Handle other status codes
  //       }
  //     },
  //     error: function (response, xhr, status, error) {
  //       // Handle the error response here
  //       var errorMessages = Object.values(response.responseJSON.errors).flat();
  //       // Format error messages with line breaks
  //       var formattedErrorMessages = errorMessages.join('<br>'); // Join the error messages with <br> tags
  //       // Create the Swal alert
  //       Swal.fire({
  //         title: response.responseJSON.message,
  //         html: formattedErrorMessages,
  //         icon: 'error',
  //         confirmButtonText: doneTranslation,
  //         customClass: {
  //           confirmButton: 'btn btn-primary'
  //         },
  //         buttonsStyling: false
  //       });
  //     }
  //   });

  // });

  $(document).on('click', 'a.editUser', function () {
    var data = dt_user.row($(this).closest('tr')).data();
    $('#editUserForm').trigger("reset");
    $('#editUserForm').find('[name="name"]').val(data.name);
    $('#editUserForm').find('[name="email"]').val(data.email);
    $('#editUserForm').find('[name="id"]').val(data.id);

    //     var permissionsValues = data.userPermissions;
    //     $('#permission_edit option').prop('selected', false); // Deselect all options
    //     permissionsValues.forEach(permissionValue => {
    //       $('#permission_edit option[value="' + permissionValue + '"]').prop('selected', true);
    //     });
    //     $('#permission_edit').trigger('change');
    //     var rolesValues = data.userRoles;
    //     $('#role_edit option').prop('selected', false); // Deselect all options
    //     rolesValues.forEach(roleValue => {
    //       $('#role_edit option[value="' + roleValue + '"]').prop('selected', true);
    //     });
    //     $('#role_edit').trigger('change');

    $('#editUserForm').find('[name="role"]').val(data.roles[0].name).prop('selected', true);
  });

  var offcanvasEditUser = new bootstrap.Offcanvas($('#offcanvasEditUser'));

  $('#editUserForm').submit(function (event) {
    event.preventDefault(); // Prevent default form submission
    // Make an AJAX request
    $.ajax({
      url: 'users/' + $('#editUserForm').find('[name="id"]').val(),
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
          offcanvasEditUser.hide();
          $("#editUserForm").trigger('reset');
          dt_user.ajax.url('get-users').load();
          Swal.fire({
            icon: 'success',
            title: '',
            text: response.message,
            confirmButtonText: doneTranslation,
            customClass: {
              confirmButton: 'btn btn-success'
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

  // Delete Record
  $('.datatables-users tbody').on('click', '.delete-record', function () {
    // dt_user.row($(this).parents('tr')).remove().draw();
    var data = dt_user.row($(this).closest('tr')).data();
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
          url: './users/' + data.id,
          type: 'DELETE',

          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            dt_user.ajax.url('get-users').load();
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
  const phoneMaskList = document.querySelectorAll('.phone-mask'),
    addNewUserForm = document.getElementById('addNewUserForm');

  // Phone Number
  if (phoneMaskList) {
    phoneMaskList.forEach(function (phoneMask) {
      new Cleave(phoneMask, {
        phone: true,
        phoneRegionCode: 'US'
      });
    });
  }
  const submitButton = document.querySelector('button[type="submit"]');

  // Add New User Form Validation
  FormValidation.formValidation(addNewUserForm, {
    fields: {
      name: {
        validators: {
          notEmpty: {
            message: window.translations.required.replace(':attribute', window.translations.attributes.name)
          }
        }
      },
      email: {
        validators: {
          notEmpty: {
            message: window.translations.required.replace(':attribute', window.translations.attributes.email)
          },
          emailAddress: {
            message: window.translations.email.replace(':attribute', window.translations.attributes.email)
          }
        }
      },

      password: {
        validators: {
          notEmpty: {
            message: window.translations.required.replace(':attribute', window.translations.attributes.password)
          },
          stringLength: {
            min: 8,
            message: window.translations.min.numeric.replace(':attribute', window.translations.attributes.password).replace(':min', '8'),
          },
          //   callback: {
          //     message: window.translations.min.numeric.replace(':attribute', window.translations.attributes.password).replace(':min', '8'),
          //     callback: function(input) {
          //       // Implement your custom password validation logic here
          //       // You can access the password value with input.value
          //       // Return true if the password is valid, false otherwise
          //       const password = input.value;
          //       // Add your password validation logic here
          //       // For example, checking if it has at least 8 characters
          //       return password.length >= 8;
          //     }
          // }
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
    let form = $(addNewUserForm);
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
              offcanvasAddUser.hide();
              // location.reload();
              $("#addNewUserForm").trigger('reset');
              dt_user.ajax.url('get-users').load();
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
        submitButton.removeAttribute('disabled');
      }
    });
  });
});

// Validation & Phone mask
