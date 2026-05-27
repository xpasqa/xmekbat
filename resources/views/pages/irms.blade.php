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
                    <h1 class="display-1 text-white mb-md-4">IRMS</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Blog Start -->
    <div class="container py-5">
        <div class="row mb-5 justify-content-center">
            <div class="col-lg-12">
                <h5 class="title color-blue">INDONESIAN ROCK MECHANICS SOCIETY</h5>
                <p>
                    The Indonesian Rock Mechanics Society (IRMS) is a National Group affiliated with the International Society for Rock Mechanics and Rock Engineering (ISRM). IRMS comprises academics, practitioners, researchers, and students involved in rock mechanics and engineering. IRMS was formally established in 2007 after receiving ISRM's approval. IRMS is committed to significantly contributing to the advancement of the rock mechanics and rock engineering field by participating in international scientific conferences and organizing activities to enhance the knowledge of its members and the general public.
                </p>
            </div>
        </div>
        <div class="row g-5">
            <h5 class="title color-blue">IRMS Updates</h5>
            <!-- Blog list Start -->
            <div class="col-lg-12">
                <div class="row g-5">
                    @foreach ($news as $row)
                        <!-- post -->
                        <div class="col-md-4 mt-4">
                            <div class="blog-item position-relative overflow-hidden">
                                <img class="imgpost" src="{{url('storage/news/cover/'.$row->cover.'')}}" alt="">
                                <div class="row my-3">
                                    <div class="col">
                                        @foreach ($row->tags as $item)
                                            <button class="btn btn-sm button-dark-outline">{{$item->name}}</button>
                                        @endforeach
                                    </div>
                                </div>
                                <a class="text-decoration-none" href="{{url('irms/detail/'.$row->slug.'')}}">
                                    <h5 class="color-black title">{{$row->title}}
                                    </h5>
                                    <span class="color-black">{{ indonesianDateFormat(date('Y-m-d', strtotime($row->created_at))) }}</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row my-5">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                          <ul class="pagination pagination-lg justify-content-center m-0">
                            @for ($i = 1; $i <= $paging['total_page']; $i++)
                                @if ($current_page == $i)
                                    <li class="page-item active mx-2"><a class="page-link" href="{{route('news.irmsView', ['current_page' => $i])}}" 
                                        style="background-color: #005aab;">{{$i}}</a></li>
                                @else
                                    <li class="page-item mx-2"><a class="page-link" href="{{route('news.irmsView', ['current_page' => $i])}}">{{$i}}</a></li>
                                @endif
                            @endfor
                          </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Blog list End -->
        </div>
    </div>
    <!-- Blog End -->

    <div class="row m-0 py-5 fill-bluedark text-white justify-content-around align-items-center">
        <div class="col-md-5">
            <h4 class="title">IRMS Membership</h4>
            <p>Register to be a member of IRMS and get discount prices for participants at every international symposium affiliated with ISRM</p>
        </div>
        <div class="col-md-4 text-center">
            <button class="btn button-white px-5 py-2">Register Now</button>
        </div>
    </div>

    <!-- Footer Start -->
    @extends('templates.footer')
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
        list[i].style.backgroundImage="url('" + url + "')";
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
