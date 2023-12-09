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
        { data: 'id' },
        { data: 'customerName' },
        { data: 'tracking_no' },
        { data: 'date' },
        { data: 'amount' },
        // { data: 'paymentStatus' },
        { data: 'action' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          responsivePriority: 2,
          searchable: false,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        // {
        //   // order status
        //   targets: 4,
        //   render: function (data, type, full, meta) {
        //     var $order_status = full['paymentStatus'];
        //     var roleBadgeObj = {
        //       paid: '<span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30"><i class="ti ti-checks ti-sm"></i></span>',
        //       pending: '<span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30"><i class="ti ti-hourglass-empty mx-2 ti-sm"></i></span>',
        //       failed: '<span class="badge badge-center rounded-pill bg-label-danger w-px-30 h-px-30"><i class="ti ti-exclamation-circle ti-sm"></i></span>',
        //       refunded:
        //         '<span class="badge badge-center rounded-pill bg-label-info w-px-30 h-px-30"><i class="ti ti-receipt-refund ti-sm"></i></span>'
        //     };
        //     return (
        //       roleBadgeObj[$order_status] +
        //       '</span>'
        //     );
        //   }
        // },

        {
          // Actions
          targets: -1,
          searchable: false,
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-flex align-items-center">' +
              '<a href="./shipments/' +
              full['id'] +
              '" class= "text-body" > <i class="ti ti-eye mx-2 ti-sm"></i></a > ' +
              '<a href="./shipments/' +
              full['id'] +
              '/edit" class="text-body editUser"><i class="ti ti-edit ti-sm me-2"></i></a>' +
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
          text: `<i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">${addShipmentTranslation}</span>`,
          className: 'btn btn-primary',
          action: function (e, dt, button, config) {
            window.location = './shipments/create';
          }
        }
      ]
    });
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
