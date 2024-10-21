<!-- BEGIN: Vendor JS-->
<script src="{{ asset('assets/vendor/js/dropdown-hover.js') }}"></script>
<script src="{{ asset('assets/vendor/js/mega-dropdown.js') }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/node-waves/node-waves.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>

@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>
<script src="{{ asset('assets/js/extends/extended-ui-blockui.js') }}"></script>

<script src="{{ asset('assets/js/main/front-main.js') }}"></script>
<!-- END: Theme JS-->
<script>
    function showSpinner(targetElement) {
        if (targetElement) {
            $(targetElement).block({
                message: '<div class="spinner-border" role="status"><span class="sr-only"></span></div>',
                css: {
                    backgroundColor: 'transparent',
                    border: '0'
                },
                overlayCSS: {
                    opacity: 0.5
                }
            });
        } else {
            $.blockUI({
                message: '<div class="spinner-border" role="status"><span class="sr-only"></span></div>',
                css: {
                    backgroundColor: 'transparent',
                    border: '0'
                },
                overlayCSS: {
                    opacity: 0.5
                }
            });
        }
    }

    function hideSpinner() {
        $.unblockUI();
    }
    var areYouSureTranslation = @json(__('Are you sure?'));
    var areYouSureTextTranslation = @json(__('You will not be able to revert this!'));
    var submitTranslation = @json(__('Submit'));
    var cancelTranslation = @json(__('Cancel'));
    var doneTranslation = @json(__('Done'));
</script>
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
