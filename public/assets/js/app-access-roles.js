/**
 * App user list
 */

'use strict';

// Datatable (jquery)
$(function () {

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});

(function () {
  // On edit role click, update text
  var roleEditList = document.querySelectorAll('.role-edit-modal'),
    roleAdd = document.querySelector('.add-new-role'),
    roleTitle = document.querySelector('.role-title');

  roleAdd.onclick = function () {
    // roleTitle.innerHTML = 'Add Role'; // reset text
  };
  if (roleEditList) {
    roleEditList.forEach(function (roleEditEl) {
      roleEditEl.onclick = function () {
        // roleTitle.innerHTML = 'Edit Role'; // reset text
      };
    });
  }

  // If you have a submit button inside the form, you can bind the click event to it
  $("#addRoleForm :submit").on("click", function (event) {
    // Trigger the form submission when the button is clicked
    $(this).closest('form').submit();
  });


  $("#addRoleForm").on("submit", function (event) {
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
            confirmButtonText: continueTranslation,
            customClass: {
              confirmButton: 'btn btn-success'
            },
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
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
          confirmButtonText: continueTranslation,
          customClass: {
            confirmButton: 'btn btn-primary'
          },
          buttonsStyling: false
        });
      }
    });

  });

  $(document).on('click', 'a.editRole', function () {
    $("#editRoleForm").trigger('reset');

    var roleId = $(this).data('role-id');
    // AJAX call to get role details including permissions
    // Reference to the modal
    var editRoleModal = $('#editRoleModal');

    // Uncheck all checkboxes before updating
    editRoleModal.find('input[type="checkbox"]').prop('checked', false);
    $.ajax({
      url: './roles/' + roleId,
      method: 'GET',
      success: function (response) {

        // Fill the role name input
        editRoleModal.find('#name').val(response.role.name);

        // Iterate over permissions and check corresponding checkboxes
        $.each(response.role.permissions, function (index, permission) {
          var checkboxId = '#permission_' + permission.id;
          editRoleModal.find(checkboxId).prop('checked', true);
        });
        editRoleModal.find('[name="id"]').val(response.role.id);

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

  $('#editRoleForm').submit(function (event) {
    event.preventDefault(); // Prevent default form submission
    // Make an AJAX request
    $.ajax({
      url: 'roles/' + $('#editRoleForm').find('[name="id"]').val(),
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
          $("#editRoleForm").trigger('reset');
          // dt_user.ajax.url('get-users').load();
          Swal.fire({
            icon: 'success',
            title: '',
            text: response.message,
            confirmButtonText: continueTranslation,
            customClass: {
              confirmButton: 'btn btn-success'
            }
          });
          $('#editRoleModal').modal('hide');

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
})();
