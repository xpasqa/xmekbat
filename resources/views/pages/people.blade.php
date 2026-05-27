    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ URL::asset('/dist/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ URL::asset('/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ URL::asset('/dist/css/style.css') }}" rel="stylesheet">
    @extends('templates.header')



    <body class="fill-white">
        <!-- body  -->

        @extends('templates.navbar')
        @section('content')
            <!-- Hero Start -->
            <div class="container-fluid bg-primary py-5 bg-about mb-5">
                <div class="container py-5">
                    <div class="row justify-content-start">
                        <div class="col-lg-12 text-center">
                            <h1 class="display-1 text-white mb-md-4">People</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hero End -->

            <!-- Content Start -->
            <div class="container">
                <div class="col-lg-12">

                    @foreach ($people as $row)
                        <!-- people 1 -->
                        <div class="row my-5 justify-content-around align-items-center">
                            <div class="col-md-2">
                                <img src="{{url('storage/people/'.$row->image.'')}}" width="100%" class="people-img" alt="{{ route('people.peopleDetail', ['slug' => $row->slug]) }}">
                            </div>
                            <div class="col-md-8">
                                <h5 class="title m-0 p-0 people-img" alt="{{ route('people.peopleDetail', ['slug' => $row->slug]) }}">{{$row->name}}</h5>
                                <p class="subtitle mb-3 p-0">{{$row->position}}</p>
                                <p class="">
                                    {{ truncate($row->description, 450) }}
                                    <a href="{{ route('people.peopleDetail', ['slug' => $row->slug]) }}" class="text-decoration-none text-italic">Learn
                                        More</a>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Content End -->

            <!-- Footer Start -->
            <div class="container-fluid bg-primary text-white">
                <div class="container">
                    <div class="row gx-5">
                        <div class="col-12">
                            <div class="row gx-5">
                                <div class="col-lg-6 col-md-12 pt-5 mb-5">
                                    <img src="{{ URL::asset('assets/images/logogeoitbwhite.png') }}" width="300px" alt="logo">
                                    <div class="d-flex my-3">
                                        <p class="text-white mb-0">Department of Mining Engineering <br> Bandung Institute
                                            of Technology <br>Tel: (+62) 22 2502239</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12 pt-0 pt-lg-5 mb-5">
                                    <h4 class="text-white mb-4">About</h4>
                                    <div class="d-flex flex-column justify-content-start">
                                        <a class="text-white mb-2 text-decoration-none" href="#">Vision & Mission</a>
                                        <a class="text-white mb-2 text-decoration-none" href="#">Thesis</a>
                                        <a class="text-white mb-2 text-decoration-none" href="#">Publication</a>
                                        <a class="text-white mb-2 text-decoration-none" href="#">News</a>
                                        <a class="text-white mb-2 text-decoration-none" href="#">IRMS</a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12 pt-0 pt-lg-5 mb-5">
                                    <h4 class="text-white mb-4">Client Portal</h4>
                                    <div class="d-flex flex-column justify-content-start">
                                        <a class="text-white mb-2 text-decoration-none" href="#">Login</a>
                                        <a class="text-white mb-2 text-decoration-none" href="#">Signup</a>
                                        <a class="text-white mb-2 text-decoration-none" href="#">Dashboard</a>
                                        <a class="text-white mb-2 text-decoration-none" href="#">Profile</a>
                                        <a class="text-white mb-2 text-decoration-none" href="#">Status Order</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->

            <!-- Back to Top -->
            <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>

        </body>

        </html>
        <!-- script  -->
        <script src="{{ URL::asset('/dist/js/custom.js') }}"></script>
        <!-- news  -->
        <script>
            var list = document.querySelectorAll("div[data-image]");
            for (var i = 0; i < list.length; i++) {
                var url = list[i].getAttribute('data-image');
                list[i].style.backgroundImage = "url('" + url + "')";
            }
        </script>
        <!-- *---* -->

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ URL::asset('/dist/lib/easing/easing.min.js') }}"></script>
        <script src="{{ URL::asset('/dist/lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ URL::asset('/dist/lib/counterup/counterup.min.js') }}"></script>
        <script src="{{ URL::asset('/dist/lib/owlcarousel/owl.carousel.min.js') }}"></script>

        <!-- Template Javascript -->
        <script src="{{ URL::asset('/dist/js/main.js') }}"></script>
    @endsection
    @extends('templates.globalscript')
