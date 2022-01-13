@extends('layout.main')

@section('content')
  
<h1 class="h3 mb-2">
  <strong>Analytics</strong> Dashboard
</h1>

<h4 class="mb-2">
  <div class="badge" style="background-color: {{ $badge_bg ?? '#1cbb8c' }}">{{ $regards }}</div>
</h4>

@endsection