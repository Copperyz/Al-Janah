/**
 * App shipment List (jquery)
 */

'use strict';

$(function () {
    // Variable declaration for table
    var dt_trips_table = $('.trips-list-table');
    // trips datatable
    if (dt_trips_table.length) {
        var dt_trips = dt_trips_table.DataTable({
            ajax: 'get-trips',
            columns: [
                // columns according to JSON
                { data: '' },
                { data: 'tracking_no' },
                { data: 'delivery_code' },
                { data: 'status' },
                { data: 'departure_date' },
                { data: 'estimated_delivery_date' },
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
                //   // shipment status
                //   targets: 4,
                //   render: function (data, type, full, meta) {
                //     var $shipment_status = full['paymentStatus'];
                //     var roleBadgeObj = {
                //       paid: '<span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30"><i class="ti ti-checks ti-sm"></i></span>',
                //       pending: '<span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30"><i class="ti ti-hourglass-empty mx-2 ti-sm"></i></span>',
                //       failed: '<span class="badge badge-center rounded-pill bg-label-danger w-px-30 h-px-30"><i class="ti ti-exclamation-circle ti-sm"></i></span>',
                //       refunded:
                //         '<span class="badge badge-center rounded-pill bg-label-info w-px-30 h-px-30"><i class="ti ti-receipt-refund ti-sm"></i></span>'
                //     };
                //     return (
                //       roleBadgeObj[$shipment_status] +
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
                            '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2 showTrip" data-bs-target="#showTripModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-eye"></i></button>' +
                            '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2 editTrip" data-bs-target="#editTripModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-edit"></i></button>' +
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
                '<"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3"f<"shipment_status mb-3 mb-md-0">>' +
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
                    text: `<i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">${addTripTranslation}</span>`,
                    className: 'add-new btn btn-primary mb-3 mb-md-0 addTrip',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#addTripModal'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }
            ],
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
        var defaultTripRouteId = $("#trip_route_id option:selected").val();
        var defaultCurrentStatus = $("#current_status option:selected").val();

        $("#addTripForm").trigger('reset');
        $("#trip_route_id").val(null).trigger('change');
        $("#current_status").val(null).trigger('change');

        // Set the default option back
        $("#trip_route_id").val(defaultTripRouteId).trigger('change');
        $("#current_status").val(defaultCurrentStatus).trigger('change');
    });

    $("#addTripForm").on("submit", function (event) {
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
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#addTripForm").trigger('reset');
                            $('#addTripModal').modal('hide');
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

    $(document).on('click', 'button.editTrip', function () {
        $("#editTripForm").trigger('reset');
        var defaultTripRouteId = $("#edit_trip_route_id option:selected").val();
        var defaultCurrentStatus = $("#edit_current_status option:selected").val();

        $("#addTripForm").trigger('reset');
        $("#edit_trip_route_id").val(null).trigger('change');
        $("#edit_current_status").val(null).trigger('change');

        // Set the default option back
        $("#edit_trip_route_id").val(defaultTripRouteId).trigger('change');
        $("#edit_current_status").val(defaultCurrentStatus).trigger('change');

        var data = dt_trips.row($(this).closest('tr')).data();
        $('#editTripForm').find('[name="departure_date"]').val(data.departure_date);
        $('#editTripForm').find('[name="estimated_delivery_date"]').val(data.estimated_delivery_date);
        $('#editTripForm').find('[name="id"]').val(data.id);

        if (data.trip_route_id)
            $('#editTripForm').find('[name="trip_route_id"]').val(data.trip_route_id).trigger('change');
        if (data.current_status)
            $('#editTripForm').find('[name="current_status"]').val(data.current_status).trigger('change');
    });

    $("#editTripForm").on("submit", function (event) {
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
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#editTripForm").trigger('reset');
                            $('#editTripModal').modal('hide');
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
        }).then((result) => {
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
