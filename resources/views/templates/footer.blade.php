@section('footer')
<div class="container-fluid bg-primary text-white">
    <div class="container">
        <div class="row gx-5">
            <div class="col-12">
                <div class="row gx-5">
                    <div class="col-lg-6 col-md-12 pt-5 mb-5">
                        <img src="{{ url('assets/images/logogeoitbwhite.png')}}" width="300px" alt="logo" >
                        <div class="d-flex my-3">
                            <p class="text-white mb-0">Department of Mining Engineering <br> Bandung Institute of Technology <br>Tel: (+62) 22 2502239</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h4 class="text-white mb-4">About</h4>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2 text-decoration-none" href="{{route('about.aboutPage')}}">Vision & Mission</a>
                            <a class="text-white mb-2 text-decoration-none" href="{{route('journals.index', ['current_page' => 1])}}">Thesis</a>
                            <a class="text-white mb-2 text-decoration-none" href="{{route('people.index')}}">Publication</a>
                            <a class="text-white mb-2 text-decoration-none" href="{{route('news.index', ['current_page' => 1])}}">News</a>
                            <a class="text-white mb-2 text-decoration-none" href="{{route('news.irmsView', ['current_page' => 1])}}">IRMS</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h4 class="text-white mb-4">Client Portal</h4>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2 text-decoration-none" href="JavaScript:void(0)">Login</a>
                            <a class="text-white mb-2 text-decoration-none" href="JavaScript:void(0)">Signup</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
