@extends('layout.main')

@section('content')

  <h1 class="h3 mb-2">
    <strong>Edit</strong> student mode
  </h1>

  <div class="mb-2">
    <a href="/student" class="btn btn-secondary btn-sm">
      <i class="fas fa-arrow-left"></i>
    </a>
  </div>

  <form action="/student/{{ $student->slug }}" method="POST">
    @method('PUT')
    @csrf

    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="mb-3">
            <label for="" class="form-label fw-bolder">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name') ?? $student->name }}" autofocus>
            @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="" class="form-label fw-bolder">NIS</label>
            <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror"
              value="{{ old('nis') ?? $student->nis }}">
            @error('nis')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
            @if (session('error_nis'))
              <p class="text-danger mb-2 ms-2">{{ session('error_nis') }}</p>
            @endif
          </div>
          <div class="mb-3">
            <label for="" class="form-label fw-bolder">Class</label>
            <select name="classroom_id" class="form-select @error('classroom_id') is-invalid @enderror">
              @foreach ($classes as $class)
                @if ($student->classroom_id == $class->id)
                  <option value="{{ $class->id }}" selected>{{ $class->name }}</option>
                @else
                  <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endif
              @endforeach
            </select>
            @error('classroom_id')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="" class="form-label fw-bolder">Address</label>
            <textarea name="address" rows="4"
              class="form-control @error('address') is-invalid @enderror">{{ old('address') ?? $student->address }}</textarea>
            @error('address')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="row">
            <div class="col-sm-10 d-grid mb-2">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Update
              </button>
            </div>
            <div class="col-sm-2 d-grid mb-2">
              <form action="/student/{{ $student->slug }}" method="POST">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </form>


@endsection
