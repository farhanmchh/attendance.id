@extends('layout.main')

@section('content')

<h1 class="h3 mb-2">
  <strong>Student</strong> list ({{ $students->count() }})
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
  <a href="/student/create" class="btn btn-primary btn-sm">
    <i class="fas fa-plus"></i>
  </a>
</div>

<div class="table-responsive">
  <table class="table table-sm table-hover table- text-center">
    <thead class="text-white" style="background-color: rgb(34,46,60)">
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>NIS</th>
        <th>Class</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($students as $student)
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
          <td>
            <a href="/student/{{ $student->slug }}/edit" class="text-decoration-none text-dark">
              {{ $student->nisn }}
            </a>
          </td>
          <td>
            <a href="/classroom/{{ $student->classroom->slug }}/edit" class="text-decoration-none text-dark">
              {{ $student->classroom->name }}
            </a>
          </td>
          <td>
            <form action="/student/{{ $student->slug }}" method="POST">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection