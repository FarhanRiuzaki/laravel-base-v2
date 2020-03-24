<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('home') }}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Dashboard</span></a></li>
                <li class="list-divider"></li>
            
            @role('Admin|super-admin')
                {{-- SETTING --}}
                <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>

                @if (auth()->user()->can('apps-show'))
                <li class="sidebar-item {{ set_active('apps*') }}"> 
                    <a class="sidebar-link sidebar-link" href="{{ route('apps.index')}}" aria-expanded="false">
                        <i data-feather="edit-3" class="feather-icon"></i>
                        <span class="hide-menu">Apps Setting</span>
                    </a>
                </li>
                @endif

                @if (auth()->user()->can('role-show'))
                <li class="sidebar-item {{ set_active('roles*') }}">
                    <a href="{{ route('roles.index') }}" class="sidebar-link sidebar-link">
                        <i class="fas fa-circle-notch nav-icon"></i>
                        <span class="hide-menu">Roles</span>
                    </a>
                </li>
                @endif

                @if (auth()->user()->can('role permission-show'))
                <li class="sidebar-item {{ set_active('users.roles_permission') }}">
                    <a href="{{ route('users.roles_permission') }}" class="sidebar-link sidebar-link">
                        <i class="fas fa-clipboard-check nav-icon"></i>
                        <span class="hide-menu">Role Permissions</span>
                    </a>
                </li>
                @endif

                @if (auth()->user()->can('users-show'))
                <li class="sidebar-item {{ set_active('users.create') . set_active('users.edit') . set_active('users.roles') }} ">
                    <a href="{{ route('users.index') }}" class="sidebar-link sidebar-link">
                        <i class="fas fa-user-circle nav-icon"></i>
                        <span class="hide-menu">Users</span>
                    </a>
                </li>
                @endif

            @endrole

                <li class="sidebar-item"> 
                    <a class="sidebar-link sidebar-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" aria-expanded="false">
                        <i data-feather="log-out" class="feather-icon"></i>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->