/**
 * App trip routes List (jquery)
 */

'use strict';

$(function () {
    // Variable declaration for table
    var dt_trip_routes_table = $('.trip-routes-list-table');

    // shipment routes datatable
    if (dt_trip_routes_table.length) {
        var dt_trip_routes = dt_trip_routes_table.DataTable({
            ajax: 'get-trip-routes',
            columns: [
                // columns according to JSON
                { data: '' },
                { data: 'typeLocale' },
                { data: 'legs_combined' },
                // { data: 'trip_price' },
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
                            '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2 showTripRoute" data-bs-target="#showTripRouteModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-eye"></i></button>' +
                            '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2 editTripRoute" data-bs-target="#editTripRouteModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-edit"></i></button>' +
                            '<a href="javascript:;" class="text-body delete-record"><i class="ti ti-trash ti-sm mx-2"></i></a>' +
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
                    text: `<i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">${addTripRouteTranslation}</span>`,
                    className: 'add-new btn btn-primary mb-3 mt-2 mb-2 addTripRoute',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#addTripRouteModal'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }
            ],
        });
    }

    // On each datatable draw, initialize tooltip
    dt_trip_routes_table.on('draw.dt', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                boundary: document.body
            });
        });
    });

    $(document).on('click', 'button.addTripRoute', function () {
        $("#addTripRouteForm").trigger('reset');
        // $("#points").empty();
    });

    $("#addTripRouteForm").on("submit", function (event) {
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
                    dt_trip_routes.ajax.url('get-trip-routes').load();
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
                            $("#addTripRouteForm").trigger('reset');
                            $('#addTripRouteModal').modal('hide');
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

    $(document).on('click', 'button.showTripRoute', function () {
        var data = dt_trip_routes.row($(this).closest('tr')).data();
        $.ajax({
            url: './trip_routes/' + data.id,
            method: 'GET',
            success: function (response) {
                // Clear existing content in the timeline container
                $('#timelineContainer').empty();

                // Create a new timeline item for each leg
                if (response.legs && response.legs.length > 0) {
                    response.legs.forEach(function (leg, index) {
                        // Determine the color based on leg type
                        var colorClass = '';
                        var legTypeTranslation = '';
                        var countryLocaleTranslation = '';
                        switch (leg.type) {
                            case 'Origin':
                                colorClass = 'timeline-point-success'; // Green
                                legTypeTranslation = originTranslation;
                                break;
                            case 'Transit':
                                colorClass = 'timeline-point-warning'; // Yellow
                                legTypeTranslation = transitTranslation;
                                break;
                            case 'Destination':
                                colorClass = 'timeline-point-danger'; // Red
                                legTypeTranslation = destinationTranslation;
                                break;
                            default:
                                colorClass = 'timeline-point-info'; // Default to blue for unknown types
                        }
                        switch (leg.country) {
                            case 'Libya':
                                countryLocaleTranslation = libyaTranslation;
                                break;
                            case 'Turkey':
                                countryLocaleTranslation = turkeyTranslation;
                                break;
                            case 'Dubai':
                                countryLocaleTranslation = dubaiTranslation;
                                break;
                            case 'China':
                                countryLocaleTranslation = chinaTranslation;
                                break;
                            case 'Tunis':
                                countryLocaleTranslation = tunisTranslation;
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
                        timelineHeader.append('<h6 class="mb-0">' + legTypeTranslation + '</h6>');

                        // Add header to the event
                        timelineEvent.append(timelineHeader);

                        // Add description to the event
                        timelineEvent.append('<p class="mb-2">' + countryTranslation + ': ' + countryLocaleTranslation + '</p>');

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
                var routeTypeTranslation = '';
                switch (response.type) {
                    case 'Air':
                        routeTypeTranslation = airTranslation;
                        break;
                    case 'Sea':
                        routeTypeTranslation = seaTranslation;
                        break;
                    default:
                        colorClass = 'timeline-point-info'; // Default to blue for unknown types
                }

                // Add the final shipment details
                var finalItem = $('<li class="timeline-item timeline-item-transparent ps-4"></li>');
                finalItem.append('<span class="timeline-point timeline-point-primary"></span>');

                var finalEvent = $('<div class="timeline-event"></div>');
                finalEvent.append('<div class="timeline-header"><h6 class="mb-0">' + tripDetailsTranslation + '</h6></div>');
                finalEvent.append('<p class="mb-2">' + typeTranslation + ': ' + routeTypeTranslation + '</p>');
                if(response.trip_price)
                finalEvent.append('<p class="mb-2">' + tripPriceTranslation + ': $' + response.trip_price + '</p>');

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

    $(document).on('click', 'button.editTripRoute', function () {
        $("#editTripRouteForm").trigger('reset');
        $("#legsContainer").empty();
        var data = dt_trip_routes.row($(this).closest('tr')).data();
        // Fill the 'Type' radio button based on the response
        $('#editTripRouteForm').find("input[name='type'][value='" + data.type + "']").prop("checked", true);
        // Fill the 'Shipment Price' input field
        $('#editTripRouteForm').find('[name="trip_price"]').val(data.trip_price);

        $('#editTripRouteForm').find('[name="id"]').val(data.id);
        // Function to create and fill a leg container
        function createLegContainer(leg, index) {
            var legContainer = $('<div data-repeater-list="points"><div data-repeater-item><div class="row"></div></div></div>');

            var typeSelect = $(`<div class="mb-3 col-5 mb-0"><label class="form-label" for="form-repeater-1-3">${typeTranslation}</label><select class="select2 form-select" data-allow-clear="true" name="points[${index}][type]"></select></div>`);
            typeSelect.find('select').append('<option selected disabled>' + selectTranslation + '</option>');
            typeSelect.find('select').append('<option value="Origin">' + originTranslation + '</option>');
            typeSelect.find('select').append('<option value="Transit">' + transitTranslation + '</option>');
            typeSelect.find('select').append('<option value="Destination">' + destinationTranslation + '</option>');
            typeSelect.find('select').val(leg.type);

            var countrySelect = $(`<div class="mb-3 col-5 mb-0"><label class="form-label" for="form-repeater-1-4">${countryTranslation}</label><select class="select2 form-select" data-allow-clear="true" name="points[${index}][country]"></select></div>`);
            countrySelect.find('select').append('<option selected disabled>' + selectTranslation + '</option>');
            countrySelect.find('select').append('<option value="Turkey">' + turkeyTranslation + '</option>');
            countrySelect.find('select').append('<option value="China">' + chinaTranslation + '</option>');
            countrySelect.find('select').append('<option value="Tunis">' + tunisTranslation + '</option>');
            countrySelect.find('select').append('<option value="Dubai">' + dubaiTranslation + '</option>');
            countrySelect.find('select').append('<option value="Libya">' + libyaTranslation + '</option>');
            countrySelect.find('select').val(leg.country);

            var deleteButton = $('<div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0"><button type="button" class="btn btn-label-danger mt-4" data-repeater-delete><i class="ti ti-x ti-xs me-1"></i></button></div>');

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

    $("#editTripRouteForm").on("submit", function (event) {
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
            url: './trip_routes/' + $('#editTripRouteForm').find('[name="id"]').val(),
            method: 'PUT',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response, status, xhr) {
                if (xhr.status === 200) {
                    // Handle a successful response
                    dt_trip_routes.ajax.url('get-trip-routes').load();
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
                            $("#editTripRouteForm").trigger('reset');
                            $('#editTripRouteModal').modal('hide');
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
        var data = dt_trip_routes.row($(this).closest('tr')).data();
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
                    url: './trip_routes/' + data.id,
                    type: 'DELETE',

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        dt_trip_routes.ajax.url('get-trip-routes').load();
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


