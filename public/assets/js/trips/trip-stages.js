/**
 *  Form Wizard
 */

'use strict';

(function () {
  // Icons Wizard
  // --------------------------------------------------------------------
  const wizardIcons = document.querySelector('.wizard-icons-example');

  if (typeof wizardIcons !== undefined && wizardIcons !== null) {
    const wizardIconsBtnNextList = [].slice.call(wizardIcons.querySelectorAll('.btn-next')),
      wizardIconsBtnPrevList = [].slice.call(wizardIcons.querySelectorAll('.btn-prev')),
      wizardIconsBtnSubmit = wizardIcons.querySelector('.btn-submit');

    const iconsStepper = new Stepper(wizardIcons, {
      linear: true
    });

    const radioButtons = document.querySelectorAll('input[type="radio"]');
    // Replace 'yourTargetCountry' with the actual value you are looking for
    const targetCountry = document.querySelector(`[data-country]`).getAttribute('data-country');
    const targetStatus = document.querySelector(`[data-status]`).getAttribute('data-status');
    // const tripHistory = document.getElementById('tripHistory').value;

    // Find the index of the step with the matching data-country value
    const targetStepIndex = Array.from(iconsStepper._steps).findIndex(step => {
      return step.getAttribute('data-target') === '#route' + targetCountry;
    });
    // Check if the step index is found
    if (targetStepIndex !== -1) {
      // Use the stepTo method to navigate to the target step
      iconsStepper.to(targetStepIndex + 1);
    }
    if (targetStatus === 'Enroute') {
      // Use the stepTo method to navigate to the target step
      iconsStepper.next();
    }

    // Set the Stepper to the specific index
    // iconsStepper.to(indexToFocus);
    const currentCountrySpan = document.getElementById('currentCountrySpan');
    const currentStatusSpan = document.getElementById('currentStatusSpan');

    if (wizardIconsBtnNextList) {
      wizardIconsBtnNextList.forEach((wizardIconsBtnNext, index) => {
        // Get the form associated with the clicked button
        let form = wizardIconsBtnNext.closest('form');
        // Extract the currentCountry value from the form
        let currentCountry = form.querySelector(`[data-current-country]`).getAttribute('data-current-country');
        // Extract the radio button checked value from the form
        let checkedElement = document.querySelector(`input[name=radio${currentCountry}]:checked`);
        let checkedValue = checkedElement.value;
        const targetCountryMatches = currentCountry === targetCountry;
        const targetStatusMatches = checkedValue === targetStatus;

        // Enable the button if conditions are not met
        wizardIconsBtnNext.disabled = targetCountryMatches && targetStatusMatches;

        wizardIconsBtnNext.addEventListener('click', event => {
          let form = wizardIconsBtnNext.closest('form');
          // Extract the trip id
          const tripID = form.querySelector(`input[name=trip_id]`).value;
          // Extract the currentCountry value from the form
          let currentCountry = form.querySelector(`[data-current-country]`).getAttribute('data-current-country');
          let checkedElement = document.querySelector(`input[name=radio${currentCountry}]:checked`);
          let checkedValue = checkedElement.value;

          let currentRoute;
          if (checkedValue == 'Enroute') {
            currentRoute = checkedElement.getAttribute('data-next-route');
          } else {
            currentRoute = checkedElement.getAttribute('data-current-route');
          }
          // Extract the not text value
          const currentNote = document.querySelector(`input[name=note${currentCountry}]`).value;

          const formData = {
            trip_id: tripID,
            status: checkedValue,
            currentLeg: currentRoute,
            note: currentNote
          };

          event.preventDefault();
          // console.log(this.ser);
          Swal.fire({
            title: areYouSureTranslation,
            text: checkedValue == 'Enroute' ? btnConfirmEnroute : btnConfirmWarehouse,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: submitTranslation,
            cancelButtonText: cancelTranslation,
            customClass: {
              confirmButton: 'btn btn-primary me-3',
              cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
          }).then(result => {
            if (result.isConfirmed) {
              $.ajax({
                url: form.getAttribute('action'),
                type: form.getAttribute('method'),
                data: formData,
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                  Swal.fire({
                    icon: 'success',
                    title: '',
                    text: response.message,
                    confirmButtonText: doneTranslation,
                    customClass: {
                      confirmButton: 'btn btn-success'
                    }
                  });
                  //to change current country and status with thier translate
                  var countryTranslation;
                  var statusTranslate;
                  switch (currentCountry) {
                    case 'Libya':
                      countryTranslation = libyaTranslation;
                      break;
                    case 'Turkey':
                      countryTranslation = turkeyTranslation;
                      break;
                    case 'Dubai':
                      countryTranslation = dubaiTranslation;
                      break;
                    case 'China':
                      countryTranslation = chinaTranslation;
                      break;
                    case 'Tunis':
                      countryTranslation = tunisTranslation;
                      break;
                    default:
                      countryTranslation = currentCountry; // Default to blue for unknown types
                  }
                  switch (checkedValue) {
                    case 'At Warehouse':
                      statusTranslate = atWarehouseTranslate;
                      break;
                    case 'Enroute':
                      statusTranslate = enrouteTranslate;
                      break;
                    default:
                      statusTranslate = checkedValue; // Default to blue for unknown types
                  }

                  currentCountrySpan.textContent = countryTranslation;
                  currentStatusSpan.textContent = statusTranslate;

                  if (checkedValue == 'Enroute') {
                    window.location.reload();
                    iconsStepper.next();
                  } else if (checkedValue == 'Delivered') {
                    window.location.reload();
                  } else {
                    // wizardIconsBtnNext.disabled = true;
                    window.location.reload();
                  }
                },
                error: function (response, xhr, status, error) {
                  Swal.fire({
                    title: `Error`,
                    text: response.responseJSON.message,
                    icon: 'error',
                    confirmButtonText: `Back`,
                    confirmButtonColor: '#dc3545',
                    buttonsStyling: false
                  });
                }
              });
            }
          });
        });

        radioButtons.forEach(radioButton => {
          radioButton.addEventListener('change', function () {
            // Get the currentCountry and checkedValue when a radio button changes
            const currentCountry = this.getAttribute('data-current-country');
            const checkedValue = this.value;

            // Check if the conditions are met to enable/disable the button
            const targetCountryMatches = currentCountry === targetCountry;
            const targetStatusMatches = checkedValue === targetStatus;

            // Enable the button if conditions are not met
            wizardIconsBtnNext.disabled = targetCountryMatches && targetStatusMatches;
          });
        });
      });
    }
    if (wizardIconsBtnPrevList) {
      wizardIconsBtnPrevList.forEach(wizardIconsBtnPrev => {
        wizardIconsBtnPrev.addEventListener('click', event => {
          iconsStepper.previous();
        });
      });
    }
    if (wizardIconsBtnSubmit) {
      wizardIconsBtnSubmit.addEventListener('click', event => {
        alert('Submitted..!!');
      });
    }
  }
})();
