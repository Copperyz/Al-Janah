<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/node-waves/node-waves.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/hammer/hammer.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/typeahead-js/typeahead.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>
<script>
var exportTranslation = @json(__('Export'));
var searchTranslation = @json(__('Search'));
var showTranslation = @json(__('Show'));
var showingTranslation = @json(__('Showing'));
var toTranslation = @json(__('to'));
var ofTranslation = @json(__('of'));
var nextTranslation = @json(__('Next'));
var previousTranslation = @json(__('Previous'));
var noEntriesAvailableTranslation = @json(__('No entries available'));
var entriesTranslation = @json(__('entries'));
var submitTranslation = @json(__('Submit'));
var cancelTranslation = @json(__('Cancel'));
var doneTranslation = @json(__('Done'));

var areYouSureTranslation = @json(__('Are you sure?'));
var areYouSureTextTranslation = @json(__('You will not be able to revert this!'));

var btnConfirmWarehouse = @json(__('Confirm shipment At Watehouse'));
var btnConfirmEnroute = @json(__('Confirm shipment Enroute'));
var originTranslation = @json(__('Origin'));
var destinationTranslation = @json(__('Destination'));
var transitTranslation = @json(__('Transit'));
var countryTranslation = @json(__('Country'));
var libyaTranslation = @json(__('Libya'));
var turkeyTranslation = @json(__('Turkey'));
var chinaTranslation = @json(__('China'));
var dubaiTranslation = @json(__('Dubai'));
var tunisTranslation = @json(__('Tunis'));
var airTranslation = @json(__('Air'));
var seaTranslation = @json(__('Sea'));
var deliverdTranslate = @json(__('Delivered'));
var atWarehouseTranslate = @json(__('At Warehouse'));
var enrouteTranslate = @json(__('Enroute'));
var shipmentChangeTitleTranslate = @json(__('Changing Shipment status'));
var shipmentReasonTranslate = @json(__('Please select a reason for changing shipment status'));
var Detour = @json(__('Detour'));
var Complete = @json(__('Complete'));
</script>
<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->