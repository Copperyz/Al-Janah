<!-- Two Factor Auth Modal -->
<div class="modal fade" id="twoFactorAuth" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-simple">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="col-12 mb-4">
    <div id="wizard-validation" class="bs-stepper wizard-numbered mt-2">
        <div class="bs-stepper-header d-none">
            <div class="step" data-target="#report-type">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle">1</span>
                    <span class="bs-stepper-label mt-1">
                        <span class="bs-stepper-title">Report Types</span>
                        <span class="bs-stepper-subtitle">Choose Report type</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i class="ti ti-chevron-right"></i>
            </div>
            <div class="step" data-target="#report-info">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Report Info</span>
                        <span class="bs-stepper-subtitle">Add report info</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i class="ti ti-chevron-right"></i>
            </div>
            <div class="step" data-target="#report-template">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle">3</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Choose Template</span>
                        <span class="bs-stepper-subtitle">choose template you want</span>
                    </span>
                </button>
            </div>
        </div>
        <div class="bs-stepper-content">
            <form id="wizard-validation-form" method="POST" action="{{route('reports.store')}}" onSubmit="return false" >
                <!-- Account Details -->
                <div id="report-type" class="content">
                    
                    <div class="text-center mb-4">
                    <h3 class="mb-2">Select Report Type</h3>
                    <p class="text-muted">.</p>
                </div>
                    <div class="row g-3">
                        <div class="col-12 mb-3">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content ps-3" for="customRadioTemp1">
                                    <input name="radioReportType" class="form-check-input d-none" type="radio" value="table" id="customRadioTemp1" />
                                    <span class="d-flex align-items-start">
                                        <i class="ti ti-settings ti-xl me-3"></i>
                                        <span>
                                            <span class="custom-option-header">
                                                <span class="h4 mb-2">Table</span>
                                            </span>
                                            <span class="custom-option-body">
                                                <span class="mb-0">Get code from an app like Google Authenticator or Microsoft Authenticator.</span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content ps-3" for="customRadioTemp2">
                                    <input name="radioReportType" class="form-check-input d-none" type="radio" value="invoice" id="customRadioTemp2" />
                                    <span class="d-flex align-items-start">
                                        <i class="ti ti-message ti-xl me-3"></i>
                                        <span>
                                            <span class="custom-option-header">
                                                <span class="h4 mb-2">Invoice</span>
                                            </span>
                                            <span class="custom-option-body">
                                                <span class="mb-0">We will send a code via SMS if you need to use your backup login method.</span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between mt-5">
                            <button class="btn btn-label-secondary btn-prev" disabled> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <!-- Personal Info -->
                <div id="report-info" class="content">
                    <div class="content-header text-center mb-3">
                    <h3 class="mb-2 pt-1">Report Info</h3>
                    <p class="mb-4">Enter report name and select which model.</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <label class="form-label" for="formValidationReport">Report Name</label>
                            <input type="text" id="formValidationReport" name="formValidationReport" class="form-control" placeholder="John" />
                        </div>

                        <div class="col-sm-12">
                            <label class="form-label" for="formValidationModel">Model</label>
                            <select class="select2" id="formValidationModel" name="formValidationModel">
                                <option label=" "></option>
                                @foreach($models as $model)
                                <option value="{{$model}}">{{strtoupper($model)}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-12 d-flex justify-content-between mt-5">
                            <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <!-- Social Links -->
                <div id="report-template" class="content">
                    
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label" for="formValidationLinkedIn">LinkedIn</label>
                            <input type="text" name="formValidationLinkedIn" id="formValidationLinkedIn" class="form-control" placeholder="https://linkedin.com/abc" />
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-success btn-next btn-submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                
            </div>
        </div>
    </div>
</div>

<!-- Modal Authentication via SMS -->
<div class="modal fade" id="invoice_type" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-simple">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="mb-2 pt-1">Report Info</h5>
                <p class="mb-4">Enter report name and select which model.</p>
                <div class="mb-4">
                    <input type="text" class="form-control form-control-lg" id="twoFactorAuthInputSms" placeholder="Report Name">
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-label-secondary me-sm-3 me-1" data-bs-toggle="modal" data-bs-target="#twoFactorAuth"><i class="ti ti-arrow-left ti-xs me-1 scaleX-n1-rtl"></i><span class="align-middle d-none d-sm-inline-block">Back</span></button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close"><span class="align-middle d-none d-sm-inline-block">Continue</span><i class="ti ti-arrow-right ti-xs ms-1 scaleX-n1-rtl"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Two Factor Auth Modal -->