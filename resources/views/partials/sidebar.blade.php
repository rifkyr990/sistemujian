<ul class="navbar-nav bg-primary-dashboard sidebar sidebar-dark accordion d-flex flex-column" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center bg-light" href="{{ url('/') }}">
        <div class="sidebar-brand-text mx-3">
            <img src="{{ asset('img/logo-blue.png') }}" width="125px">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('admin.dashboard.index') }}">
            <img src="{{ asset('img/home-icon.png') }}" alt="" class="mr-2 w-auto">
            <span class="text-light mt-1">{{ __('Dashboard') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Additional Menu Items -->
    @can('user_management_access')
    <li class="nav-item">
        <a class="nav-link btn btn-outline-primary" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="text-light">{{ __('User Management') }}</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}"
                    href="{{ route('admin.permissions.index') }}"> <i class="fa fa-briefcase mr-2"></i>
                    {{ __('Permissions') }}</a>
                <a class="collapse-item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}"
                    href="{{ route('admin.roles.index') }}"><i class="fa fa-briefcase mr-2"></i> {{ __('Roles') }}</a>
                <a class="collapse-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}"> <i class="fa fa-user mr-2"></i> {{ __('Users') }}</a>
            </div>
        </div>
    </li>
    @endcan

    @can('user_management_access')
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true"
            aria-controls="collapseFive">
            <i class="fa fa-folder-open" aria-hidden="true"></i>
            <span class="text-light">{{ __('Data Mapel') }}</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a href="{{ url('admin/mapel/kelas/7') }}"
                    class="collapse-item {{ request()->is('admin/mapel/kelas/7') ? 'active' : '' }}">Kelas 7</a>
                <a href="{{ url('admin/mapel/kelas/8') }}"
                    class="collapse-item {{ request()->is('admin/mapel/kelas/8') ? 'active' : '' }}">Kelas 8</a>
                <a href="{{ url('admin/mapel/kelas/9') }}"
                    class="collapse-item {{ request()->is('admin/mapel/kelas/9') ? 'active' : '' }}">Kelas 9</a>
            </div>
        </div>
    </li>
    @endcan

    @can('guru_access')
    <li class="nav-item {{ request()->is('admin/guru/mata-pelajaran') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('guru.categories') }}">
            <i class="fas fa-cogs"></i>
            <span class="text-light">{{ __('Kelas') }}</span>
        </a>
    </li>
    @endcan

    @can('siswa_access')
    <li class="nav-item {{ request()->is('admin/siswa*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.siswa.kelas') }}">
            <i class="fas fa-cogs"></i>
            <span class="text-light">{{ __('Kelas siswa') }}</span>
        </a>
    </li>
    @endcan

    @can('user_management_access')
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
            aria-controls="collapseThree">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="text-light">{{ __('Data Guru') }}</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a href="{{ url('admin/guru/kelas/7') }}"
                    class="collapse-item {{ request()->is('admin/guru/kelas/7') ? 'active' : '' }}">Kelas 7</a>
                <a href="{{ url('admin/guru/kelas/8') }}"
                    class="collapse-item {{ request()->is('admin/guru/kelas/8') ? 'active' : '' }}">Kelas 8</a>
                <a href="{{ url('admin/guru/kelas/9') }}"
                    class="collapse-item {{ request()->is('admin/guru/kelas/9') ? 'active' : '' }}">Kelas 9</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true"
            aria-controls="collapseFour">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="text-light">{{ __('Data Siswa') }}</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a href="{{ url('admin/siswa/kelas/7') }}"
                    class="collapse-item {{ request()->is('admin/siswa/kelas/7') ? 'active' : '' }}">Kelas 7</a>
                <a href="{{ url('admin/siswa/kelas/8') }}"
                    class="collapse-item {{ request()->is('admin/siswa/kelas/8') ? 'active' : '' }}">Kelas 8</a>
                <a href="{{ url('admin/siswa/kelas/9') }}"
                    class="collapse-item {{ request()->is('admin/siswa/kelas/9') ? 'active' : '' }}">Kelas 9</a>
            </div>
        </div>
    </li>
    @endcan

    @can('user_management_access')
    <li class="nav-item {{ request()->is('admin/categories') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <span class="text-light">{{ __('Jadwal ujian') }}</span>
        </a>
    </li>
    @endcan

    @can('user_management_access')
    <li class="nav-item {{ request()->is('admin/questions') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.questions.index') }}">
            <i class="fas fa-cogs"></i>
            <span class="text-light">{{ __('Pertanyaan') }}</span>
        </a>
    </li>
    @endcan

    @can('result_access')
    <li class="nav-item mb-5 {{ request()->is('admin/results') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.results.index') }}">
            <i class="fas fa-cogs"></i>
            <span class="text-light">{{ __('Data Nilai') }}</span>
        </a>
    </li>
    @endcan

    <!-- Button Keluar -->
    <li class="nav-item mt-5">
        <a class="nav-link" href="">
        <i class="bi bi-box-arrow-right"></i>
            <span class="text-light">{{ __('Keluar') }}</span>
        </a>
    </li>
</ul>
