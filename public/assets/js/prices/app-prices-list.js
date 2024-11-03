/**
 * App trip routes List (jquery)
 */

'use strict';

$(function () {
    // Variable declaration for table
    var dt_prices_table = $('.trip-routes-list-table');

    // shipment routes datatable
    if (dt_prices_table.length) {
        var dt_prices = dt_prices_table.DataTable({
            processing: true,  // Show processing indicator
            serverSide: true,  // Enable server-side processing
            scrollY: '450px', // Set a fixed height for the DataTable
            scrollCollapse: false, // Allow table height to shrink if less data is available
            ajax: 'get-prices',
            columns: [
                // columns according to JSON
                { data: '' },
                { data: 'fromCountry' },
                { data: 'toCountry' },
                { data: 'goodType' },
                { data: 'price' },
                { data: 'options' }
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
                "emptyTable": noEntriesAvailableTranslation,
                "loadingRecords": '',
            },
            // Buttons with Dropdown
            buttons: [
                addButton
            ],
        });
    }

    // On each datatable draw, initialize tooltip
    dt_prices_table.on('draw.dt', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                boundary: document.body
            });
        });
    });

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


    $(document).on('click', 'a.editPrice', function () {
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
    $('.trip-routes-list-table tbody').on('click', '.delete-record', function () {
        var data = dt_prices.row($(this).closest('tr')).data();
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
                    url: './prices/' + data.id,
                    type: 'DELETE',

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        dt_prices.ajax.url('get-prices').load();
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


