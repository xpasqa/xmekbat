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
        <div class="container-fluid bg-primary py-5 bg-about">
            <div class="container py-5">
                <div class="row justify-content-start">
                    <div class="col-lg-12 text-center">
                        <h1 class="display-1 text-white mb-md-4">Research</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!-- Blog Start -->
        <div class="container py-5">
            <div class="row">
                <h5 class="title color-blue">RESEARCH DETAILS</h5>
                <p>
                    The laboratory of Geomechanics and Mine Equipment is where faculty and students conduct research, particularly in the fields of geomechanics and mining technology. We are always committed to contributing to scientific advancement through high-quality research that can serve as a national and international benchmark.
                </p>
            </div>
            <div class="row my-4">
                <div class="col">
                    <!-- Search Form Start -->
                    <div class="mb-5">
                        <div class="input-group">
                            <input type="text" class="form-control p-3" placeholder="Search Title or Author by Keywords">
                            <button class="btn button-primary px-4"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                    <!-- Search Form End -->
                </div>
            </div>
            <div>
                <div class="my-3">
                    <div class="row m-3">
                        <div class="col-md-1">
                            <p class="title">ID</p>
                        </div>
                        <div class="col-md-5">
                            <p class="title">Titles</p>
                        </div>
                        <div class="col-md-2">
                            <p class="title">Author</p>
                        </div>
                        <div class="col-md-1">
                            <p class="title">Type</p>
                        </div>
                        <div class="col-md-1">
                            <p class="title">Year</p>
                        </div>
                        <div class="col-md-2">
                            <p class="title">Action</p>
                        </div>
                    </div>
                </div>
                <hr class="titlehr">

                <?php $i= 1; ?>
                @foreach ($journals as $row)
                <!-- list  -->
                <div class="my-3">
                    <div class="row align-items-center m-3">
                        <div class="col-md-1">
                            <p class="m-0 pcard">{{$i}}</p>
                        </div>
                        <div class="col-md-5">
                            <p class="m-0 pcard">{{$row->title}}</p>
                        </div>
                        <div class="col-md-2">
                            <p class="m-0 pcard">{{$row->author}}</p>
                        </div>
                        <div class="col-md-1">
                            <p class="m-0 pcard">{{$row->type}}</p>
                        </div>
                        <div class="col-md-1">
                            <p class="m-0 pcard">{{$row->year}}</p>
                        </div>
                        <div class="col-md-2">
                            <!-- Button trigger modal -->
                            <div class="">
                                <a href="#demo-modal-{{$row->id_journal}}" class="color-black">More Details</a>
                                <div id="demo-modal-{{$row->id_journal}}" class="modal modalpeople">
                                    <div class="modal__contentpeople">
                                        <p>Journal</p>
                                        <h5 class="title mb-3">{{$row->title}}</h5>
                                        <p class="mb-1">{{$row->author}}</p>
                                        <p class="mt-1">{{$row->year}}</p>
                                        <p>
                                            {{$row->description}}
                                        </p>
                                        <p>keyword : {{$row->keyword}}</p>
                                        <a target="_blank" href="{{url('storage/journals/'.$row->file.'')}}" class="btn button-primary px-4 py-2">Download</a>

                                        <a href="#" class="modal__close">&times;</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <?php $i++; ?>
                @endforeach
                <div class="row my-5">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-lg justify-content-center m-0">
                                @for ($i = 1; $i <= $paging['total_page']; $i++) @if ($current_page==$i) <li class="page-item active mx-2"><a class="page-link" href="{{route('journals.index', ['current_page' => $i])}}" style="background-color: #005aab;">{{$i}}</a></li>
                                    @else
                                    <li class="page-item mx-2"><a class="page-link" href="{{route('journals.index', ['current_page' => $i])}}">{{$i}}</a></li>
                                    @endif
                                @endfor
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        </div>
        <!-- Blog End -->

        <!-- Footer Start -->
        <div class="container-fluid bg-primary text-white">
            <div class="container">
                <div class="row gx-5">
                    <div class="col-12">
                        <div class="row gx-5">
                            <div class="col-lg-6 col-md-12 pt-5 mb-5">
                                <img src="{{ url('assets/images/logogeoitbwhite.png')}}" width="300px" alt="logo">
                                <div class="d-flex my-3">
                                    <p class="text-white mb-0">Department of Mining Engineering <br> Bandung Institute of Technology <br>Tel: (+62) 22 2502239</p>
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
