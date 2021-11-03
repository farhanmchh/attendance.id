@extends('layout.main')

@section('content')

<h1 class="h3 mb-2">
  <strong>Edit</strong> data class
</h1>

@if (session('success'))
  <h4 class="mb-2">
    <div class="badge bg-success">{{ session('success') }}</div>
  </h4>
@endif

<div class="mb-2">
  <a href="/classroom" class="btn btn-secondary btn-sm">
    <i class="fas fa-arrow-left"></i>
  </a>
</div>

<form action="/classroom/{{ $class->slug }}" method="POST">
  @method('PUT')
  @csrf

  <div class="row">
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <div class="mb-3">
            <label for="" class="form-label fw-bolder">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') ?? $class->name }}" autocomplete="off" autofocus>
          </div>
          <div class="mb-3">
            <label for="" class="form-label fw-bolder d-block m-0">Teacher : 
              @if (!$class->teacher)
                ...
              @else
                <a href="/teacher/{{ $class->teacher->slug }}/edit" class="text-decoration-none text-secondary">
                  {{ $class->teacher->name }}
                </a>
              @endif
            </label>
            @if (!$class->teacher_id)
            <small class="text-danger">This class doesn't have a teacher yet</small>
            @else
            <small class="text-success">Edit teacher for this class</small>
            @endif
            <input type="hidden" name="old_teacher_id" value="{{ $class->teacher->id ?? '' }}">
            <select name="teacher_id" class="form-select">
              <option></option>
              @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
              @endforeach
            </select>
          </div>
  
          <div class="d-grid">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')">
              <i class="fas fa-paper-plane"></i> Update
            </button>
          </div>
        </div>
      </div>
    </div>
  
    <div class="col-md-7">
      <div class="card">
        <span class="position-absolute top-0 start-100 translate-middle p-2 badge border border-2 border-white rounded-pill bg-secondary">{{ $class->student->count() }}</span>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm text-center">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($class->student as $student)
                  <tr>
                    <td>
                      <a href="/student/{{ $student->slug }}/edit" class="text-decoration-none text-dark">
                        {{ $loop->iteration }}
                      </a>
                    </td>
                    <td>
                      <a href="/student/{{ $student->slug }}/edit" class="text-decoration-none text-dark">
                        {{ $student->name }}
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</form>

@endsection