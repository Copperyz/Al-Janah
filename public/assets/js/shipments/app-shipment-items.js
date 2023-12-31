/**
 * App Invoice List (jquery)
 */

'use strict';

$(function () {
    // Variable declaration for table
    var dt_shipmentItems_table = $('.shipment-items-table');

    // Invoice datatable
    if (dt_shipmentItems_table.length) {
        var dt_shipmentItems = dt_shipmentItems_table.DataTable({
            ajax: urlStart + 'get-shipmentItems/' + shipmentId,
            columns: [
                // columns according to JSON
                { data: '' },
                { data: 'goodTypeName' },
                { data: 'parcelTypeName' },
                { data: 'quantity' },
                { data: 'height' },
                { data: 'width' },
                { data: 'weight' },
                { data: 'price' },
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
                    // Actions
                    targets: -1,
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="d-flex align-items-center">' +
                            '<a href="./shipments/' + full['id'] + '" class= "text-body" > <i class="ti ti-eye mx-2 ti-sm"></i></a > ' +
                            '<a class="text-body editShipmentItem" data-bs-target="#editShipmentItemModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-edit ti-sm me-2"></i></a>' +
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
                    text: `<i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">${addItemTranslation}</span>`,
                    className: 'btn btn-primary',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#addShipmentItemModal'
                    },
                }
            ],
        });
    }

    // On each datatable draw, initialize tooltip
    dt_shipmentItems_table.on('draw.dt', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                boundary: document.body
            });
        });
    });


    $("#addShipmentItemForm").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: urlStart + 'add-shipmentItem/' + shipmentId,
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response, status, xhr) {
                if (xhr.status === 200) {
                    // Handle a successful response
                    dt_shipmentItems.ajax.url(urlStart + 'get-shipmentItems/' + shipmentId).load();
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
                            $("#addShipmentItemForm").trigger('reset');
                            $('#addShipmentItemModal').modal('hide');
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

    $(document).on('click', 'a.editShipmentItem', function () {
        $("#editShipmentItemForm").trigger('reset');
        var data = dt_shipmentItems.row($(this).closest('tr')).data();
        $('#editShipmentItemForm').find('[name="name"]').val(data.name);
        $('#editShipmentItemForm').find('[name="price"]').val(data.price);
        $('#editShipmentItemForm').find('[name="height"]').val(data.height);
        $('#editShipmentItemForm').find('[name="width"]').val(data.width);
        $('#editShipmentItemForm').find('[name="weight"]').val(data.weight);
        $('#editShipmentItemForm').find('[name="quantity"]').val(data.quantity);
        $('#editShipmentItemForm').find('[name="good_types_id"]').val(data.good_types_id).trigger('change');
        $('#editShipmentItemForm').find('[name="parcel_types_id"]').val(data.parcel_types_id).trigger('change');
        $('#editShipmentItemForm').find('[name="id"]').val(data.id);

    });

    $('#editShipmentItemForm').submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        // Make an AJAX request
        $.ajax({
            url: urlStart + 'shipment-itmes/' + $('#editShipmentItemForm').find('[name="id"]').val(),
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
                    $("#editShipmentItemForm").trigger('reset');
                    dt_shipmentItems.ajax.url(urlStart + 'get-shipmentItems/' + shipmentId).load();
                    Swal.fire({
                        icon: 'success',
                        title: '',
                        text: response.message,
                        confirmButtonText: doneTranslation,
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                    $("#editShipmentItemForm").trigger('reset');
                    $('#editShipmentItemModal').modal('hide');

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
    $('.shipment-items-table tbody').on('click', '.delete-record', function () {
        var data = dt_shipmentItems.row($(this).closest('tr')).data();
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
                    url: urlStart + 'shipment-itmes/' + data.id,
                    type: 'DELETE',

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        dt_shipmentItems.ajax.url(urlStart + 'get-shipmentItems/' + shipmentId).load();
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
