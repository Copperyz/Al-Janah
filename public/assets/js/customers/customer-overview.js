/**
 * Page Detail overview
 */

'use strict';

// Datatable (jquery)
$(function () {

  $("#editCustomerUserForm").on("submit", function (event) {
    event.preventDefault();
    // Get the serialized array
    var form = $(this);
    var url = form.attr('action');
    var formData = form.serialize();

    $.ajax({
        url: url,
        method: 'PUT',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response, status, xhr) {
            if (xhr.status === 200) {
                // Handle a successful response
                // dt_currencies.ajax.url('get-currencies').load();
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
                        $("#editCustomerUserForm").trigger('reset');
                        location.reload();
                        $('#editUser').modal('hide');
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
  $("#addNewAddressForm").on("submit", function (event) {
    event.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var formData = form.serialize();

    $.ajax({
        url: url,
        method: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response, status, xhr) {
            if (xhr.status === 200) {
                // Handle a successful response
                // dt_currencies.ajax.url('get-currencies').load();
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
                        $("#addNewAddress").trigger('reset');
                        // location.reload();
                        $('#addNewAddress').modal('hide');
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
  // change default address for a customer
  $(".changeDefaultAddressForm").on("submit", function (event) {
    event.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var formData = form.serialize();

    $.ajax({
        url: url,
        method: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response, status, xhr) {
            if (xhr.status === 200) {
                // Handle a successful response
                // dt_currencies.ajax.url('get-currencies').load();
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
                confirmButtonText: doneTranslation,
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        }
    });
  });
$('#countrySelect').on('change', function () {
  var countryId = $(this).val();
  $('#city').html('<option value="">Loading...</option>');

  if (countryId) {
      $.ajax({
          url: '/get-cities/' + countryId,
          type: 'GET',
          dataType: 'json',
          success: function (data) {
            console.log(data)
              $.each(data, function (index, city) {
                  $('#city').append('<option value="'+ city.id + '">' + city.name + '</option>');
              });
          },
          error: function () {
              alert('Error loading cities.');
          }
      });
  } else {
      $('#city').html('<option value="">Select City</option>');
  }
});
  const numeralMask = document.querySelector('.numeral-mask')
    //Numeral
    // if (numeralMask) {
    //     new Cleave(numeralMask, {
    //     numeral: true,
    //     numeralThousandsGroupStyle: 'thousand',
    // });
    // }

  const wizardIcons = document.querySelector('.wizard-modern-icons-example');

  if (typeof wizardIcons !== undefined && wizardIcons !== null) {
    const wizardIconsBtnNextList = [].slice.call(wizardIcons.querySelectorAll('.btn-next')),
      wizardIconsBtnPrevList = [].slice.call(wizardIcons.querySelectorAll('.btn-prev')),
      wizardIconsBtnSubmit = wizardIcons.querySelector('.btn-submit');

    const iconsStepper = new Stepper(wizardIcons, {
      linear: false
    });
    if (wizardIconsBtnNextList) {
      wizardIconsBtnNextList.forEach(wizardIconsBtnNext => {
        wizardIconsBtnNext.addEventListener('click', event => {
          iconsStepper.next();
        });
      });
    }
    if (wizardIconsBtnPrevList) {
      wizardIconsBtnPrevList.forEach(wizardIconsBtnPrev => {
        wizardIconsBtnPrev.addEventListener('click', event => {
          iconsStepper.previous();
        });
      });
    }
    if (wizardIconsBtnSubmit) {
      wizardIconsBtnSubmit.addEventListener('click', event => {
        alert('Submitted..!!');
      });
    }
  }

  // Variable declaration for table
  var dt_customer_order = $('.datatables-customer-shipments'),
    customer_shipments = baseUrl + 'customers-shipments/',
    statusObj = {
      Ready: { title: 'Ready to Pickup', class: 'bg-label-info' },
      Dispatched: { title: 'Dispatched', class: 'bg-label-warning' },
      Delivered: { title: 'Delivered', class: 'bg-label-success' },
      Out: { title: 'Out for delivery', class: 'bg-label-primary' }
    };
  var customerId = $('.datatables-customer-shipments').data('customer');
  // orders datatable
  if (dt_customer_order.length) {
    var dt_order = dt_customer_order.DataTable({
      ajax: customer_shipments + customerId, // JSON file to add data
      columns: [
        // columns according to JSON
        { data: '' },
        { data: 'tracking_no' },
        { data: 'current_status' },
        { data: 'amount' },
        { data: 'created_at' },
        { data: ' ' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          searchable: false,
          orderable: false,
          responsivePriority: 2,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          // order order number
          targets: 1,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $id = full['tracking_no'];

            return "<a href='" + customer_shipments + "' class='fw-medium'><span>#" + $id + '</span></a>';
          }
        },
        {
          // date
          targets: 4,
          render: function (data, type, full, meta) {
            var date = new Date(full.created_at); // convert the date string to a Date object
            var formattedDate = date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
            return '<span class="text-nowrap">' + formattedDate + '</span > ';
          }
        },
        {
          // status
          targets: 2,
          render: function (data, type, full, meta) {
            var $status = full['current_status'];
            return (
              '<span class="badge ' +
              statusObj[$status].class +
              '" text-capitalized>' +
              statusObj[$status].title +
              '</span>'
            );
          }
        },
        {
          // spent
          targets: 3,
          render: function (data, type, full, meta) {
            var $spent = full['amount'];

            return '<span >' + $spent + '</span>';
          }
        },
        {
          // Actions
          targets: -1,
          searchable: false,
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="text-xxl-center">' +
              '<button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>' +
              '<div class="dropdown-menu dropdown-menu-end m-0">' +
              '<a href="javascript:;" class="dropdown-item">View</a>' +
              '<a href="javascript:;" class="dropdown-item  delete-record">Delete</a>' +
              '</div>' +
              '</div>'
            );
          }
        }
      ],
      order: [[2, 'desc']],
      dom:
        '<"card-header flex-column flex-md-row py-2"<"head-label text-center pt-2 pt-md-0">f' +
        '>t' +
        '<"row mx-4"' +
        '<"col-md-12 col-xl-6 text-center text-xl-start pb-2 pb-lg-0 pe-0"i>' +
        '<"col-md-12 col-xl-6 d-flex justify-content-center justify-content-xl-end"p>' +
        '>',
      lengthMenu: [6, 30, 50, 70, 100],
      language: {
        search: searchTranslation,
        lengthMenu: `${showTranslation} _MENU_`,
        info: ` ${showingTranslation} _START_ ${toTranslation} _END_ ${ofTranslation} _TOTAL_ ${entriesTranslation}`,
        paginate: {
          next: nextTranslation, // Change "Next" text
          previous: previousTranslation // Change "Previous" text
        },
        emptyTable: noEntriesAvailableTranslation
      },
      // Buttons with Dropdown
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-label-secondary dropdown-toggle me-3',
          text: `<i class="ti ti-download me-1"></i>${exportTranslation}`,
          buttons: [
            {
              extend: 'print',
              text: '<i class="ti ti-printer me-2" ></i>Print',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6],
                // prevent avatar to be print
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('customer-name')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              },
              customize: function (win) {
                //customize print view for dark
                $(win.document.body)
                  .css('color', headingColor)
                  .css('border-color', borderColor)
                  .css('background-color', bodyBg);
                $(win.document.body)
                  .find('table')
                  .addClass('compact')
                  .css('color', 'inherit')
                  .css('border-color', 'inherit')
                  .css('background-color', 'inherit');
              }
            },
            {
              extend: 'csv',
              text: '<i class="ti ti-file me-2" ></i>Csv',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('customer-name')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            },
            {
              extend: 'excel',
              text: '<i class="ti ti-file-export me-2"></i>Excel',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('customer-name')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            },
            {
              extend: 'pdf',
              text: '<i class="ti ti-file-text me-2"></i>Pdf',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('customer-name')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            },
            {
              extend: 'copy',
              text: '<i class="ti ti-copy me-2" ></i>Copy',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('customer-name')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            }
          ]
        }
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['order'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIndex +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      }
    });
    $('div.head-label').html('<h5 class="card-title mb-0 text-nowrap">Shipments</h5>');
  }

  // Delete Record
  $('.datatables-orders tbody').on('click', '.delete-record', function () {
    dt_order.row($(this).parents('tr')).remove().draw();
  });

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});

let updateCustomerForm = document.getElementById('updateCustomerForm');
const submitButton = document.querySelector('button[type="submit"]');

// Validation & Phone mask
const fv = FormValidation.formValidation(updateCustomerForm, {
  fields: {
    currentPassword: {
      validators: {
        notEmpty: {
          message: window.translations.required.replace(':attribute', window.translations.attributes.currentPassword)
        }
      }
    },
    new_password: {
      validators: {
        notEmpty: {
          message: window.translations.required.replace(':attribute', window.translations.attributes.new_password)
        },
        stringLength: {
          min: 8,
          message: window.translations.min.numeric.replace(':attribute', window.translations.attributes.new_password).replace(':min', '8'),
        }
      }
    },
    new_password_confirmation: {
      validators: {
        notEmpty: {
          message: window.translations.required.replace(':attribute', window.translations.attributes.new_password_confirmation)
        },
        stringLength: {
          min: 8,
          message: window.translations.min.numeric.replace(':attribute', window.translations.attributes.new_password_confirmation).replace(':min', '8'),
        },
        identical: {
          compare: function () {
            return document.getElementById('new_password').value;
          },
          message: window.translations.confirmed.replace(':attribute', window.translations.attributes.new_password)
        }
      }
    },
  },
  plugins: {
    trigger: new FormValidation.plugins.Trigger(),
    bootstrap5: new FormValidation.plugins.Bootstrap5({
      // Use this for enabling/changing valid/invalid class
      eleValidClass: '',
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
  let form = $(updateCustomerForm);
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
            submitButton.removeAttribute('disabled');
            // location.reload();
            // $('#addNewUserForm').trigger('reset');
            $("#updateCustomerForm").trigger('reset');
            // dt_user.ajax.url('get-users').load();
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
