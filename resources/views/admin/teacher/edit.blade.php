@extends('layout.main')

@section('content')

  <h1 class="h3 mb-2">
    <strong>Edit</strong> teacher data
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
    <a href="/teacher" class="btn btn-secondary btn-sm">
      <i class="fas fa-arrow-left"></i>
    </a>
  </div>


  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <form action="/teacher/{{ $teacher->slug }}" method="POST">
          @method('put')
          @csrf

          <div class="mb-3">
            <label for="" class="form-label fw-bolder">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name') ?? $teacher->name }}" autofocus>
            @error('name')
              <div class="invalid-feedback ms-2">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="" class="form-label fw-bolder">Email</label>
            <input type="text" name="email" class="email form-control @error('email') is-invalid @enderror"
              value="{{ old('email') ?? $teacher->email }}">
            @error('email')
              <div class="invalid-feedback ms-2">
                {{ $message }}
              </div>
            @enderror
            @if (session('error_email'))
              <p class="text-danger mb-2 ms-2">{{ session('error_email') }}</p>
            @endif
          </div>
          <div class="mb-3">
            <label for="" class="form-label fw-bolder">NIP</label>
            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
              value="{{ old('nip') ?? $teacher->nip }}">
            @error('nip')
              <div class="invalid-feedback ms-2">
                {{ $message }}
              </div>
            @enderror
            @if (session('error_nip'))
              <p class="text-danger mb-2 ms-2">{{ session('error_nip') }}</p>
            @endif
          </div>
          <div class="mb-3">
            <label for="" class="form-label fw-bolder">Address</label>
            <textarea name="address" class="form-control @error('address') is-invalid @enderror"
              rows="4">{{ old('address') ?? $teacher->address }}</textarea>
            @error('address')
              <div class="invalid-feedback ms-2">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3 row">
            <label for="" class="col-sm-5 col-form-label fw-bolder">Homeroom Teacher :</label>
            <div class="col-sm-3 pt-1 text-center">
              <p class="class-name fw-bolder">{{ $teacher->classroom->name ?? '...' }}</p>
            </div>
            <div class="col-sm-4 text-end pt-1">
              <a href="/teacher/release/{{ $teacher->slug }}"
                class="release-btn btn btn-outline-info btn-sm rounded-pill d-none"
                onclick="return confirm('Are you sure?')">Release</a>
            </div>
          </div>

          @if (!$teacher->account)
            <div class="form-check mb-3">
              <input class="form-check-input" name="create_account_too" type="checkbox" id="createAccountToo" @if (old('create_account_too')) checked @enderror>
              <label class="form-check-label" for="">
                Create an account for this teacher too
              </label>
            </div>
          @endif

          @if ($user)
            <input type="hidden" name="account" value="1">
          @endif

          <div class="create-account" style="display: none">
            <h5 class="card-title">Account for this teacher access</h5>
            <div class="mb-3">
              <label for="" class="form-label fw-bolder">Email</label>
              <input type="text" name="user_email"
                class="user-email form-control @error('user_email') is-invalid @enderror" readonly>
              @error('user_email')
                <div class="invalid-feedback ms-2">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3" id="password">
              <label for="" class="form-label fw-bolder">Password</label>
              <input type="password" name="user_password"
                class="form-control @error('user_password') is-invalid @enderror"
                placeholder="Fill it for teacher access">
              @error('user_password')
                <div class="invalid-feedback ms-2">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3" id="password">
              <label for="" class="form-label fw-bolder">Repeat Password</label>
              <input type="password" name="repeat_user_password"
                class="form-control @error('repeat_user_password') is-invalid @enderror" placeholder="Repeat password">
              @error('repeat_user_password')
                <div class="invalid-feedback ms-2">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <div class="row">
            <div class="col-sm-10 d-grid mb-2">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Update
              </button>
            </div>
            <div class="col-sm-2 d-grid mb-2">
              <form action="/teacher/{{ $teacher->slug }}" method="POST">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </div>
          </div>

        </form>

      </div>
    </div>
  </div>

@endsection
