@extends('layout.main')

@section('content')

<h1 class="h3 mb-2">
  <strong>Add</strong> student
</h1>

<div class="mb-2">
  <a href="/student" class="btn btn-secondary btn-sm">
    <i class="fas fa-arrow-left"></i>
  </a>
</div>

<form action="/student" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <div class="mb-3">
          <label for="" class="form-label fw-bolder">Name</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autofocus>
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="" class="form-label fw-bolder">NIS</label>
          <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror" value="{{ old('nis') }}">
          @error('nis')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="" class="form-label fw-bolder">Class</label>
          <select name="classroom_id" class="form-select @error('classroom_id') is-invalid @enderror">
            <option></option>
            @foreach ($classes as $class)
              @if (old('classroom_id') == $class->id)
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
          <textarea name="address" rows="4" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
          @error('address')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3">
          <input type="file" name="importFile" class="form-control">
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add
          </button>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection