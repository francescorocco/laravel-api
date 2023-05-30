<div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary">
    <a href="/" class="mb-3 mb-md-0 me-md-auto text-decoration-none">
      <span class="fs-3">Boolfolio</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="{{route('admin.dashboard')}}" class="nav-link @if(Route::currentRouteName()=='admin.dashboard') active @endif" aria-current="page">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
            Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.works.index')}}" class="nav-link @if(Route::currentRouteName()=='admin.works.index') active @endif"" aria-current="page">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
            Lista Progetti
        </a>
      </li>
    </ul> 
</div>