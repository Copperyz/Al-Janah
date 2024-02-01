/**
 * App Invoice - Add
 */

'use strict';

(function () {
  const invoiceItemPriceList = document.querySelectorAll('.invoice-item-price'),
    invoiceItemQtyList = document.querySelectorAll('.invoice-item-qty'),
    invoiceDateList = document.querySelectorAll('.date-picker');

  // Price
  if (invoiceItemPriceList) {
    invoiceItemPriceList.forEach(function (invoiceItemPrice) {
      new Cleave(invoiceItemPrice, {
        delimiter: '',
        numeral: true
      });
    });
  }

  // Qty
  if (invoiceItemQtyList) {
    invoiceItemQtyList.forEach(function (invoiceItemQty) {
      new Cleave(invoiceItemQty, {
        delimiter: '',
        numeral: true
      });
    });
  }

  // Datepicker
  if (invoiceDateList) {
    invoiceDateList.forEach(function (invoiceDateEl) {
      invoiceDateEl.flatpickr({
        monthSelectorType: 'static'
      });
    });
  }
})();

// repeater (jquery)
$(function () {
  var applyChangesBtn = $('.btn-apply-changes'),
    discount,
    tax1,
    tax2,
    discountInput,
    tax1Input,
    tax2Input,
    sourceItem = $('.source-item'),
    adminDetails = {
      'App Design': 'Designed UI kit & app pages.',
      'App Customization': 'Customization & Bug Fixes.',
      'ABC Template': 'Bootstrap 4 admin template.',
      'App Development': 'Native App Development.'
    };

  // Prevent dropdown from closing on tax change
  $(document).on('click', '.tax-select', function (e) {
    e.stopPropagation();
  });

  // On tax change update it's value value
  function updateValue(listener, el) {
    listener.closest('.repeater-wrapper').find(el).text(listener.val());
  }

  // Apply item changes btn
  if (applyChangesBtn.length) {
    $(document).on('click', '.btn-apply-changes', function (e) {
      var $this = $(this);
      tax1Input = $this.closest('.dropdown-menu').find('#taxInput1');
      tax2Input = $this.closest('.dropdown-menu').find('#taxInput2');
      discountInput = $this.closest('.dropdown-menu').find('#discountInput');
      tax1 = $this.closest('.repeater-wrapper').find('.tax-1');
      tax2 = $this.closest('.repeater-wrapper').find('.tax-2');
      discount = $('.discount');

      if (tax1Input.val() !== null) {
        updateValue(tax1Input, tax1);
      }

      if (tax2Input.val() !== null) {
        updateValue(tax2Input, tax2);
      }

      if (discountInput.val().length) {
        $this
          .closest('.repeater-wrapper')
          .find(discount)
          .text(discountInput.val() + '%');
      }
    });
  }

  // Repeater init
  if (sourceItem.length) {
    sourceItem.on('submit', function (e) {
      e.preventDefault();
    });

    sourceItem.repeater({
      show: function () {
        // Increment the counter for unique IDs
        var counter = $(this).closest('[data-repeater-list]').find('[data-repeater-item]').length;

        // Set unique IDs for selects before they are added
        var parcelSelect = $(this).find('select[name="parcel_types_id"]');
        var goodSelect = $(this).find('select[name="good_types_id"]');
        parcelSelect.attr('id', 'parcel_types_id_' + counter).addClass('select2');
        goodSelect.attr('id', 'good_types_id_' + counter).addClass('select2');

        $(this).slideDown();

        // Manually initialize Select2 for both old and new selects
        initializeSelect2();

        // Initialize tooltip on load of each item
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl);
        });
      },
      hide: function (e) {
        $(this).slideUp();
      }
    });

    // Explicitly initialize Select2 for existing selects
    initializeSelect2();

    function initializeSelect2() {
      $('select.select2').select2({ allowClear: true });
    }
  }

  // Get the current date and time
  const currentDate = new Date();

  // Convert hours to 12-hour format
  const hours = ((currentDate.getHours() + 11) % 12 + 1);

  // Determine AM or PM
  const ampm = currentDate.getHours() >= 12 ? 'PM' : 'AM';

  // Format the date as per the desired format (Y-m-d h:m K)
  const formattedDate = `${currentDate.getFullYear()}-${('0' + (currentDate.getMonth() + 1)).slice(-2)}-${('0' + currentDate.getDate()).slice(-2)} ${('0' + hours).slice(-2)}:${('0' + currentDate.getMinutes()).slice(-2)} ${ampm}`;

  // Set the value of the input element to the formatted date
  $('#datePicker').val(formattedDate);

  var freightValue = 0;
  var packageValue = 0;
  var totalPrice = 0;


  $(document).on('click', '.calculate-price-btn', function () {
    var $container = $(this).closest('.repeater-wrapper'); // Adjust the selector based on your actual HTML structure

    // Check if the container is found
    if ($container.length) {
      // Now try to get the values of input fields
      var height = $container.find('[name$="[height]"]').val();
      var width = $container.find('[name$="[width]"]').val();
      var weight = $container.find('[name$="[weight]"]').val();
      var length = $container.find('[name$="[length]"]').val();

      // Get values of select elements within the current repeater item
      var parcelTypeId = $container.find('[name$="[parcel_types_id]"]').val();
      var goodTypeId = $container.find('[name$="[good_types_id]"]').val();

      var trip_route_id = $('#addShipmentForm').find('[name="trip_route_id"]').val();

      // Check if all required inputs are filled
      if (height && width && weight && length && parcelTypeId && goodTypeId && trip_route_id) {
        // Call your function with these values
        $.ajax({
          url: "../get-price",
          method: 'GET',
          data: {
            weight: weight,
            height: height,
            width: width,
            length: length,
            parcelTypeId: parcelTypeId,
            goodTypeId: goodTypeId,
            trip_route_id: trip_route_id
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            // Update the UI with the calculated price


            var value = parseFloat(response) > 0 ? parseFloat(response) : freightValue;
            totalPrice = totalPrice - freightValue;
            freightValue = freightValue - parseFloat($container.find('[name$="[price]"]').val() ? $container.find('[name$="[price]"]').val() : 0) + parseFloat(value);
            $('#freightValue').text('$' + parseFloat(freightValue).toFixed(2));
            totalPrice = totalPrice + freightValue;
            $('#totalValue').text('$' + parseFloat(totalPrice).toFixed(2));
            $container.find('[name$="[price]"]').val(parseFloat(value).toFixed(2));

          },

          error: function (error) {
          }
        });
      } else {
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
    } else {
      console.log('Container not found.');
    }
  });

  $(document).on('click', '.deleteElement', function () {
    var $container = $(this).closest('.repeater-wrapper');

    totalPrice = totalPrice - parseFloat($container.find('[name$="[price]"]').val() ? $container.find('[name$="[price]"]').val() : 0);;

    freightValue = freightValue - parseFloat($container.find('[name$="[price]"]').val() ? $container.find('[name$="[price]"]').val() : 0);
    $('#freightValue').text('$' + parseFloat(freightValue).toFixed(2));
    $('#totalValue').text('$' + parseFloat(totalPrice).toFixed(2));

    $container.find('[name$="[price]"]').val(0);
    removeItem(this);

  });

  // If you have a submit button inside the form, you can bind the click event to it
  $(".submitButton").on("click", function (event) {
    // Trigger the form submission when the button is clicked
    var formData = $("#addShipmentForm").serializeArray();
    $('#addShipmentForm').find('[name="shipmentPrice"]').val(parseFloat(totalPrice).toFixed(2));
    $.ajax({
      url: '../shipments',
      method: 'POST',
      data: $("#addShipmentForm").serialize(),
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'json',
      processData: false,
      success: function (response, status, xhr) {
        if (xhr.status === 200) {
          // Handle a successful response
          Swal.fire({
            icon: 'success',
            title: '',
            text: response.message,
            confirmButtonText: doneTranslation,
            customClass: {
              confirmButton: 'btn btn-success'
            }
          }).then((result) => {
            // Check if the user clicked the "Confirm" button
            if (result.isConfirmed) {
              // Redirect to orders.index
              window.location.href = '../shipments/' + response.shipment_id;
            }
          });
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

  $(".cancelButton").on("click", function (event) {
    // Trigger the form submission when the button is clicked
    // $("#addShipmentForm").trigger("reset");
    // $("#shipmentItems").empty();
    window.location.href = '../shipments/'
  });

  $("#addCustomerForm").on("submit", function (event) {
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
              location.reload();
              $("#addCustomerForm").trigger('reset');
              $('#addCustomerModal').modal('hide');
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

  // $('#trip_route_id').change(function () {
  //   $.ajax({
  //     url: "../trip_routes/" + $(this).val(),
  //     method: 'GET',
  //     headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     },
  //     success: function (response) {
  //       tripFareValue = response.trip_price;
  //       $('#tripFareValue').text('$' + parseFloat(tripFareValue).toFixed(2));
  //       totalPrice = totalPrice + tripFareValue;
  //       $('#totalValue').text('$' + parseFloat(totalPrice).toFixed(2));
  //     },
  //     error: function (error) {
  //     }
  //   });
  // });
  $('#packageCost').change(function () {

    packageValue = this.value;
    $('#packageValue').text('$' + parseFloat(packageValue).toFixed(2));
    totalPrice = totalPrice + packageValue;
    $('#totalValue').text('$' + parseFloat(totalPrice).toFixed(2));
  });




});
