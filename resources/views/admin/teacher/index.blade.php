@extends('layout.main')

@section('content')

<h1 class="h3 mb-2">
  <strong>Teacher</strong> list (<span title="teacher total">{{ $count }}</span>)
</h1>

@if (session('success'))
  <h4 class="mb-2">
    <div class="badge bg-success">{{ session('success') }}</div>
  </h4>
@endif

<div class="mb-2">
  <a href="/teacher/create" class="btn btn-primary btn-sm" title="add teacher">
    <i class="fas fa-plus"></i>
  </a>
</div>

<div class="row justify-content-center">
  @foreach ($teachers as $teacher)
    <div class="col-sm-4 text-center">
      <a href="/teacher/{{ $teacher->slug }}/edit" class="text-decoration-none">
        <div class="card" title="{{ $teacher->name }}">
          <div class="card-body">
            <h5 class="card-title">
              @if ($teacher->sign_in)
                <span class="position-absolute top-0 start-100 translate-middle p-2 border border-white border-2 rounded-circle bg-primary" title="teacher is logged"></span>
              @elseif (!$teacher->account || !$teacher->classroom_id)
                <span class="position-absolute top-0 start-100 translate-middle p-2 border border-white border-2 rounded-circle
                {{ !$teacher->account ? 'bg-danger' : 'bg-info' }}"
                title="{{ !$teacher->account ? "teacher doesn't have an account yet" : "teacher not homeroom" }}"></span>
              @endif
              {{ $teacher->name }}
            </h5>
            <small class="text-muted" title="{{ $teacher->classroom->name ?? '...' }}">{{ $teacher->classroom->name ?? '...' }}</small>
          </div>
        </div>
      </a>
    </div>
  @endforeach
</div>

@endsection