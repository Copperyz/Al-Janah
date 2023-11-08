/**
 * App Invoice List (jquery)
 */

'use strict';

$(function () {
  // Variable declaration for table
  var dt_invoice_table = $('.invoice-list-table');

  // Invoice datatable
  if (dt_invoice_table.length) {
    var dt_invoice = dt_invoice_table.DataTable({
      ajax: 'get-orders',
      columns: [
        // columns according to JSON
        { data: '' },
        { data: 'id' },
        { data: 'date' },
        { data: 'parcelName' },
        { data: 'amount' },
        { data: 'paymentStatus' },
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
        {
          // Invoice status
          targets: 5,
          render: function (data, type, full, meta) {
            var $invoice_status = full['paymentStatus'];
            var roleBadgeObj = {
              paid: '<span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30"><i class="ti ti-checks ti-sm"></i></span>',
              pending: '<span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30"><i class="ti ti-hourglass-empty mx-2 ti-sm"></i></span>',
              failed: '<span class="badge badge-center rounded-pill bg-label-danger w-px-30 h-px-30"><i class="ti ti-exclamation-circle ti-sm"></i></span>',
              refunded:
                '<span class="badge badge-center rounded-pill bg-label-info w-px-30 h-px-30"><i class="ti ti-receipt-refund ti-sm"></i></span>'
            };
            return (
              roleBadgeObj[$invoice_status] +
              '</span>'
            );
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
              '<a href="./orders/' + full['id'] + '" class= "text-body" > <i class="ti ti-eye mx-2 ti-sm"></i></a > ' +
              '<a href="./orders/' + full['id'] + '/edit" class="text-body editUser"><i class="ti ti-edit ti-sm me-2"></i></a>' +
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
        '<"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3"f<"invoice_status mb-3 mb-md-0">>' +
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
          text: `<i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">${addOrderTranslation}</span>`,
          className: 'btn btn-primary',
          action: function (e, dt, button, config) {
            window.location = './orders/create';
          }
        }
      ],
    });
  }

  // On each datatable draw, initialize tooltip
  dt_invoice_table.on('draw.dt', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl, {
        boundary: document.body
      });
    });
  });

  // Delete Record
  $('.invoice-list-table tbody').on('click', '.delete-record', function () {
    dt_invoice.row($(this).parents('tr')).remove().draw();
  });

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});
