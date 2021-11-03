@extends('layout.main')

@section('content')

<h1 class="h3 mb-2">
  <strong>Class</strong> list ({{ $classes->count() }})
</h1>

@if (session('success'))
  <h4 class="mb-2">
    <div class="badge bg-success">{{ session('success') }}</div>
  </h4>
@endif
@if (session('error'))
  <h4 class="mb-2">
    <div class="badge bg-danger">{{ session('error') }}</div>
  </h4>
@endif

<div class="mb-2">
  <a href="/classroom/create" class="btn btn-primary btn-sm">
    <i class="fas fa-plus"></i>
  </a>
</div>

<div class="row justify-content-center">
  @foreach ($classes as $class)
    <div class="col-sm-3 text-center">
      <a href="/classroom/{{ $class->slug }}/edit" class="text-decoration-none">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ $class->name }}</h5>
            <small class="text-muted">{{ $class->teacher->name ?? '...' }}</small>
          </div>
        </div>
      </a>
    </div>
  @endforeach
</div>

@endsection