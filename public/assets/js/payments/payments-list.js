/**
 * App trip routes List (jquery)
 */

'use strict';

$(function () {
    var dt_payments_table = $('.payments-list-table');

    // shipments datatable
    if (dt_payments_table.length) {
        var dt_payments = dt_payments_table.DataTable({
            ajax: 'get-payments',
            columns: [
                // columns according to JSON
                { data: '' },
                { data: 'delivery_code' },
                { data: 'shipment_amount' },
                { data: 'order_amount' },
                { data: 'payment_method' },
                { data: 'date' },
                { data: 'statusCapped' },
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
                        if (full['status'] == 'paid') {
                            return (
                                '<div class="d-flex align-items-center">' +
                                '<a href="javascript:;" class="text-body refund-record"><i class="ti ti-receipt-refund ti-sm mx-2"></i></a>' +
                                '</div>'
                            );
                        }
                        return (
                            '<div class="d-flex align-items-center">' +
                            '<button class="btn btn-sm btn-primary me-2 refund-record"><i class="ti ti-reload"></i></button>' +
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
                            text: '<i class="ti ti-printer me-2"></i>Print',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                                format: {
                                    body: function (inner, colIdx, rowIdx) {
                                        // Handle custom formatting for table data
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function (index, item) {
                                            if (item.classList !== undefined && item.classList.contains('customer-name')) {
                                                result += item.lastChild.firstChild.textContent;
                                            } else if (item.innerText === undefined) {
                                                result += item.textContent;
                                            } else {
                                                result += item.innerText;
                                            }
                                        });
                                        return result;
                                    }
                                }
                            },
                            customize: function (win) {
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
                            text: '<i class="ti ti-file me-2"></i>Csv',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                                format: {
                                    body: function (inner, colIdx, rowIdx) {
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function (index, item) {
                                            if (item.classList !== undefined && item.classList.contains('customer-name')) {
                                                result += item.lastChild.firstChild.textContent;
                                            } else if (item.innerText === undefined) {
                                                result += item.textContent;
                                            } else {
                                                result += item.innerText;
                                            }
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
                                format: {
                                    body: function (inner, colIdx, rowIdx) {
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function (index, item) {
                                            if (item.classList !== undefined && item.classList.contains('customer-name')) {
                                                result += item.lastChild.firstChild.textContent;
                                            } else if (item.innerText === undefined) {
                                                result += item.textContent;
                                            } else {
                                                result += item.innerText;
                                            }
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
                                format: {
                                    body: function (inner, colIdx, rowIdx) {
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function (index, item) {
                                            if (item.classList !== undefined && item.classList.contains('customer-name')) {
                                                result += item.lastChild.firstChild.textContent;
                                            } else if (item.innerText === undefined) {
                                                result += item.textContent;
                                            } else {
                                                result += item.innerText;
                                            }
                                        });
                                        return result;
                                    }
                                }
                            }
                        },
                        {
                            extend: 'copy',
                            text: '<i class="ti ti-copy me-2"></i>Copy',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                                format: {
                                    body: function (inner, colIdx, rowIdx) {
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function (index, item) {
                                            if (item.classList !== undefined && item.classList.contains('customer-name')) {
                                                result += item.lastChild.firstChild.textContent;
                                            } else if (item.innerText === undefined) {
                                                result += item.textContent;
                                            } else {
                                                result += item.innerText;
                                            }
                                        });
                                        return result;
                                    }
                                }
                            }
                        }
                    ]
                }
            ]
        });
    }



    $(document).on('click', 'button.addTripRoute', function () {
        $("#addPriceForm").trigger('reset');
    });

    $("#addPriceForm").on("submit", function (event) {
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
                    dt_prices.ajax.url('get-prices').load();
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
                            $("#addPriceForm").trigger('reset');
                            $('#addPriceModal').modal('hide');
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


    $(document).on('click', 'button.editPrice', function () {
        $("#editPriceForm").trigger('reset');
        var data = dt_prices.row($(this).closest('tr')).data();
        $('#editPriceForm').find('[name="from_country_id"]').val(data.from_country_id).trigger('change');
        $('#editPriceForm').find('[name="to_country_id"]').val(data.to_country_id).trigger('change');
        $('#editPriceForm').find('[name="good_types_id"]').val(data.good_types_id).trigger('change');
        $('#editPriceForm').find('[name="price"]').val(data.price);
        $('#editPriceForm').find('[name="id"]').val(data.id);
    });

    $("#editPriceForm").on("submit", function (event) {
        event.preventDefault();
        // Get the serialized array
        var formData = $(this).serialize();

        $.ajax({
            url: './prices/' + $('#editPriceForm').find('[name="id"]').val(),
            method: 'PUT',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response, status, xhr) {
                if (xhr.status === 200) {
                    // Handle a successful response
                    dt_prices.ajax.url('get-prices').load();
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
                            $("#editPriceForm").trigger('reset');
                            $('#editPriceModal').modal('hide');
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

    // Delete Record
    $('.payments-list-table tbody').on('click', '.refund-record', function () {
        var data = dt_payments.row($(this).closest('tr')).data();
        Swal.fire({
            title: areYouSureTranslation,
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
                    url: './payments/refund/' + data.id,
                    type: 'get',

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        dt_payments.ajax.url('get-payments').load();
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


