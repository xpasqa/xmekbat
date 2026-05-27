@section('sidebar')
<aside class="main-sidebar sidebar-dark-primary bg-blueprimary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.index')}}" class="brand-link admin-brand-link">
        <span class="brand-initial">LM</span>
        <span class="brand-text font-weight-bold">Lab Mekbat</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ URL::asset('admin/dist/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'tester')
                <li class="nav-header">Laboratory</li>
                <li class="nav-item">
                    <a href="{{route('admin.manageProject')}}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            Labtest
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role == 'admin')
                <li class="nav-header">Setting</li>
                <li class="nav-item">
                    <a href="{{route('admin.manageUser')}}" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.manageSample')}}" class="nav-link">
                        <i class="nav-icon fas fa-pen"></i>
                        <p>
                            Sample
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'editor')
                    <li class="nav-header">Editorial</li>
                    <li class="nav-item">
                        <a href="{{route('admin.managePeople')}}" class="nav-link">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                People
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.manageJournals')}}" class="nav-link">
                            <i class="nav-icon fas fa-journal-whills"></i>
                            <p>
                                Research
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.manageNews')}}" class="nav-link">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                News & IRMS
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.manageTag')}}" class="nav-link">
                            <i class="nav-icon fas fa-hashtag"></i>
                            <p>
                                News Tags
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.manageSlider')}}" class="nav-link">
                            <i class="nav-icon fas fa-sliders-h"></i>
                            <p>
                                Slider Management
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.managePricelist')}}" class="nav-link">
                            <i class="nav-icon fas fa-paperclip"></i>
                            <p>
                                Pricelist Management
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        <div class="sidebar-logout">
            <a href="{{ route('auth.logout') }}" class="nav-link">
                <i class="nav-icon fas fa-door-open"></i>
                <p>Logout</p>
            </a>
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
@endsection
