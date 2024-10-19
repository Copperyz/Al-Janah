/**
 * App Invoice - Add
 */

'use strict';

(function () {
  const date = document.querySelectorAll('.date-picker');



  // Datepicker
  if (date) {
    date.forEach(function (invoiceDateEl) {
      invoiceDateEl.flatpickr({
        enableTime: true,         // Enable time picker
        dateFormat: "Y-m-d H:i K", // Format for date and time (24-hour with AM/PM)
        time_24hr: false,         // Set to false to use 12-hour format with AM/PM
        monthSelectorType: 'static' // Static month dropdown
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
        $(this).closest(".repeater-wrapper").find(".Height, .Width, .Length").hide();
        $(this).closest(".repeater-wrapper").find(".Inventory, .Aisle, .Row, .Shelf").hide();
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


  
  $(document).on('change', '#currency_id', function () {
    // Get the selected option text
    var selectedText = $(this).find('option:selected').text();

    // Extract only the symbol part from the selected text
    var symbol = selectedText.split('(')[1].replace(')', '').trim();

    // Update the currency span with the symbol
    $('#packageCurrency').text(symbol);
    $('#freightCurrency').text(symbol);
    $('#totalCurrency').text(symbol);
});


  $(document).on('click', '.calculate-price-btn', function () {
    var $container = $(this).closest('.repeater-wrapper'); // Adjust the selector based on your actual HTML structure

    // Check if the container is found
    if ($container.length) {
      // Now try to get the values of input fields
      var height = $container.find('[name$="[height]"]').val();
      var width = $container.find('[name$="[width]"]').val();
      var weight = $container.find('[name$="[weight]"]').val();
      var length = $container.find('[name$="[length]"]').val();
      var quantity = $container.find('[name$="[quantity]"]').val();

      // Get values of select elements within the current repeater item
      var parcelTypeId = $container.find('[name$="[parcel_types_id]"]').val();
      var goodTypeId = $container.find('[name$="[good_types_id]"]').val();

      var trip_route_id = $('#addShipmentForm').find('[name="trip_route_id"]').val();

      // Check if all required inputs are filled
      if (parcelTypeId == 1 && height && width && weight && length && parcelTypeId && goodTypeId && trip_route_id && quantity) {
        $.ajax({
          url: "../get-price",
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


            var value = parseFloat(response) > 0 ? parseFloat(response) : freightValue;
            totalPrice = totalPrice - freightValue;
            freightValue = freightValue - parseFloat($container.find('[name$="[price]"]').val() ? $container.find('[name$="[price]"]').val() : 0) + parseFloat(value);
            $('#freightValue').text(parseFloat(freightValue).toFixed(2));
            totalPrice = totalPrice + freightValue;
            $('#totalValue').text(parseFloat(totalPrice).toFixed(2));
            $container.find('[name$="[price]"]').val(parseFloat(value).toFixed(2));

          },

          error: function (error) {
          }
        });
      }
      else if(parcelTypeId != 1 && weight && parcelTypeId && goodTypeId && trip_route_id && quantity){
        $.ajax({
          url: "../get-price",
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


            var value = parseFloat(response) > 0 ? parseFloat(response) : freightValue;
            totalPrice = totalPrice - freightValue;
            freightValue = freightValue - parseFloat($container.find('[name$="[price]"]').val() ? $container.find('[name$="[price]"]').val() : 0) + parseFloat(value);
            $('#freightValue').text(parseFloat(freightValue).toFixed(2));
            totalPrice = totalPrice + freightValue;
            $('#totalValue').text(parseFloat(totalPrice).toFixed(2));
            $container.find('[name$="[price]"]').val(parseFloat(value).toFixed(2));

          },

          error: function (error) {
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
      
        // Call your function with these values
        
      
    } else {
      console.log('Container not found.');
    }
  });

  $(document).on('click', '.deleteElement', function () {
    var $container = $(this).closest('.repeater-wrapper');

    totalPrice = totalPrice - parseFloat($container.find('[name$="[price]"]').val() ? $container.find('[name$="[price]"]').val() : 0);;

    freightValue = freightValue - parseFloat($container.find('[name$="[price]"]').val() ? $container.find('[name$="[price]"]').val() : 0);
    $('#freightValue').text(parseFloat(freightValue).toFixed(2));
    $('#totalValue').text(parseFloat(totalPrice).toFixed(2));

    $container.find('[name$="[price]"]').val(0);
    removeItem(this);

  });

  // If you have a submit button inside the form, you can bind the click event to it
  $(".submitButton").on("click", function (event) {
    // Trigger the form submission when the button is clicked
    var formData = $("#addShipmentForm").serializeArray();
    $('#addShipmentForm').find('[name="shipmentPrice"]').val(parseFloat(freightValue).toFixed(2));
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
  //       $('#tripFareValue').text('LYD ' + parseFloat(tripFareValue).toFixed(2));
  //       totalPrice = totalPrice + tripFareValue;
  //       $('#totalValue').text('LYD ' + parseFloat(totalPrice).toFixed(2));
  //     },
  //     error: function (error) {
  //     }
  //   });
  // });

  $('#packageCost').keyup(function () {
    var packageValue = parseFloat(this.value) || 0; // Ensure packageValue is a valid number
    var freightV = parseFloat(freightValue) || 0; // Ensure packageValue is a valid number

    // Update packageValue display
    $('#packageValue').text(packageValue.toFixed(2));

    // Update totalPrice
    totalPrice = packageValue + freightV; // Set totalPrice to the current packageValue

    // Update totalValue display
    $('#totalValue').text(totalPrice.toFixed(2));
  });

  // Initially hide the dimensions fields
  $(".Height").hide();
  $(".Width").hide();
  $(".Length").hide();



  $(document).on("change", "#parcel_types_id", function (event) {
    // Get the selected value
    var selectedParcelTypeId = $(this).val();

    // Find the closest repeater-wrapper (parent container for the current repeated item)
    var repeaterWrapper = $(this).closest(".repeater-wrapper");

    // Find dimensions fields within the current repeated item
    var heightField = repeaterWrapper.find(".Height");
    var widthField = repeaterWrapper.find(".Width");
    var lengthField = repeaterWrapper.find(".Length");

    // Toggle the visibility of the dimensions fields based on the condition
    if (selectedParcelTypeId == 1) {
        // Show the dimensions fields
        heightField.show();
        widthField.show();
        lengthField.show();
    } else {
        // Hide the dimensions fields
        heightField.hide();
        widthField.hide();
        lengthField.hide();
    }
});

// Additional handling for initial state of dynamically added items
$(document).on("click", "#add-item-btn", function () {
    // When a new item is added, hide dimensions fields by default
    $(this).closest(".repeater-wrapper").find(".Height, .Width, .Length").hide();
});

// Initially hide the inventory fields
$(".Inventory, .Aisle, .Row, .Shelf").hide();

// Event handler for change in addToInventory checkbox
$(document).on("change", '.switch-input', function () {
    // Get the state of the checkbox
    var addToInventoryChecked = $(this).is(":checked");

    // Find the closest repeater-wrapper (parent container for the current repeated item)
    var repeaterWrapper = $(this).closest(".repeater-wrapper");

    // Find inventory fields within the current repeated item
    var inventoryField = repeaterWrapper.find(".Inventory");
    var aisleField = repeaterWrapper.find(".Aisle");
    var rowField = repeaterWrapper.find(".Row");
    var shelfField = repeaterWrapper.find(".Shelf");

    // Toggle the visibility of the inventory fields based on the state of the checkbox
    if (addToInventoryChecked) {
        // Show the inventory fields
        inventoryField.show();
        aisleField.show();
        rowField.show();
        shelfField.show();
    } else {
        // Hide the inventory fields
        inventoryField.hide();
        aisleField.hide();
        rowField.hide();
        shelfField.hide();
    }
});

// Additional handling for initial state of dynamically added items
$(document).on("click", "#add-item-btn", function () {
    // When a new item is added, hide inventory fields by default
    $(this).closest(".repeater-wrapper").find(".Inventory, .Aisle, .Row, .Shelf").hide();
});



});
