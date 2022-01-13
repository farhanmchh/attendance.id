@extends('layout.main')

@section('content')

<h1 class="h3 mb-2">
  <strong>Log</strong> Activity
</h1>

<div class="table-responsive">
  <table class="table table-sm table-hover text-center">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th class="log-classroom">Classroom</th>
        <th>Sign-in</th>
        <th>Sign-out</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($teachers as $teacher)
        <tr>
          <th>{{ $loop->iteration }}</th>
          <td>
            <a href="/teacher/{{ $teacher->slug }}/edit" class="text-decoration-none text-dark">
              {{ $teacher->name }}
            </a>
          </td>
          <td class="log-classroom">
            <a href="/classroom/{{ $teacher->classroom->slug }}/edit" class="text-decoration-none text-dark">
              {{ $teacher->classroom->name }}
            </a>
          </td>
          <td>{{ $teacher->sign_in ? Str::limit(Carbon\Carbon::parse($teacher->sign_in)->diffForHumans(), 6) : '...' }}</td>
          <td>{{ $teacher->sign_out ? Str::limit(Carbon\Carbon::parse($teacher->sign_out)->diffForHumans(), 6) : '...' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection