<nav id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="index.html">
      <i class="fas fa-address-book"></i>
      <span class="align-middle">Attendance<sup>ID</sup></span>
    </a>

    @if (auth()->user()->role == 'master')

    {{-- SIDEBAR FOR MASTER --}}
      <ul class="sidebar-nav">
        <li class="sidebar-header">
          Administrator
        </li>
        
        <li class="sidebar-item {{ Request::is('dashboard*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/dashboard">
            <i class="fas fa-sliders-h align-middle"></i> <span class="align-middle">Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item {{ Request::is('teacher*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/teacher">
            <i class="fas fa-chalkboard-teacher align-middle"></i> <span class="align-middle">Teachers</span>
          </a>
        </li>
        <li class="sidebar-item {{ Request::is('classroom*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/classroom">
            <i class="fas fa-graduation-cap align-middle"></i> <span class="align-middle">Classes</span>
          </a>
        </li>
        <li class="sidebar-item {{ Request::is('student*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/student">
            <i class="fas fa-users align-middle"></i> <span class="align-middle">Students</span>
          </a>
        </li>
        
        <li class="sidebar-header">
          Log
        </li>

        <li class="sidebar-item {{ Request::is('log*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/log">
            <i class="fas fa-life-ring align-middle"></i> <span class="align-middle">Log Activity</span>
          </a>
        </li>
      </ul>
    {{-- END SIDEBAR FOR MASTER --}}

    @else

    {{-- SIDEBAR FOR TEACHER --}}
      <ul class="sidebar-nav">
        <li class="sidebar-header">
          Attendance
        </li>
        
        <li class="sidebar-item {{ Request::is('attendance*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/attendance">
            <i class="fas fa-calendar-day align-middle"></i> <span class="align-middle">Attendance</span>
          </a>
        </li>
        <li class="sidebar-item {{ Request::is('report*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/report">
            <i class="fas fa-flag align-middle"></i> <span class="align-middle">Report</span>
          </a>
        </li>
      </ul>
    {{-- END SIDEBAR FOR TEACHER --}}

    @endif
  </div>
</nav>