@extends('templates.header')
@extends('templates.navbar')
@section('content')
    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 bg-about">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-12 text-center">
                    <h1 class="display-1 text-white mb-md-4">News</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Blog Start -->
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="input-group">
                        <input id="search" type="text" class="form-control p-3" placeholder="Search">
                        <button class="btn button-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->
            </div>
        </div>
        <div class="row g-5">
            <!-- Blog list Start -->
            <div class="col-lg-12">
                <div id="list" class="row g-5">
                    @foreach ($news as $row)
                        <!-- post -->
                        <div class="col-md-4 mt-4">
                            <div class="blog-item position-relative overflow-hidden">
                                <img class="imgpost" src="{{url('storage/news/cover/'.$row->cover.'')}}" alt="{{url('news/detail/'.$row->slug.'')}}">
                                <div class="row my-3">
                                    <div class="col">
                                        @foreach ($row->tags as $item)
                                            <button class="btn btn-sm button-dark-outline">{{$item->name}}</button>
                                        @endforeach
                                    </div>
                                </div>
                                <a class="text-decoration-none" href="{{url('news/detail/'.$row->slug.'')}}">
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
                                        <li class="page-item active mx-2"><a class="page-link" href="{{route('news.index', ['current_page' => $i])}}" 
                                            style="background-color: #005aab;">{{$i}}</a></li>
                                    @else
                                        <li class="page-item mx-2"><a class="page-link" href="{{route('news.index', ['current_page' => $i])}}">{{$i}}</a></li>
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
