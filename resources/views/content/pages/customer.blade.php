@section('title', __('Customer Overview'))

<div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-4 text-center text-sm-start gap-2">
  <div class="mb-2 mb-sm-0">
    <h4 class="mb-1">
      {{__('Customer ID')}} #{{$customer->customer_code}}
    </h4>
    <p class="mb-0">
      Aug 17, 2020, 5:48 (ET)
    </p>
  </div>
  <button type="button" class="btn btn-label-danger delete-customer">{{__('Delete Customer')}}</button>
</div>


<div class="row">
  <!-- Customer-detail Sidebar -->
  <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
    <!-- Customer-detail Card -->
    <div class="card mb-4">
      <div class="card-body">
        <div class="customer-avatar-section">
          <div class="d-flex align-items-center flex-column">
            <img class="img-fluid rounded my-3" src="{{asset('assets/img/avatars/15.png')}}" height="110" width="110" alt="User avatar" />
            <div class="customer-info text-center">
              <h4 class="mb-1">{{$customer->first_name.' '. $customer->last_name}}</h4>
              <small>{{__('Customer ID')}} #{{$customer->customer_code}}</small>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-around flex-wrap my-4">
          <div class="d-flex align-items-center gap-2">
            <div class="avatar">
              <div class="avatar-initial rounded bg-label-primary">
                <i class='ti ti-shopping-cart ti-md'></i>
              </div>
            </div>
            <div class="gap-0 d-flex flex-column">
              <p class="mb-0 fw-medium">{{$customer->shipments->count()}}</p>
              <small>{{__('Shipments')}}</small>
            </div>
          </div>
          <div class="d-flex align-items-center gap-2">
            <div class="avatar">
              <div class="avatar-initial rounded bg-label-primary">
                <i class='ti ti-currency-dollar ti-md'></i>
              </div>
            </div>
            <div class="gap-0 d-flex flex-column">
              <p class="mb-0 fw-medium">$12,378</p>
              <small>{{__('Spent')}}</small>
            </div>
          </div>
        </div>

        <div class="info-container">
          <small class="d-block pt-4 border-top fw-normal text-uppercase text-muted my-3">DETAILS</small>
          <ul class="list-unstyled">
            <li class="mb-3">
              <span class="fw-medium me-2">{{__('Username')}}:</span>
              <span>{{$customer->first_name.' '. $customer->last_name}}</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">{{__('Email')}}:</span>
              <span>{{$customer->email}}</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">{{__('Status')}}:</span>
              <span class="badge bg-label-success">Active</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">{{(__('Phone'))}}:</span>
              <span>{{$customer->phone}}</span>
            </li>

            <li class="mb-3">
              <span class="fw-medium me-2">{{__('Country')}}:</span>
              <span>{{$customer->country->name}}</span>
            </li>
          </ul>
          <div class="d-flex justify-content-center">
            <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">{{__('Edit Details')}}</a>

          </div>
        </div>
      </div>
    </div>
    <!-- /Customer-detail Card -->
    
  </div>
  <!--/ Customer Sidebar -->


  <!-- Customer Content -->
  <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1 bs-stepper wizard-icons wizard-modern wizard-modern-icons-example">
    <!-- Customer Pills -->
        <ul style="padding: 0;" class="nav nav-pills flex-column flex-md-row mb-3 bs-stepper-header">
          <li class="nav-item step" data-target="#Overview"><a style="flex-direction: row" class="step-trigger nav-link active py-2" href="javascript:void(0);"><i class="ti ti-user me-1"></i>{{__('Overview')}}</a></li>
          <li class="nav-item step" data-target="#Security"><a style="flex-direction: row" class="step-trigger nav-link py-2" href="javascript:void(0);"><i class="ti ti-lock me-1"></i>{{__('Security')}}</a></li>
          <li class="nav-item step" data-target="#Billing"><a style="flex-direction: row" class="step-trigger nav-link py-" href="javascript:void(0);"><i class="ti ti-file-invoice me-1"></i>{{__('Address & Billing')}}</a></li>
        </ul>
    <!--/ Customer Pills -->

    <!-- / Customer cards -->
    <div class="bs-stepper-content" style="padding: 0; background: none">
        <div class="content" id="Overview">
            <div class="row text-nowrap">
              <div class="col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="card-icon mb-3">
                      <div class="avatar">
                        <div class="avatar-initial rounded bg-label-primary">
                          <i class='ti ti-currency-dollar ti-md'></i>
                        </div>
                      </div>
                    </div>
                    <div class="card-info">
                      <h4 class="card-title mb-3">{{__('Cash Balance')}}</h4>
                      <div class="d-flex align-items-baseline mb-1 gap-1">
                          <p class="mb-0"> {{__('Credit Left')}}</p>
                        <h4 class="text-primary mb-0">$2345</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        
        
              <div class="col-md-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-icon mb-3">
                      <div class="avatar">
                        <div class="avatar-initial rounded bg-label-info">
                          <i class='ti ti-discount ti-md'></i>
                        </div>
                      </div>
                    </div>
                    <div class="card-info">
                      <h4 class="card-title mb-3">{{__('Coupons')}}</h4>
                      <div class="d-flex align-items-baseline mb-1 gap-1">
                          <p class="mb-0">{{__('Coupons you win')}}</p>
                        <h4 class="text-info mb-0">21</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / customer cards -->
            <!-- Invoice table -->
            <div class="card mb-4">
                <div class="table-responsive mb-3">
                    <table class="table datatables-customer-shipments border-top" data-customer="{{$customer->id}}">
                    <thead>
                        <tr>
                        <th></th>
                        <th>{{__('Tracking Number')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Amount')}}</th>
                        <th>{{__('Date')}}</th>
                        <th class="text-md-center">{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="content" id="Security">  
          <div class="card mb-4">
          <h5 class="card-header">{{__('Change Password')}}</h5>
          <div class="card-body">
            <form id="updateCustomerForm" method="POST" action="{{route('customer.updateData')}}">
                @csrf
              <div class="alert alert-warning" role="alert">
                <h6 class="alert-heading mb-1">{{__('Ensure that these requirements are met')}}</h6>
                <span>{{__('Minimum 8 characters long, uppercase & symbol')}}</span>
              </div>
              <div class="row">
                <div class="mb-3 col-12 form-password-toggle">
                  <label class="form-label" for="currentPassword">{{__('Current Password')}}</label>
                  <div class="input-group input-group-merge">
                    <input class="form-control" type="password" id="currentPassword" name="currentPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye ti-xs"></i></span>
                  </div>
                </div>
                <div class="mb-3 col-12 form-password-toggle">
                  <label class="form-label" for="new_password">{{__('New Password')}}</label>
                  <div class="input-group input-group-merge">
                    <input class="form-control" type="password" id="new_password" name="new_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye ti-xs"></i></span>
                  </div>
                </div>
                <div class="mb-3 col-12 form-password-toggle">
                  <label class="form-label" for="new_password_confirmation">{{__('Confirm New Password')}}</label>
                  <div class="input-group input-group-merge">
                    <input class="form-control" type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye ti-xs"></i></span>
                  </div>
                </div>
                <div>
                  <button type="submit" class="btn btn-primary me-2">{{__('Change Password')}}</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!--/ Change Password -->
        </div>
        <div class="content" id="Billing">
            <!-- Address accordion -->
            <div class="card card-action mb-4">
          <div class="card-header align-items-center py-4">
            <h5 class="card-action-title mb-0">Address Book</h5>
            <div class="card-action-element">
              <button class="btn btn-label-primary" type="button" data-bs-toggle="modal" data-bs-target="#addNewAddress">Add new address</button>
            </div>
          </div>
          <div class="card-body">
            <div class="accordion accordion-flush accordion-arrow-left" id="ecommerceBillingAccordionAddress">
              <div class="accordion-item border-bottom">
                <div class="accordion-header d-flex justify-content-between align-items-center flex-wrap flex-sm-nowrap" id="headingHome">
                  <a class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#ecommerceBillingAddressHome" aria-expanded="false" aria-controls="headingHome" role="button">
                    <span>
                      <span class="d-flex gap-2 align-items-baseline">
                        <span class="h6 mb-1">Home</span>
                        <span class="badge bg-label-success">Default Address</span>
                      </span>
                      <span class="mb-0 text-muted">23 Shatinon Mekalan</span>
                    </span>
                  </a>
                  <div class="d-flex gap-3 p-4 p-sm-0 pt-0 ms-1 ms-sm-0">
                    <a href="javascript:void(0);"><i class="ti ti-pencil text-secondary ti-sm"></i></a>
                    <a href="javascript:void(0);"><i class="ti ti-trash text-secondary ti-sm"></i></a>
                    <button class="btn p-0" data-bs-toggle="dropdown" aria-expanded="false" role="button"><i class="ti ti-dots-vertical text-secondary ti-sm mt-1"></i></button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript:void(0);">Set as default address</a></li>
                    </ul>
                  </div>
                </div>
                <div id="ecommerceBillingAddressHome" class="accordion-collapse collapse" data-bs-parent="#ecommerceBillingAccordionAddress">
                  <div class="accordion-body ps-4 ms-2">
                    <h6 class="mb-1">Violet Mendoza</h6>
                    <p class="mb-1">23 Shatinon Mekalan,</p>
                    <p class="mb-1">Melbourne, VIC 3000,</p>
                    <p class="mb-1">LondonUK</p>
                  </div>
                </div>
              </div>
              <div class="accordion-item border-bottom border-top-0">
                <div class="accordion-header d-flex justify-content-between align-items-center flex-wrap flex-sm-nowrap" id="headingOffice">
                  <a class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#ecommerceBillingAddressOffice" aria-expanded="false" aria-controls="headingOffice" role="button">
                    <span class="d-flex flex-column">
                      <span class="h6 mb-0">Office</span>
                      <span class="mb-0 text-muted">45 Roker Terrace</span>
                    </span>
                  </a>
                  <div class="d-flex gap-3 p-4 p-sm-0 pt-0 ms-1 ms-sm-0">
                    <a href="javascript:void(0);"><i class="ti ti-pencil text-secondary ti-sm"></i></a>
                    <a href="javascript:void(0);"><i class="ti ti-trash text-secondary ti-sm"></i></a>
                    <button class="btn p-0" data-bs-toggle="dropdown" aria-expanded="false" role="button"><i class="ti ti-dots-vertical text-secondary ti-sm mt-1"></i></button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript:void(0);">Set as default address</a></li>
                    </ul>
                  </div>
                </div>
                <div id="ecommerceBillingAddressOffice" class="accordion-collapse collapse" aria-labelledby="headingOffice" data-bs-parent="#ecommerceBillingAccordionAddress">
                  <div class="accordion-body ps-4 ms-2">
                    <h6 class="mb-1">Violet Mendoza</h6>
                    <p class="mb-1">45 Roker Terrace,</p>
                    <p class="mb-1">Latheronwheel,</p>
                    <p class="mb-1">KW5 8NW</p>
                    <p class="mb-1">LondonUK</p>
                  </div>
                </div>
              </div>
              <div class="accordion-item border-top-0">
                <div class="accordion-header d-flex justify-content-between align-items-center flex-wrap flex-sm-nowrap" id="headingFamily">
                  <a class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#ecommerceBillingAddressFamily" aria-expanded="false" aria-controls="headingFamily" role="button">
                    <span class="d-flex flex-column">
                      <span class="h6 mb-0">Family</span>
                      <span class="mb-0 text-muted">512 Water Plant</span>
                    </span>
                  </a>
                  <div class="d-flex gap-3 p-4 p-sm-0 pt-0 ms-1 ms-sm-0">
                    <a href="javascript:void(0);"><i class="ti ti-pencil text-secondary ti-sm"></i></a>
                    <a href="javascript:void(0);"><i class="ti ti-trash text-secondary ti-sm"></i></a>
                    <button class="btn p-0" data-bs-toggle="dropdown" aria-expanded="false" role="button"><i class="ti ti-dots-vertical text-secondary ti-sm mt-1"></i></button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript:void(0);">Set as default address</a></li>
                    </ul>
                  </div>
                </div>
                <div id="ecommerceBillingAddressFamily" class="accordion-collapse collapse" aria-labelledby="headingFamily" data-bs-parent="#ecommerceBillingAccordionAddress">
                  <div class="accordion-body ps-4 ms-2">
                    <h6 class="mb-1">Violet Mendoza</h6>
                    <p class="mb-1">512 Water Plant,</p>
                    <p class="mb-1">Melbourne, NY 10036,</p>
                    <p class="mb-1">New York,</p>
                    <p class="mb-1">United States</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- Address accordion -->

    </div>
    <!-- /Invoice table -->
  </div>
  <!--/ Customer Content -->
</div>

<!-- Modal -->
@include('_partials/_modals/customers/modal-edit-user')
<!-- /Modal -->
