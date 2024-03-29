<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="/dashboard" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Informax</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{asset('img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{auth()->user()->name }}</h6>
                @php
                   $roles = Auth::user()->getRoleNames();
                @endphp
                <span>{{ $roles[0] }}</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="/dashboard" class="nav-item nav-link {{ Route::is('dashboard') ? 'active' : '' }}"><i class="fa fa-tachometer-alt me-2 "></i>Dashboard</a>
            {{-- <a href="{{ route('admin-role.index') }}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Roles</a> --}}
           @hasanyrole('super-admin|admin')
               
           <div class="nav-item dropdown">
               <a href="#" class="nav-link dropdown-toggle {{ Route::is('admin-role.index') ||  Route::is('admin-role.create') ||  Route::is('admin-role.edit') ||  Route::is('admin-permission.index') ||  Route::is('admin-permission.create')  || Route::is('permission-role.edit') ? 'active' : '' }}" data-bs-toggle="dropdown"><i class="fas fa-project-diagram me-2"></i>Roles</a>
               <div class="dropdown-menu bg-transparent border-0">
                   <a href="{{ route('admin-role.index') }}" class="dropdown-item  {{ Route::is('admin-role.index') ? 'active' : '' }}">All Roles</a>
                   <a href="{{ route('admin-role.create') }}" class="dropdown-item {{ Route::is('admin-role.create') ? 'active' : '' }}">Create Role</a>
                   <a href="{{ route('admin-permission.index') }}" class="dropdown-item {{ Route::is('admin-permission.index') ? 'active' : '' }}">All Permission</a>
                   <a href="{{ route('admin-permission.create') }}" class="dropdown-item {{ Route::is('admin-permission.create') ? 'active' : '' }}">Create Permission</a>
               </div>
           </div>   
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ Route::is('admin-user.index') ||  Route::is('admin-user.create') ||  Route::is('admin-user.edit') ? 'active' : '' }}" data-bs-toggle="dropdown"><i class="fas fa-users me-2"></i>Users</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('admin-user.index') }}" class="dropdown-item  {{ Route::is('admin-user.index') ? 'active' : '' }}">All Users</a>
                    <a href="{{ route('admin-user.create') }}" class="dropdown-item {{ Route::is('admin-user.create') ? 'active' : '' }}">Create User</a>
                </div>
            </div>
            @endhasanyrole
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Elements</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="button.html" class="dropdown-item">Buttons</a>
                    <a href="typography.html" class="dropdown-item">Typography</a>
                    <a href="element.html" class="dropdown-item">Other Elements</a>
                </div>
            </div>
            <a href="/post" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Posts</a>
            <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
            <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
            <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
            <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="signin.html" class="dropdown-item">Sign In</a>
                    <a href="signup.html" class="dropdown-item">Sign Up</a>
                    <a href="404.html" class="dropdown-item">404 Error</a>
                    <a href="blank.html" class="dropdown-item">Blank Page</a>
                </div>
            </div>
        </div>
    </nav>
</div>