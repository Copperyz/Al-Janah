// /**
//  * Pricing
//  */

// 'use strict';

// document.addEventListener('DOMContentLoaded', function (event) {
//   function nextSection(number) {
//     document.getElementById('section' + number).style.display = 'block';
//     // updateSectionDisplay();
//   }

//   $('#shipmentPriceForm').submit(function (event) {
//     event.preventDefault();
//     var form = $(this);

//     $.ajax({
//       url: form.attr('action'),
//       type: form.attr('method'),
//       data: {
//         currentSection: 2
//       },
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       },
//       success: function (response) {
//         var section3 = document.createElement('section');
//         section3.id = 'section3';
//         section3.classList.add('pricing-free-trial', 'bg-label-white', 'fade-in');
//         section3.innerHTML = `
//             <div class="container">
//                 <div class="position-relative">
//                     <div class="d-flex justify-content-between flex-column-reverse flex-lg-row align-items-center py-4 px-5">
//                         <div class="text-center text-lg-start mt-2 ms-3">
//                             <h3 class="text-primary mb-1">${response.data}</h3>
//                             <p class="text-body mb-1">You will get full access to with all the features for 14 days.</p>
//                             <button class="btn btn-primary mt-4 mb-2">Log in </button>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         `;

//         $('#shipmentPriceForm').append(section3);
//       },
//       error: function (response, xhr, status, error) {
//         Swal.fire({
//           title: `Error`,
//           text: response.responseJSON.message,
//           icon: 'error',
//           confirmButtonText: `Back`,
//           confirmButtonColor: '#dc3545',
//           buttonsStyling: false
//         });
//       }
//     });
//   });
// });
