@extends('layout.main')

@section('content')

  <h1 class="h4 mb-2 row justify-content-between gap-2">
    <div class="col-sm-5">
      <strong>Daily</strong> attendance {{ $teacher->classroom->name ?? '' }} ({{ $today_attendance->count() }} from {{ $students->count() }})
    </div>
    <div class="col-sm-3 {{ $weekend ? 'text-danger' : '' }}">
      {{ date('d M Y') }}
    </div>
  </h1>

  @if (date('l') == 'Saturday')
    <h5 class="mb-2">
      <div class="badge bg-info">Today is Saturday, no absences for today</div>
    </h5>
  @elseif (date('l') == 'Monday')
    <h5 class="mb-2">
      <div class="badge bg-info">Today is Monday, no absences for today</div>
    </h5>
  @endif

  @if (session('success'))
    <h5 class="mb-2">
      <div class="badge bg-success">{{ session('success') }}</div>
    </h5>
  @endif

  @if (session('error'))
    <h5 class="mb-2">
      <div class="badge bg-danger">{{ session('error') }}</div>
    </h5>
  @endif

  <div class="table-responsive mb-2">
    <table class="table table-sm table-hover text-center">
      <thead class="text-white" style="background-color: rgb(34,46,60)">
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody class="bg-white">
        @foreach ($students as $key => $student)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $student->name }}</td>
            <td>
              {{-- @if (!$weekend) --}}
                @if ($student->absent_status)
                  @if ($student->absent_status == 'present')
                    <i class="fas fa-check-circle fs-4"></i>
                  @elseif ($student->absent_status == 'permission')
                    <i class="fas fa-clipboard fs-4"></i>
                  @else
                    <i class="fas fa-times-circle fs-4"></i>
                  @endif
                @else
                  <a href="/attendance/{{ $student->slug }}/edit?status=present"
                    class="text-success fs-4 me-1 text-decoration-none"
                    onclick="return confirm('This student is present?')">
                    <i class="fas fa-check-circle"></i>
                  </a>
                  <a href="/attendance/{{ $student->slug }}/edit?status=permission"
                    class="text-info fs-4 me-1 text-decoration-none"
                    onclick="return confirm('This student is permission?')">
                    <i class="fas fa-clipboard"></i>
                  </a>
                  <a href="/attendance/{{ $student->slug }}/edit?status=not present"
                    class="text-danger fs-4 me-1 text-decoration-none"
                    onclick="return confirm('This student is not present?')">
                    <i class="fas fa-times-circle"></i>
                  </a>
                @endif
              {{-- @else --}}
                {{-- ... --}}
              {{-- @endif --}}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection
