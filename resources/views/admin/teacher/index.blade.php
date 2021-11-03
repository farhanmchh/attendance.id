@extends('layout.main')

@section('content')

<h1 class="h3 mb-2">
  <strong>Teacher</strong> list ({{ $count }})
</h1>

@if (session('success'))
  <h4 class="mb-2">
    <div class="badge bg-success">{{ session('success') }}</div>
  </h4>
@endif

<div class="mb-2">
  <a href="/teacher/create" class="btn btn-primary btn-sm">
    <i class="fas fa-plus"></i>
  </a>
</div>
{{-- jam gadang --}}

<div class="row">
  @foreach ($teachers as $teacher)
    <div class="col-sm-4 text-center">
      <a href="/teacher/{{ $teacher->slug }}/edit" class="text-decoration-none">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
              @if (!$teacher->account)
                <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-white border-2 rounded-circle"></span>
              @endif
              {{ $teacher->name }}
            </h5>
            <small class="text-muted">{{ $teacher->classroom->name ?? '...' }}</small>
          </div>
        </div>
      </a>
    </div>
  @endforeach
</div>

@endsection