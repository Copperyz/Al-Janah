<div class="row">
  @can('show-trips-card')
  <div class="col-sm-6 col-lg-3 mb-4">
    <div class="card card-border-shadow-primary">
      <div class="card-body text-center">
        <div class="d-flex align-items-center justify-content-center mb-2 pb-1">
          <div class="avatar me-2">
            <span class="avatar-initial rounded bg-label-primary"><i class='ti ti-clock ti-md'></i></span>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-center gap-2">
          <h4 class="card-title mb-1">{{__('Trips')}}</h4>
          <h2 class="ms-1 mb-0 text-primary">{{$trips}}</h2>
        </div>
      </div>
    </div>
  </div>
  @endcan
  @can('show-shipments-card')
  <div class="col-sm-6 col-lg-3 mb-4">
    <div class="card card-border-shadow-warning">
      <div class="card-body text-center">
        <div class="d-flex align-items-center justify-content-center mb-2 pb-1">
          <div class="avatar me-2">
            <span class="avatar-initial rounded bg-label-warning"><i class='ti ti-clock ti-md'></i></span>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-center gap-2">
          <h4 class="card-title mb-1">{{__('Shipments')}}</h4>
          <h2 class="ms-1 mb-0 text-warning">{{$shipments}}</h2>
        </div>
      </div>
    </div>
  </div>
  @endcan
  @can('show-tripRotes-card')
  <div class="col-sm-6 col-lg-3 mb-4">
    <div class="card card-border-shadow-info">
      <div class="card-body text-center">
        <div class="d-flex align-items-center justify-content-center mb-2 pb-1">
          <div class="avatar me-2">
            <span class="avatar-initial rounded bg-label-info"><i class='ti ti-clock ti-md'></i></span>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-center gap-2">
          <h4 class="card-title mb-1">{{__('Trip Routes')}}</h4>
          <h2 class="ms-1 mb-0 text-info">{{$tripRoutes}}</h2>
        </div>
      </div>
    </div>
  </div>
  @endcan
  @can('show-payments-card')
  <div class="col-sm-6 col-lg-3 mb-4">
    <div class="card card-border-shadow-success">
      <div class="card-body text-center">
        <div class="d-flex align-items-center justify-content-center mb-2 pb-1">
          <div class="avatar me-2">
            <span class="avatar-initial rounded bg-label-success"><i class='ti ti-clock ti-md'></i></span>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-center gap-2">
          <h4 class="card-title mb-1">{{__('Payments')}}</h4>
          <h2 class="ms-1 mb-0 text-success">{{$payments}}</h2>
        </div>
      </div>
    </div>
  </div>
  @endcan
  @can('show-users-card')
  <div class="col-sm-6 col-lg-3 mb-4">
    <div class="card card-border-shadow-primary">
      <div class="card-body text-center">
        <div class="d-flex align-items-center justify-content-center mb-2 pb-1">
          <div class="avatar me-2">
            <span class="avatar-initial rounded bg-label-primary"><i class='ti ti-clock ti-md'></i></span>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-center gap-2">
          <h4 class="card-title mb-1">{{__('Users')}}</h4>
          <h2 class="ms-1 mb-0 text-primary">{{$users}}</h2>
        </div>
      </div>
    </div>
  </div>
  @endcan
  @can('show-customers-card')
  <div class="col-sm-6 col-lg-3 mb-4">
    <div class="card card-border-shadow-warning">
      <div class="card-body text-center">
        <div class="d-flex align-items-center justify-content-center mb-2 pb-1">
          <div class="avatar me-2">
            <span class="avatar-initial rounded bg-label-warning"><i class='ti ti-clock ti-md'></i></span>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-center gap-2">
          <h4 class="card-title mb-1">{{__('Customers')}}</h4>
          <h2 class="ms-1 mb-0 text-warning">{{$customers}}</h2>
        </div>
      </div>
    </div>
  </div>
  @endcan
</div>