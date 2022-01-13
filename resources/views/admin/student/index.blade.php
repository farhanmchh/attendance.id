@extends('layout.main')

@section('content')

<h1 class="h3 mb-2">
  <span>
    <a href="/student" class="text-decoration-none text-dark">
      <strong>Student</strong> list
      <span class="student-header">{{ $class_name ? $students[0]->classroom->name : '' }}</span>
      (<span class="student-total" title="student total">{{ $count }}</span>)
    </a>
  </span>
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

<div class="row justify-content-between">
  <div class="col-sm-3 mb-2">
    <a href="/student/create" class="btn btn-primary btn-sm" title="add student">
      <i class="fas fa-plus"></i>
    </a>
  </div>
  <div class="col-sm-3 mb-2">
    <select name="filter_student" id="" class="filter-student form-select form-select-sm text-center" title="filter student by class name">
      <option></option>
      @foreach ($classes as $class)
        <option value="{{ $class->slug }}" @if(request('filter')==$class->slug) selected @endif>{{ $class->name }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="table-responsive">
  <table class="table table-sm table-hover table- text-center">
    <thead class="text-white" style="background-color: rgb(34,46,60)">
      <tr>
        <th>No</th>
        <th>Name</th>
        <th class="student-nis">NIS</th>
        <th class="student-class">Class</th>
      </tr>
    </thead>
    <tbody class="student-row-container">
      @foreach ($students as $student)
        <tr>
          <td>
            <a href="/student/{{ $student->slug }}/edit" class="text-decoration-none text-dark">
              {{ $loop->iteration + $numbering }}
            </a>
          </td>
          <td>
            <a href="/student/{{ $student->slug }}/edit" class="text-decoration-none text-dark">
              {{ $student->name }}
            </a>
          </td>
          <td class="student-nis">
            <a href="/student/{{ $student->slug }}/edit" class="text-decoration-none text-dark">
              {{ $student->nis }}
            </a>
          </td>
          <td class="student-class">
            <a href="/classroom/{{ $student->classroom->slug }}/edit" class="text-decoration-none text-dark">
              {{ $student->classroom->name }}
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@if (!request('filter'))
<div class="student-pagination d-flex justify-content-center">
    {{ $students->withQueryString()->links() }}
  </div>
@endif

@endsection