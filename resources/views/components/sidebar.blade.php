<div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4"><!-- Brand Logo -->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <i class="fas fa-cat"></i>
        <span class="brand-text font-weight-light">PetsQu Shop</span>
        </a>
    
        <!-- Sidebar -->
        <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (Auth::user()->profile_photo_path == NULL)
                <img src="{{ asset('AdminLTE/avatar/avatar-1.png') }}" class="img-circle elevation-2" alt="User Image">
                @else
                <img src="{{ asset('profile_photo/'.Auth::user()->profile_photo_path) }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
    
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-header">Main Navigation</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active':'' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link {{ Route::is('products.index') ? 'active':'' }}">
                    <i class="nav-icon fas fa-box-open"></i>
                    <p>
                        Produk
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transactions.index') }}" class="nav-link {{ Route::is('transactions.index') ? 'active':'' }}">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>
                        Permintaan Pembelian
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('members.index') }}" class="nav-link {{ Route::is('members.index') ? 'active':'' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Member
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="nav-link">
                    <i class="nav-icon fas fa-power-off"></i>
                    <p>
                        Logout
                    </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
        <!-- /.sidebar -->
    </aside>
</div>