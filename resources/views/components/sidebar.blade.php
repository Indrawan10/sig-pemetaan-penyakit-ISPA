<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard.admin') }}">SIG</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard.admin') }}">Sig</a>
        </div>
        <ul class="sidebar-menu">

            <li class="nav-item dropdown ">
                <a href="{{ route('dashboard.admin') }}"
                    class="nav-link "><i class="fas fa-fire"></i><span>Dashboard</span></a>

            </li>

            <li class="nav-item dropdown ">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link"
                            href="{{ route('user.index') }}">User List</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown ">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Data</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link"
                            href="{{ route('list.data') }}">Data List Desa</a>
                    </li>
                    <li>
                        <a class="nav-link"
                            href="{{ route('tambah.data') }}">Tambah Data Desa </a>
                    </li>
                    <li>
                        <a class="nav-link"
                            href="{{ route('tambah.data.penduduk') }}">Tambah Data Penduduk</a>
                    </li>
                    <li>
                        <a class="nav-link"
                            href="{{ route('list.data.penduduk') }}">Data List Penduduk</a>
                    </li>
                    <li>
                        <a class="nav-link"
                            href="{{ route('kasus-ispa.create') }}">Tambah Data Kasus ISPA</a>
                    </li>
                    <li>
                        <a class="nav-link"
                            href="{{ route('kasus-ispa.index') }}">Data List Kasus ISPA</a>
                    </li>
                </ul>
            </li>


    </aside>
</div>
