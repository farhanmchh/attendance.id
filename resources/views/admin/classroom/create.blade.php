@extends('layout.main')

@section('content')

<h1 class="h3 mb-2">
  <strong>Create</strong> class
</h1>

<div class="mb-2">
  <a href="/classroom" class="btn btn-secondary btn-sm">
    <i class="fas fa-arrow-left"></i>
  </a>
</div>

<form action="/classroom" method="POST">
  @csrf

  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <div class="mb-3">
          <label for="" class="form-label fw-bolder">Name</label>
          <input type="text" name="name" class="form-control" autocomplete="off" autofocus>
        </div>
        <div class="mb-3">
          <label for="" class="form-label fw-bolder">Teacher <sup>(opt)</sup></label>
          <select name="teacher_id" class="form-select">
            <option></option>
            @foreach ($teachers as $teacher)
              <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create
          </button>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection