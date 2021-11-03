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
  @method('put')
  @csrf

  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <div class="mb-3">
          <label for="" class="form-label fw-bolder">Name</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $student->name }}" autofocus>
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="" class="form-label fw-bolder">NISN</label>
          <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn') ?? $student->nisn }}">
          @error('nisn')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
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
          <textarea name="address" rows="4" class="form-control @error('address') is-invalid @enderror">{{ old('address') ?? $student->address }}</textarea>
          @error('address')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-paper-plane"></i> Update
          </button>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection