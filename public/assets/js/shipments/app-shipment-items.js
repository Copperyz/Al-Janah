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
                    orderable: false,
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
                            '<span><button class="btn btn-sm btn-info me-2 editShipmentItem" ddata-bs-target="#editShipmentItemModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-edit"></i></button>' +
                            '<span><button class="btn btn-sm btn-danger me-2 delete-record"><i class="ti ti-trash"></i></button>'
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
                    text: `<i class="ti ti-plus ti-sm me-2"></i>${addItemTranslation}`, // Icon and text inside the button
                    className: 'btn btn-primary text-white d-flex align-items-center mt-2 mb-2', // Full button styling
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

    $(document).on('change', '#parcel_types_id_add', function () {
        var parcelTypeId = $('#addShipmentItemForm').find('[name="parcel_types_id"]').val();
        if (parcelTypeId == 1) {
            $('#addShipmentItemForm').find('[name="length"]').closest('div').show();
            $('#addShipmentItemForm').find('[name="height"]').closest('div').show();
            $('#addShipmentItemForm').find('[name="width"]').closest('div').show();
        } else {
            // If not, show them (in case they were hidden previously)
            $('#addShipmentItemForm').find('[name="length"]').closest('div').hide();
            $('#addShipmentItemForm').find('[name="height"]').closest('div').hide();
            $('#addShipmentItemForm').find('[name="width"]').closest('div').hide();
        }
    });

    $(document).on('change', '#parcel_types_id_edit', function () {
        var parcelTypeId = $('#editShipmentItemForm').find('[name="parcel_types_id"]').val();
        if (parcelTypeId == 1) {
            $('#editShipmentItemForm').find('[name="length"]').closest('div').show();
            $('#editShipmentItemForm').find('[name="height"]').closest('div').show();
            $('#editShipmentItemForm').find('[name="width"]').closest('div').show();
        } else {
            // If not, show them (in case they were hidden previously)
            $('#editShipmentItemForm').find('[name="length"]').closest('div').hide();
            $('#editShipmentItemForm').find('[name="height"]').closest('div').hide();
            $('#editShipmentItemForm').find('[name="width"]').closest('div').hide();
        }
    });

    $(document).on('click', '.calculate-price-btn_add', function () {
         // Now try to get the values of input fields
        var height = $('#addShipmentItemForm').find('[name="height"]').val();
        var width = $('#addShipmentItemForm').find('[name="width"]').val();
        var weight = $('#addShipmentItemForm').find('[name="weight"]').val();
        var length = $('#addShipmentItemForm').find('[name="length"]').val();
        var quantity = $('#addShipmentItemForm').find('[name="quantity"]').val();

        // Get values of select elements within the current repeater item
        var parcelTypeId = $('#addShipmentItemForm').find('[name="parcel_types_id"]').val();
        var goodTypeId = $('#addShipmentItemForm').find('[name="good_types_id"]').val();
        var trip_route_id = $('#addShipmentItemForm').find('[name="trip_route_id"]').val();

        if (parcelTypeId == 1 && height && width && weight && length && parcelTypeId && goodTypeId && trip_route_id && quantity) {
            // Call your function with these values
            $.ajax({
                url: urlStart + 'get-price',
                method: 'GET',
                data: {
                    weight: weight,
                    height: height,
                    width: width,
                    length: length,
                    quantity: quantity,
                    parcelTypeId: parcelTypeId,
                    goodTypeId: goodTypeId,
                    trip_route_id: trip_route_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // CSRF token in headers
                },
                success: function (response) {
                    // Update the UI with the calculated price
                    var value = parseFloat(response) > 0 ? parseFloat(response) : $('#addShipmentItemForm').find('[name="price"]').val();
                    $('#addShipmentItemForm').find('[name="price"]').val(parseFloat(value).toFixed(2));
                },
                error: function (error) {
                    console.error('Error:', error);  // Add error logging for better debugging
                }
            });
            
        }
        else if (parcelTypeId != 1 && weight && parcelTypeId && goodTypeId && trip_route_id && quantity) {
            // Call your function with these values
            $.ajax({
                url: urlStart + 'get-price',
                method: 'GET',
                data: {
                    weight: weight,
                    height: height,
                    width: width,
                    length: length,
                    quantity: quantity,
                    parcelTypeId: parcelTypeId,
                    goodTypeId: goodTypeId,
                    trip_route_id: trip_route_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Update the UI with the calculated price
                    var value = parseFloat(response) > 0 ? parseFloat(response) : $('#addShipmentItemForm').find('[name="price"]').val();
                    $('#addShipmentItemForm').find('[name="price"]').val(parseFloat(value).toFixed(2));
                },

                error: function (error) {
                    console.error('Error:', error);
                }
            });
        }

        else{
            Swal.fire({
                title: errorTranslation,
                text: requiredFieldsTranslation,
                icon: 'error',
                confirmButtonText: doneTranslation,
                customClass: {
                  confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
              });
              return false;
        }
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
                    // dt_shipmentItems.ajax.url(urlStart + 'get-shipmentItems/' + shipmentId).load();
                    // Swal.fire({
                    //     title: '',
                    //     text: response.message,
                    //     icon: 'success',
                    //     confirmButtonText: doneTranslation,
                    //     customClass: {
                    //         confirmButton: 'btn btn-success'
                    //     },
                    // }).then((result) => {
                    //     if (result.isConfirmed) {
                    //         $("#addShipmentItemForm").trigger('reset');
                    //         $('#addShipmentItemModal').modal('hide');
                    //     }
                    // });
                    Swal.fire({
                        icon: 'success',
                        title: '',
                        text: response.message,
                        confirmButtonText: doneTranslation,
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    }).then(function(result) {
                        // Wait for the user to click the confirmation button
                        if (result.isConfirmed) {
                            // Reload the page after user confirms
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

    $(document).on('click', 'a.editShipmentItem', function () {
        $("#editShipmentItemForm").trigger('reset');
        var data = dt_shipmentItems.row($(this).closest('tr')).data();
        $('#editShipmentItemForm').find('[name="name"]').val(data.name);
        $('#editShipmentItemForm').find('[name="price"]').val(data.price);
        $('#editShipmentItemForm').find('[name="height"]').val(data.height);
        $('#editShipmentItemForm').find('[name="length"]').val(data.length);
        $('#editShipmentItemForm').find('[name="width"]').val(data.width);
        $('#editShipmentItemForm').find('[name="weight"]').val(data.weight);
        $('#editShipmentItemForm').find('[name="quantity"]').val(data.quantity);
        $('#editShipmentItemForm').find('[name="good_types_id"]').val(data.good_types_id).trigger('change');
        $('#editShipmentItemForm').find('[name="parcel_types_id"]').val(data.parcel_types_id).trigger('change');
        $('#editShipmentItemForm').find('[name="id"]').val(data.id);

    });

    $(document).on('click', '.calculate-price-btn_edit', function () {
        // Now try to get the values of input fields
        var height = $('#editShipmentItemForm').find('[name="height"]').val();
        var width = $('#editShipmentItemForm').find('[name="width"]').val();
        var weight = $('#editShipmentItemForm').find('[name="weight"]').val();
        var length = $('#editShipmentItemForm').find('[name="length"]').val();
        var quantity = $('#editShipmentItemForm').find('[name="quantity"]').val();


        // Get values of select elements within the current repeater item
        var parcelTypeId = $('#editShipmentItemForm').find('[name="parcel_types_id"]').val();
        var goodTypeId = $('#editShipmentItemForm').find('[name="good_types_id"]').val();

        var trip_route_id = $('#editShipmentItemForm').find('[name="trip_route_id"]').val();

        // Check if all required inputs are filled
        if (parcelTypeId == 1 && height && width && weight && length && parcelTypeId && goodTypeId && trip_route_id) {
            // Call your function with these values
            $.ajax({
                uurl: urlStart + 'get-price',
                method: 'GET',
                data: {
                    weight: weight,
                    height: height,
                    width: width,
                    length: length,
                    quantity: quantity,
                    parcelTypeId: parcelTypeId,
                    goodTypeId: goodTypeId,
                    trip_route_id: trip_route_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Update the UI with the calculated price
                    var value = parseFloat(response) > 0 ? parseFloat(response) : $('#editShipmentItemForm').find('[name="price"]').val();
                    $('#editShipmentItemForm').find('[name="price"]').val(parseFloat(value).toFixed(2));
                },

                error: function (error) {
                }
            });
        }
        else if (parcelTypeId != 1 && weight && parcelTypeId && goodTypeId && trip_route_id) {
            // Call your function with these values
            $.ajax({
                url: urlStart + 'get-price',
                method: 'GET',
                data: {
                    weight: weight,
                    height: height,
                    width: width,
                    length: length,
                    quantity: quantity,
                    parcelTypeId: parcelTypeId,
                    goodTypeId: goodTypeId,
                    trip_route_id: trip_route_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Update the UI with the calculated price
                    var value = parseFloat(response) > 0 ? parseFloat(response) : $('#editShipmentItemForm').find('[name="price"]').val();
                    $('#editShipmentItemForm').find('[name="price"]').val(parseFloat(value).toFixed(2));
                },

                error: function (error) {
                }
            });
        }
        else {
            // Show error message using Swal.fire
            Swal.fire({
                title: 'Error',
                text: 'Please fill in all required fields.',
                icon: 'error',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        }
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
                    // $("#editShipmentItemForm").trigger('reset');
                    // dt_shipmentItems.ajax.url(urlStart + 'get-shipmentItems/' + shipmentId).load();
                    Swal.fire({
                        icon: 'success',
                        title: '',
                        text: response.message,
                        confirmButtonText: doneTranslation,
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    }).then(function(result) {
                        // Wait for the user to click the confirmation button
                        if (result.isConfirmed) {
                            // Reload the page after user confirms
                            location.reload();
                        }
                    });
                    // $("#editShipmentItemForm").trigger('reset');
                    // $('#editShipmentItemModal').modal('hide');

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
                        // dt_shipmentItems.ajax.url(urlStart + 'get-shipmentItems/' + shipmentId).load();
                        Swal.fire({
                            icon: 'success',
                            title: '',
                            text: response.message,
                            confirmButtonText: doneTranslation,
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        }).then(function(result) {
                            // Wait for the user to click the confirmation button
                            if (result.isConfirmed) {
                                // Reload the page after user confirms
                                location.reload();
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
