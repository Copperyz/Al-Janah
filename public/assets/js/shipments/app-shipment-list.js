/**
 * App shipments List (jquery)
 */

'use strict';

$(function () {
  // Variable declaration for table
  var dt_shipments_table = $('.shipment-list-table');
  // shipments datatable
  if (dt_shipments_table.length) {
    var dt_shipments = dt_shipments_table.DataTable({
      ajax: 'get-shipments',
      columns: [
        // columns according to JSON
        { data: '' },
        { data: 'customerName' },
        { data: 'tracking_no' },
        { data: 'delivery_code' },
        { data: 'date' },
        { data: 'totalAmount' },
        { data: 'paymentStatus' },
        { data: 'inventoryStatus' },
        { data: 'action' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          searchable: false,
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
              '<a href="./shipments/' + full['id'] + '" class="text-body me-2"> <i class="ti ti-eye ti-sm"></i></a>' +  // Add margin-right here
              '<a href="./shipments/' + full['id'] + '/edit" class="text-body me-2 editUser"><i class="ti ti-edit ti-sm"></i></a>' +  // Add margin-right here
              '<a href="javascript:;" class="text-body delete-record"><i class="ti ti-trash ti-sm"></i></a>' +
              '</div>'
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
          text: `<i class="ti ti-plus ti-sm me-2"></i>${addShipmentTranslation}`,
          className: 'btn btn-primary mt-2 mb-2',
          action: function (e, dt, button, config) {
            window.location = './shipments/create';
          }
        }
      ]
    });
  }

  // Hide add button for customers
  if (hideAddShipmentButton == true) {
    $(".dt-buttons").hide();
    $(".actionsTh").hide();
    dt_shipments.column(-1).visible(false);
  }

  // On each datatable draw, initialize tooltip
  dt_shipments_table.on('draw.dt', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl, {
        boundary: document.body
      });
    });
  });

  // Delete Record
  $('.shipment-list-table tbody').on('click', '.delete-record', function () {
    var data = dt_shipments.row($(this).closest('tr')).data();
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
          url: './shipments/' + data.id,
          type: 'DELETE',

          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            dt_shipments.ajax.url('get-shipments').load();
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
