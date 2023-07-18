<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuthorisation" aria-expanded="true" aria-controls="collapseAuthorisation">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Authorisations</span>
    </a>
    <div id="collapseAuthorisation" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Authorisations</h6>
        <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
        <a class="collapse-item" href="{{ route('permissions.index') }}">Permissions</a>
      </div>
    </div>
  </li>