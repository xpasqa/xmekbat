@section('navbar')

    <body class="fill-white">
        <!-- navbar  -->
        <nav class="navbar px-md-5 py-1 navbar-expand-lg fill-white">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{ URL::asset('/images/logofix.png') }}" class="logonav" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav navbar-collapse justify-content-md-center mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link font-bold color-dark {{ request()->routeIs('login') ? 'active ' : '' }}"
                                aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-bold color-dark {{ request()->routeIs('about.aboutPage') ? 'active ' : '' }}"
                                href="{{ route('about.aboutPage') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-bold color-dark {{ request()->routeIs('journals.index') ? 'active ' : '' }}"
                                href="{{ url('journals/pages/1') }}">Research</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-bold color-dark {{ request()->routeIs('people.index') ? 'active ' : '' }}"
                                href="{{ route('people.index') }}">People</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-bold color-dark {{ request()->routeIs('news.index') ? 'active ' : '' }}"
                                href="{{ route('news.index', ['current_page' => 1]) }}">News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-bold color-dark {{ request()->routeIs('news.irmsView') ? 'active ' : '' }}"
                                href="{{ route('news.irmsView', ['current_page' => 1]) }}">IRMS</a>
                        </li>
                    </ul>


                    @if (Auth::user() != null)
                        <!-- After login  -->
                        <div class="user-profile">
                            <span class="mx-2">{{ Auth::user()->name }}</span>
                            <div class="btn-group">
                                <div class="" type="" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img src="{{ URL::asset('assets/images/user.png') }}" width="30px" alt="user">
                                </div>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="{{ route('user.index') }}">Lab Test</a></li>
                                    <li><a class="dropdown-item" href="{{ route('auth.logout') }}">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- After login  -->
                    @else
                        <!-- Button trigger modal Login -->
                        <button type="button" class="btn btn-sm button-primary py-2 px-5" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Client Portal
                        </button>
                    @endif
                </div>
            </div>
        </nav>
        <!-- end navbar  -->

        <hr class="m-0">
    @endsection
