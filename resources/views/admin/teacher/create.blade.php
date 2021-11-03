@extends('layout.main')

@section('content')

<h1 class="h3 mb-2"><strong>Add</strong> data teacher</h1>

<div class="mb-2">
  <a href="/teacher" class="btn btn-secondary btn-sm">
    <i class="fas fa-arrow-left"></i>
  </a>
</div>

<form action="/teacher" method="POST">
  @csrf

  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <div class="mb-3">
          <label for="" class="form-label fw-bolder">Name</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autofocus>
          @error('name')
            <div class="invalid-feedback ms-2">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="" class="form-label fw-bolder">Email</label>
          <input type="text" name="email" class="email form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
          @error('email')
            <div class="invalid-feedback ms-2">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="" class="form-label fw-bolder">NIP</label>
          <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}">
          @error('nip')
            <div class="invalid-feedback ms-2">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="" class="form-label fw-bolder">Address</label>
          <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="4">{{ old('address') }}</textarea>
          @error('address')
            <div class="invalid-feedback ms-2">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-check mb-3">
          <input class="form-check-input" name="create_account_too" type="checkbox" id="createAccountToo" @if(old('create_account_too')) checked @enderror>
          <label class="form-check-label" for="">
            Create an account for this teacher too
          </label>
        </div>

        <div class="create-account" style="display: none">
          <h5 class="card-title">Account for this teacher access</h5>
          <div class="mb-3">
            <label for="" class="form-label fw-bolder">Email</label>
            <input type="text" name="user_email" class="user-email form-control @error('user_email') is-invalid @enderror" value="{{ old('user_email') }}" placeholder="Fill it for teacher access" readonly>
            @error('user_email')
              <div class="invalid-feedback ms-2">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3" id="password">
            <label for="" class="form-label fw-bolder">Password</label>
            <input type="password" name="user_password" class="form-control @error('user_password') is-invalid @enderror" placeholder="Fill it for teacher access">
            @error('user_password')
              <div class="invalid-feedback ms-2">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3" id="password">
            <label for="" class="form-label fw-bolder">Repeat Password</label>
            <input type="password" name="repeat_user_password" class="form-control @error('repeat_user_password') is-invalid @enderror" placeholder="Repeat password">
            @error('repeat_user_password')
              <div class="invalid-feedback ms-2">
                {{ $message }}
              </div>
            @enderror
          </div>
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