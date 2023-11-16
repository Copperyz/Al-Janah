/**
 * Form Extras
 */

'use strict';

(function () {
  const textarea = document.querySelector('#autosize-demo'),
    creditCard = document.querySelector('.credit-card-mask'),
    phoneMask = document.querySelector('.phone-number-mask'),
    dateMask = document.querySelector('.date-mask'),
    timeMask = document.querySelector('.time-mask'),
    numeralMask = document.querySelector('.numeral-mask'),
    blockMask = document.querySelector('.block-mask'),
    delimiterMask = document.querySelector('.delimiter-mask'),
    customDelimiter = document.querySelector('.custom-delimiter-mask'),
    prefixMask = document.querySelector('.prefix-mask');

  // Autosize
  // --------------------------------------------------------------------
  if (textarea) {
    autosize(textarea);
  }

  // Cleave JS Input Mask
  // --------------------------------------------------------------------

  // Credit Card
  if (creditCard) {
    new Cleave(creditCard, {
      creditCard: true,
      onCreditCardTypeChanged: function (type) {
        if (type != '' && type != 'unknown') {
          document.querySelector('.card-type').innerHTML =
            '<img src="' + assetsPath + 'img/icons/payments/' + type + '-cc.png" height="28"/>';
        } else {
          document.querySelector('.card-type').innerHTML = '';
        }
      }
    });
  }

  // Phone Number
  if (phoneMask) {
    new Cleave(phoneMask, {
      phone: true,
      phoneRegionCode: 'US'
    });
  }

  // Date
  if (dateMask) {
    new Cleave(dateMask, {
      date: true,
      delimiter: '-',
      datePattern: ['Y', 'm', 'd']
    });
  }

  // Time
  if (timeMask) {
    new Cleave(timeMask, {
      time: true,
      timePattern: ['h', 'm', 's']
    });
  }

  //Numeral
  if (numeralMask) {
    new Cleave(numeralMask, {
      numeral: true,
      numeralThousandsGroupStyle: 'thousand'
    });
  }

  //Block
  if (blockMask) {
    new Cleave(blockMask, {
      blocks: [4, 3, 3],
      uppercase: true
    });
  }

  // Delimiter
  if (delimiterMask) {
    new Cleave(delimiterMask, {
      delimiter: '·',
      blocks: [3, 3, 3],
      uppercase: true
    });
  }

  // Custom Delimiter
  if (customDelimiter) {
    new Cleave(customDelimiter, {
      delimiters: ['.', '.', '-'],
      blocks: [3, 3, 3, 2],
      uppercase: true
    });
  }

  // Prefix
  if (prefixMask) {
    new Cleave(prefixMask, {
      prefix: '+63',
      blocks: [3, 3, 3, 4],
      uppercase: true
    });
  }
})();

// bootstrap-maxlength & repeater (jquery)
$(function () {
  var maxlengthInput = $('.bootstrap-maxlength-example'),
    formRepeater = $('.form-repeater');

  // Bootstrap Max Length
  // --------------------------------------------------------------------
  if (maxlengthInput.length) {
    maxlengthInput.each(function () {
      $(this).maxlength({
        warningClass: 'label label-success bg-success text-white',
        limitReachedClass: 'label label-danger',
        separator: ' out of ',
        preText: 'You typed ',
        postText: ' chars available.',
        validate: true,
        threshold: +this.getAttribute('maxlength')
      });
    });
  }

  // Form Repeater
  // ! Using jQuery each loop to add dynamic id and class for inputs. You may need to improve it based on form fields.
  // -----------------------------------------------------------------------------------------------------------------

  // Repeater init
  if (formRepeater.length) {
    var counter = 1;

    // Prevent default form submission
    formRepeater.on('submit', function (e) {
      e.preventDefault();
      return false;
    });

    formRepeater.repeater({
      show: function () {
        var fromControl = $(this).find('.form-control, .form-select');
        var formLabel = $(this).find('.form-label');

        fromControl.each(function (i) {
          var id = 'form-repeater-' + counter + '-' + i;
          $(fromControl[i]).attr('id', id);
          $(formLabel[i]).attr('for', id);
        });

        counter++;

        $(this).slideDown();

        // Manually initialize Select2 for both old and new selects
        initializeSelect2($(this).find('.select2'));
      },
    });

    // Handle delete button click event separately
    formRepeater.on('click', '.btn-label-danger[data-repeater-delete]', function (e) {
      e.preventDefault(); // Prevent default click action
      $(this).closest('.data-repeater-item').slideUp(function () {
        $(this).remove();
      });
    });

    // Explicitly initialize Select2 for existing selects
    initializeSelect2(formRepeater.find('.select2'));

    // Bind click event for the "Add" button
    $('.btn-primary[data-repeater-create]').on('click', function (e) {
      e.preventDefault(); // Prevent default click action
      var newItem = formRepeater.find('.data-repeater-item:first').clone(); // Clone the first repeater item
      newItem.find('select.select2').select2({ allowClear: true }); // Manually initialize Select2 for the new item
      formRepeater.find('.data-repeater-list').append(newItem); // Append the new item to the repeater list
    });
  }

  function initializeSelect2(selectElements) {
    selectElements.select2({
      allowClear: true,
      dropdownParent: selectElements.closest('.modal') // Set the dropdown parent to the modal
    });
  }
});
