/**
 * App shipment routes List (jquery)
 */

'use strict';

$(function () {
    // Variable declaration for table
    var dt_shipment_routes_table = $('.shipment-routes-list-table');

    // shipment routes datatable
    if (dt_shipment_routes_table.length) {
        var dt_shipment_routes = dt_shipment_routes_table.DataTable({
            ajax: 'get-shipments-routes',
            columns: [
                // columns according to JSON
                { data: '' },
                { data: 'type' },
                { data: 'legs_combined' },
                { data: 'shipment_price' },
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
                            '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2 showShipmentRoute" data-bs-target="#showShipmentRouteModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-eye"></i></button>' +
                            '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2 editShipmentRoute" data-bs-target="#editShipmentRouteModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-edit"></i></button>' +
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
                    text: `<i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">${addShipmentRouteTranslation}</span>`,
                    className: 'add-new btn btn-primary mb-3 mb-md-0',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#addShipmentRouteModal'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }
            ],
        });
    }

    // On each datatable draw, initialize tooltip
    dt_shipment_routes_table.on('draw.dt', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                boundary: document.body
            });
        });
    });

    $("#addShipmentRouteForm").on("submit", function (event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var formData = form.serializeArray();
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
                    dt_shipment_routes.ajax.url('get-shipments-routes').load();
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
                            $("#addShipmentRouteForm").trigger('reset');
                            $('#addShipmentRouteModal').modal('hide');
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

    $(document).on('click', 'button.showShipmentRoute', function () {
        var data = dt_shipment_routes.row($(this).closest('tr')).data();
        $.ajax({
            url: './shipments_routes/' + data.id,
            method: 'GET',
            success: function (response) {
                // Clear existing content in the timeline container
                $('#timelineContainer').empty();

                // Create a new timeline item for each leg
                if (response.legs && response.legs.length > 0) {
                    response.legs.forEach(function (leg, index) {
                        // Determine the color based on leg type
                        var colorClass = '';
                        var typeTranslation = '';
                        switch (leg.type) {
                            case 'Start':
                                colorClass = 'timeline-point-success'; // Green
                                typeTranslation = startTranslation;
                                break;
                            case 'Transit':
                                colorClass = 'timeline-point-warning'; // Yellow
                                typeTranslation = transitTranslation;
                                break;
                            case 'End':
                                colorClass = 'timeline-point-danger'; // Red
                                typeTranslation = endTranslation;
                                break;
                            default:
                                colorClass = 'timeline-point-info'; // Default to blue for unknown types
                        }

                        // Create a new timeline item
                        var timelineItem = $('<li class="timeline-item timeline-item-transparent ps-4"></li>');

                        // Add the timeline point with the determined color
                        timelineItem.append('<span class="timeline-point ' + colorClass + '"></span>');

                        // Create the timeline event
                        var timelineEvent = $('<div class="timeline-event"></div>');

                        // Create the timeline header
                        var timelineHeader = $('<div class="timeline-header"></div>');
                        timelineHeader.append('<h6 class="mb-0">' + typeTranslation + '</h6>');

                        // Add header to the event
                        timelineEvent.append(timelineHeader);

                        // Add description to the event
                        timelineEvent.append('<p class="mb-2">' + countryTranslation + ': ' + leg.country + '</p>');

                        // Add the timeline event to the timeline item
                        timelineItem.append(timelineEvent);

                        // Append the timeline item to the timeline container
                        $('#timelineContainer').append(timelineItem);

                        // Add a horizontal line between timeline items
                        if (index < response.legs.length - 1) {
                            $('#timelineContainer').append('<hr class="timeline-divider" />');
                        }
                    });
                }

                // Add the final shipment details
                var finalItem = $('<li class="timeline-item timeline-item-transparent ps-4"></li>');
                finalItem.append('<span class="timeline-point timeline-point-primary"></span>');

                var finalEvent = $('<div class="timeline-event"></div>');
                finalEvent.append('<div class="timeline-header"><h6 class="mb-0">' + shipmentDetailsTranslation + '</h6></div>');
                finalEvent.append('<p class="mb-2">' + typeTranslation + ': ' + response.type + '</p>');
                finalEvent.append('<p class="mb-2">' + shipmentPriceTranslation + ': $' + response.shipment_price + '</p>');

                finalItem.append(finalEvent);
                $('#timelineContainer').append(finalItem);
            },
            error: function (error) {
                // handle errors
                console.error(error);
            }
        });
        // var data = dt_user.row($(this).closest('tr')).data();
        // $('#editUserForm').trigger("reset");
        // $('#editUserForm').find('[name="name"]').val(data.name);
        // $('#editUserForm').find('[name="email"]').val(data.email);
        // $('#editUserForm').find('[name="id"]').val(data.id);
    });

    $(document).on('click', 'button.editShipmentRoute', function () {
        $("#editShipmentRouteForm").trigger('reset');
        $("#legsContainer").empty();
        var data = dt_shipment_routes.row($(this).closest('tr')).data();
        // Fill the 'Type' radio button based on the response
        $('#editShipmentRouteForm').find("input[name='type'][value='" + data.type + "']").prop("checked", true);
        // Fill the 'Shipment Price' input field
        $('#editShipmentRouteForm').find('[name="shipment_price"]').val(data.shipment_price);

        $('#editShipmentRouteForm').find('[name="id"]').val(data.id);
        // Function to create and fill a leg container
        function createLegContainer(leg, index) {
            var legContainer = $('<div data-repeater-list="points"><div data-repeater-item><div class="row"></div></div></div>');

            var typeSelect = $(`<div class="mb-3 col-5 mb-0"><label class="form-label" for="form-repeater-1-3">Type</label><select class="select2 form-select" data-allow-clear="true" name="points[${index}][type]"></select></div>`);
            typeSelect.find('select').append('<option selected disabled>' + selectTranslation + '</option>');
            typeSelect.find('select').append('<option value="Start">Start Point</option>');
            typeSelect.find('select').append('<option value="Transit">Transit</option>');
            typeSelect.find('select').append('<option value="End">End Point</option>');
            typeSelect.find('select').val(leg.type);

            var countrySelect = $(`<div class="mb-3 col-5 mb-0"><label class="form-label" for="form-repeater-1-4">Country</label><select class="select2 form-select" data-allow-clear="true" name="points[${index}][country]"></select></div>`);
            countrySelect.find('select').append('<option selected disabled>' + selectTranslation + '</option>');
            countrySelect.find('select').append('<option value="Turkey">Turkey</option>');
            countrySelect.find('select').append('<option value="China">China</option>');
            countrySelect.find('select').append('<option value="Tunis">Tunis</option>');
            countrySelect.find('select').append('<option value="Libya">Libya</option>');
            countrySelect.find('select').val(leg.country);

            var deleteButton = $('<div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0"><button class="btn btn-label-danger mt-4" data-repeater-delete><i class="ti ti-x ti-xs me-1"></i></button></div>');

            deleteButton.find('button').on('click', function (e) {
                e.preventDefault(); // Prevent form submission
                $(this).closest('[data-repeater-item]').remove();
            });

            deleteButton.find('button').on('click', function (e) {
                e.preventDefault(); // Prevent form submission
                $(this).closest('.leg-container').remove();
            });

            legContainer.find('.row').append(deleteButton);

            legContainer.find('.row').append(typeSelect);
            legContainer.find('.row').append(countrySelect);
            legContainer.find('.row').append(deleteButton);

            $('#legsContainer').append(legContainer);

            // Manually initialize Select2 for the new selects
            initializeSelect2(legContainer.find('.select2'));
        }

        // Function to initialize Select2
        function initializeSelect2(selectElements) {
            selectElements.select2({
                allowClear: true,
                dropdownParent: selectElements.closest('.modal')
            });
        }


        var currentIndex = 0; // Global variable to track the current index

        // Fill legs
        data.legs.forEach(function (leg, currentIndex) {
            createLegContainer(leg, currentIndex);
            currentIndex++;
        });

        // Add leg button click event
        $('#addLegButton').off('click').on('click', function (event) {
            event.preventDefault(); // Prevent the default form submission
            createLegContainer({ type: '', country: '' }, currentIndex); // Pass the current index
            currentIndex++; // Increment the index for the next leg
        });


    });

    $("#editShipmentRouteForm").on("submit", function (event) {
        event.preventDefault();

        // Get the serialized array
        var formData = $(this).serializeArray();

        // Separate points data
        var pointsData = formData.filter(function (item) {
            return item.name.startsWith('points');
        });

        // Reorder the points array
        var reorderedPointsData = [];
        for (var i = 0; i < pointsData.length / 2; i++) {
            reorderedPointsData.push({
                name: 'points[' + i + '][type]',
                value: pointsData[i * 2].value
            });
            reorderedPointsData.push({
                name: 'points[' + i + '][country]',
                value: pointsData[i * 2 + 1].value
            });
        }

        // Replace the original points data with the reordered one
        formData = formData.filter(function (item) {
            return !item.name.startsWith('points');
        }).concat(reorderedPointsData);

        $.ajax({
            url: './shipments_routes/' + $('#editShipmentRouteForm').find('[name="id"]').val(),
            method: 'PUT',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response, status, xhr) {
                if (xhr.status === 200) {
                    // Handle a successful response
                    dt_shipment_routes.ajax.url('get-shipments-routes').load();
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
                            $("#editShipmentRouteForm").trigger('reset');
                            $('#editShipmentRouteModal').modal('hide');
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
    $('.shipment-routes-list-table tbody').on('click', '.delete-record', function () {
        var data = dt_shipment_routes.row($(this).closest('tr')).data();
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
                    url: './shipments_routes/' + data.id,
                    type: 'DELETE',

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        dt_shipment_routes.ajax.url('get-shipments-routes').load();
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


