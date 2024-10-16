/**
 * App shipment List (jquery)
 */

'use strict';

$(function () {

    const date = document.querySelectorAll('.date-picker');



  // Datepicker
  if (date) {
    date.forEach(function (invoiceDateEl) {
      invoiceDateEl.flatpickr({
        enableTime: true,         // Enable time picker
        dateFormat: "Y-m-d H:i K", // Format for date and time (24-hour with AM/PM)
        time_24hr: false,         // Set to false to use 12-hour format with AM/PM
        monthSelectorType: 'static' // Static month dropdown
      });
    });
  }
  // Variable declaration for table
  var dt_trips_table = $('.trips-list-table');
  // trips datatable
  if (dt_trips_table.length) {
    var dt_trips = dt_trips_table.DataTable({
      ajax: 'get-trips',
      columns: [
        // columns according to JSON
        { data: 'tracking_no' },
        { data: 'shipmentsCount' },
        { data: 'status' },
        { data: 'departure_date' },
        { data: 'estimated_delivery_date' },
        { data: 'action' }
      ],
      columnDefs: [
        {
          // Actions
          targets: -1,
          searchable: false,
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<a href="./trips/' +
              full['id'] +
              '" class= "btn btn-sm btn-success me-2" > <i class="ti ti-eye ti-lg"></i></a > ' +
              '<span><button class="btn btn-sm btn-warning me-2 showTripShipment" data-bs-target="#showTripShipmentModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-package ti-lg"></i></button>' +
              '<span><button class="btn btn-sm btn-info me-2 editTrip" data-bs-target="#editTripModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-edit ti-lg"></i></button>' +
              '<span><button class="btn btn-sm btn-danger me-2 delete-record"><i class="ti ti-trash ti-lg"></i></button>'
            );
          }
        }
      ],
      order: [[1, 'desc']],
      dom:
        '<"row mx-1"' +
        '<"col-sm-12 col-md-3" l>' +
        '<"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>' +
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
      // Buttons with Dropdown
      buttons: [
        {
          text: `<i class="ti ti-plus ti-sm me-2"></i>${addTripTranslation}`, // Icon and text inside the button
          className: 'btn btn-primary text-white d-flex align-items-center mt-2 mb-2 addTrip', // Full button styling
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '#addTripModal'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ]
    });
  }

  // On each datatable draw, initialize tooltip
  dt_trips_table.on('draw.dt', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl, {
        boundary: document.body
      });
    });
  });

  $(document).on('click', 'button.addTrip', function () {
    // Store the default option value
    var defaultTripRouteId = $('#trip_route_id option:selected').val();
    var defaultCurrentStatus = $('#current_status option:selected').val();

    $('#addTripForm').trigger('reset');
    $('#trip_route_id').val(null).trigger('change');
    $('#current_status').val(null).trigger('change');

    // Set the default option back
    $('#trip_route_id').val(defaultTripRouteId).trigger('change');
    $('#current_status').val(defaultCurrentStatus).trigger('change');
  });

  $('#addTripForm').on('submit', function (event) {
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
          dt_trips.ajax.url('get-trips').load();
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
              $('#addTripForm').trigger('reset');
              $('#addTripModal').modal('hide');
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
      }
    });
  });

  $(document).on('click', 'button.editTrip', function () {
    $('#editTripForm').trigger('reset');
    var defaultTripRouteId = $('#edit_trip_route_id option:selected').val();
    var defaultCurrentStatus = $('#edit_current_status option:selected').val();

    $('#addTripForm').trigger('reset');
    $('#edit_trip_route_id').val(null).trigger('change');
    $('#edit_current_status').val(null).trigger('change');

    // Set the default option back
    $('#edit_trip_route_id').val(defaultTripRouteId).trigger('change');
    $('#edit_current_status').val(defaultCurrentStatus).trigger('change');

    var data = dt_trips.row($(this).closest('tr')).data();
    $('#editTripForm').find('[name="departure_date"]').val(data.departure_date);
    $('#editTripForm').find('[name="estimated_delivery_date"]').val(data.estimated_delivery_date);
    $('#editTripForm').find('[name="id"]').val(data.id);

    if (data.trip_route_id) $('#editTripForm').find('[name="trip_route_id"]').val(data.trip_route_id).trigger('change');
    if (data.current_status)
      $('#editTripForm').find('[name="current_status"]').val(data.current_status).trigger('change');
  });

  $('#editTripForm').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
      url: './trips/' + $('#editTripForm').find('[name="id"]').val(),
      method: 'PUT',
      data: $(this).serialize(),
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response, status, xhr) {
        if (xhr.status === 200) {
          // Handle a successful response
          dt_trips.ajax.url('get-trips').load();
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
              $('#editTripForm').trigger('reset');
              $('#editTripModal').modal('hide');
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
      }
    });
  });

  // Delete Record
  $('.trips-list-table tbody').on('click', '.delete-record', function () {
    var data = dt_trips.row($(this).closest('tr')).data();
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
        // Perform the deletion action here
        $.ajax({
          url: './trips/' + data.id,
          type: 'DELETE',

          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            dt_trips.ajax.url('get-trips').load();
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
              confirmButtonColor: '#dc3545'
            });
          }
        });
      }
    });
  });

  // Variable declaration for table
  var dt_shipment_table = $('.shipment-list-table');

  // shipment datatable
  if (dt_shipment_table.length) {

    var dt_shipment = dt_shipment_table.DataTable({
      select: {
        style: 'multi',
        selector: 'td:first-child input[type="checkbox"]'
      },
      columns: [
        // columns according to JSON
        { data: 'id' },
        { data: 'customerName' },
        { data: 'tracking_no' },
        { data: 'date' },
        { data: 'amount' }
      ],
      rowCallback: function (row, data) {
        if (data.selected == 1) {
          $('input.dt-checkboxes', row).prop('checked', true);
          $(row).addClass('selected');
        } else {
          $('input.dt-checkboxes', row).prop('checked', false);
          $(row).removeClass('selected');
        }
      },
      columnDefs: [
        {
          targets: 0,
          searchable: false,
          orderable: false,
          render: function () {
            return '<input type="checkbox" class="dt-checkboxes form-check-input">';
          }
        }
      ],
      order: [[1, 'desc']],
      dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      select: {
        // Select style
        style: 'multi'
      },
      language: {
        search: searchTranslation,
        lengthMenu: `${showTranslation} _MENU_`,
        info: ` ${showingTranslation} _START_ ${toTranslation} _END_ ${ofTranslation} _TOTAL_ ${entriesTranslation}`,
        paginate: {
          next: nextTranslation, // Change "Next" text
          previous: previousTranslation // Change "Previous" text
        },
        emptyTable: noEntriesAvailableTranslation,
        select: {
          rows: {
            _: `${rowSelectedTranslation} %d ${rows}`,
            1: onlyRow
          }
        }
      },
      // Buttons with Dropdown
      buttons: [
        {
          text: `<i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">${addTripTranslation}</span>`,
          className: 'add-new btn btn-primary mt-2 mb-2 addTrip',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '#addTripModal'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ]
    });
  }

  var selectedRows = [];

  // On each datatable draw, initialize tooltip
  dt_shipment_table.on('draw.dt', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl, {
        boundary: document.body
      });
    });
  });

  var selectedRows = []; // Declare selectedRows outside the event handler
  var deSelectedRows = []; // Declare deSelectedRows outside the event handler
  var selectedChangeType;
  // Event listener for the checkbox change
  dt_shipment.on('select', function (e, dt, type, indexes) {
    var selectedData = dt_shipment.rows(indexes).data().toArray();
    // Filter out rows that are already in selectedRows
    selectedData = selectedData.filter(row => !selectedRows.some(selectedRow => selectedRow.id === row.id));
    selectedRows.push(...selectedData);
  });

  dt_shipment.on('deselect', function (e, dt, type, indexes) {
    var deselectedData = dt_shipment.rows(indexes).data().toArray();
    // Display SweetAlert with a dropdown for choices
    const choices = [Detour, Complete];

    // Create a custom HTML content with radio buttons for choices
    const htmlContent = `
        <div style="display: flex; justify-content: space-around; margin: 1em 0;">
            ${choices
        .map(
          choice => `
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="radioOption" value="${choice}" id="radio_${choice}" ${choice == 'Detour' ? 'checked' : ''
            }>
                    <label class="form-check-label" for="radio_${choice}">${choice}</label>
                </div>
            `
        )
        .join('')}
        </div>
    `;

    // Display SweetAlert with custom HTML content
    Swal.fire({
      title: shipmentReasonTranslate,
      text: shipmentReasonTranslate,
      icon: 'warning',
      html: htmlContent,
      showCancelButton: true,
      confirmButtonText: submitTranslation,
      cancelButtonText: cancelTranslation,
      customClass: {
        confirmButton: 'btn btn-primary me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false,
      preConfirm: () => {
        // Return the selected value
        const selectedRadio = document.querySelector('input[name="radioOption"]:checked');
        return selectedRadio ? selectedRadio.value : '';
      }
    }).then(result => {
      if (result.isConfirmed) {
        selectedRows = selectedRows.filter(selectedRow => !deselectedData.some(row => row.id === selectedRow.id));
        deselectedData = deselectedData.filter(
          row => !deSelectedRows.some(deSelectedRow => deSelectedRow.id === row.id)
        );
        selectedChangeType = result.value;
        // Remove rows that are being deselected from selectedRows
        deSelectedRows.push(...deselectedData);
        // Continue with any additional logic or actions
      }
    });
  });

  $(document).on('click', 'button.showTripShipment', function () {
    var data = dt_trips.row($(this).closest('tr')).data();
    $('#id').val(data.id);

    // Reset selectedRows array
    selectedRows = [];

    dt_shipment.ajax.url('get-trip-shipments/' + data.id).load(function () {
      // Iterate over the rows and update selected rows
      dt_shipment.rows().every(function (index, element) {
        var rowData = this.data();

        if (rowData.selected == 1) {
          // Update selectedRows if the row is selected
          selectedRows.push(rowData);
        } else {
        }
      });
    });
  });

  // Event listener for the submit button
  $('#showTripShipmentModal').on('click', 'button.btn-primary', function () {
    $.ajax({
      url: './trip_shipments/' + $('#id').val(),
      method: 'PUT',
      data: { selectedRows, deSelectedRows, selectedChangeType },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response, status, xhr) {
        if (xhr.status === 200) {
          // Handle a successful response
          dt_trips.ajax.url('get-trips').load();
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
              $('#showTripShipmentModal').modal('hide');
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