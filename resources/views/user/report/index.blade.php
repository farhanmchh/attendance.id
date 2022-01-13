@extends('layout.main')

@section('content')

  <h1 class="h4 mb-3">
    <strong>Attendance</strong> report {{ $teacher->classroom->name ?? '' }}
  </h1>

  <div class="row">
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <div class="date-time-picker" data-value="{{ date('Y-m-d') }}"
            data-classroom_id="{{ $teacher->classroom->id }}"></div>
        </div>
      </div>
    </div>
    <div class="col-sm-7">
      <div class="card">
        <span
          class="position-absolute top-0 start-100 translate-middle p-2 badge border border-2 border-white rounded-pill bg-secondary" title="student total {{ $teacher->classroom->name ?? '' }}">
          {{ $student->count() }}
        </span>
        <div class="card-header d-flex justify-content-between">
          <p class="date-report card-title mb-0">...</p>
          <div class="mb-0">
            <span title="present total">
              <i class="fas fa-check-circle text-success fs-5"></i>
              <span class="present-total text-success me-1"></span>
            </span>

            <span title="permission total">
              <i class="fas fa-clipboard text-info fs-5"></i>
              <span class="permission-total text-info me-1"></span>
            </span>

            <span title="not present total">
              <i class="fas fa-times-circle text-danger fs-5"></i>
              <span class="not-present-total text-danger me-1"></span>
            </span>

            <span title="absences total">
              <i class="fas fa-user fs-5"></i>
              <span class="report-total me-1"></span>
            </span>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm text-center table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody class="row-container">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
