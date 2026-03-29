<div class="sidenav">
  <ul class="side_menu">
    <li class="menu-item {{ Route::is('personalinfo') == true ? 'active' : '' }}">
      <a href="{{route('personalinfo')}}" class="d-flex align-items-center justify-content-between">
        <span><img src="{{asset('assets/frontend/assets/img/country/uk.jpg')}}" alt=""> Profile & Personal Info </span>
        <i class="bi bi-chevron-right"></i>
      </a>
    </li>
    <li class="menu-item {{ Route::is('academicinfo') == true ? 'active' : '' }}">
      <a href="{{route('academicinfo')}}" class="d-flex align-items-center justify-content-between">
        <span>
          <img src="{{asset('assets/frontend/assets/img/country/germany.jpg')}}" alt=""> Academic Information </span>
        <i class="bi bi-chevron-right"></i>
      </a>
    </li>
    <li class="menu-item {{ Route::is('documentmanager') == true ? 'active' : '' }}">
      <a href="{{route('documentmanager')}}" class="d-flex align-items-center justify-content-between">
        <span>
          <img src="{{asset('assets/frontend/assets/img/country/usa.jpg')}}" alt=""> Document Uploads </span>
        <i class="bi bi-chevron-right"></i>
      </a>
    </li>
    <li class="menu-item {{ Route::is('progress') == true ? 'active' : '' }}">
      <a href="{{route('progress')}}" class="d-flex align-items-center justify-content-between">
        <span>
          <img src="{{asset('assets/frontend/assets/img/country/canada.jpg')}}" alt=""> Application Progress </span>
        <i class="bi bi-chevron-right"></i>
      </a>
    </li>
    <li class="menu-item {{ Route::is('invoices') == true ? 'active' : '' }}">
      <a href="{{route('invoices')}}" class="d-flex align-items-center justify-content-between">
        <span>
          <img src="{{asset('assets/frontend/assets/img/country/finland.jpg')}}" alt=""> Payments & Fees </span>
        <i class="bi bi-chevron-right"></i>
      </a>
    </li>
    <li class="menu-item {{ Route::is('notices') == true ? 'active' : '' }}">
      <a href="{{route('notices')}}" class="d-flex align-items-center justify-content-between">
        <span>
          <img src="{{asset('assets/frontend/assets/img/country/australia.jpg')}}" alt=""> Notices </span>
        <i class="bi bi-chevron-right"></i>
      </a>
    </li>
  </ul>
</div>