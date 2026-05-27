@extends('templates.header')

@section('content')
    @extends('templates.navbar')
    
    <!-- Slider  -->

    <div class="slidercontainer">
        <div class="slidercontainer__image">
            <div class="image__main">
            @foreach ($slider as $row)
                <img src="{{url('storage/slider/'.$row->image.'')}}" alt="{{$row->url}}" class="img">
            @endforeach
        </div>
        <div class="image__btn">
            <button class="next"><i class="fas fa-arrow-circle-right"></i></button>
            <button class="prev"><i class="fas fa-arrow-circle-left"></i></button>
        </div>
        </div>
    </div>

    <!-- End slider  -->

    <!-- content 1 -->
    <div class="row justify-content-around p-0 m-0 my-5">
        <div class="col-md-5">
            <h1 class="mb-4 mt-5 title">LABORATORY OF GEOMECHANICS AND MINE EQUIPMENT</h1>
            <p class="mb-4">We are committed to providing high-standard services with the quality policy being implemented by the entire laboratory staff following ISO/IEC 17025:2017.</p>
            <a href="{{route('about.aboutPage')}}" class="btn button-primary px-4 py-2 mb-4">Learn More</a>

        </div>
        <div class="col-md-4">
            <img src="assets/images/sertifikat.png" alt="sertifikat" width="100%">
        </div>
    </div>
    <!-- content 1 end  -->

    <!-- content 2 -->
    <div class="fill-bluewhite">
        <div class="row m-0 justify-content-center">
            <div class="col-md-8" style="padding-bottom: 20px;">
                <div class="row m-0">
                    <div class="col text-center">
                        <h3 class="title my-5">GEOMECHANICS LABORATORY TEST</h3>
                    </div>
                </div>
                <!-- list  -->
                <div class="my-3">
                    <div class="row m-3">
                        <div class="col-md-3">
                            <p class="title">Test</p>
                        </div>
                        <div class="col-md-3">
                            <p class="title">Output</p>
                        </div>
                        <div class="col-md-3">
                            <p class="title">Method</p>
                        </div>
                        <div class="col-md-3 text-center">
                            <p class="title">Information</p>
                        </div>
                    </div>
                </div>
                <hr class="titlehr">
                @foreach ($testInfo as $row)
                    @if ($row->display == 'Show' && $row->type == 'Sample')
                         <!-- card loop -->
                        <div class="card cardline fill-bluewhite my-3">
                            <div class="row align-items-center m-3">
                                <div class="col-md-3">
                                    <p class="m-0 pcard">{{$row->name}}</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="m-0 pcard">{{$row->output}}</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="m-0 pcard">{{$row->method}}</p>
                                </div>
                                <div class="col-md-3 text-center">
                                    <!-- Button trigger modal -->
                                    <div class="">
                                        <button id="{{$row->id_sample}}" type="button" class="btn button-primary px-5 more" data-toggle="modal" data-target="#exampleModalCenter">More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        @if (isset($pricelist->file))
                            <a id="pricelist" href="{{url('storage/pricelist/'.$pricelist->file.'')}}" target="_blank" type="button" class="btn button-primary px-5" data-toggle="modal" style="width: 100%">Download Pricelist</a>
                        @endif
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title close" id="title">Pyshical Properties</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <p class="title mb-0">
                                    Standard Method :
                                </p>
                                <p id="standard_method_description">
                                    -
                                </p>
                                <p class="title mb-0">
                                    Output :
                                </p>
                                <p id="output">
                                    -
                                </p>
                                <div id="images" class="row mt-4">         
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>
    <!-- content 2 end  -->

    <!-- content 3 -->
    <div class="row justify-content-around p-0 m-0 my-5">
        <div class="col-md-4">
            <h4 class="mb-4 mt-5 mb-3 title color-blue">Latest News</h4>
            <!-- 1 -->
            @foreach ($news as $row)
                <a href="javascript:void(0)" class="row mt-3 text-decoration-none color-black">
                    <div class="col-3">
                        <img src="{{url('storage/news/cover/'.$row->cover.'')}}" class="news-button" width="100%" alt="{{url('news/detail/'.$row->slug.'')}}">
                    </div>
                    <div class="col">
                        <h5 alt="{{url('news/detail/'.$row->slug.'')}}" class="title news-button">{{$row->title}}</h5>
                        <p>Admin - {{$row->created_at->format('d M Y')}}</p>
                    </div>
                </a>
            @endforeach
            <!-- more  btn -->
            <div class="row my-4 justify-content-center">
                <div class="col-8 text-center">
                    <a href="{{route('news.index', ["current_page" => 1])}}" class="btn button-primary-outline px-5 py-2">More News</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h4 class="mb-4 mt-5 title color-blue">Indonesia Rock Mechanic Society</h4>
            <!-- 1 -->
            @foreach ($irms as $row)
                <a href="javascript:void(0)" class="row mt-3 text-decoration-none color-black">
                    <div class="col-3">
                        <img src="{{url('storage/news/cover/'.$row->cover.'')}}" class="news-button" width="100%" alt="{{url('irms/detail/'.$row->slug.'')}}">
                    </div>
                    <div class="col">
                        <h5 alt="{{url('irms/detail/'.$row->slug.'')}}" class="title news-button">{{$row->title}}</h5>
                        <p>Admin - {{$row->created_at->format('d M Y')}}</p>
                    </div>
                </a>
            @endforeach
            <!-- more  btn -->
            <div class="row my-4 justify-content-center">
                <div class="col-8 text-center">
                    <a href="{{route('news.irmsView', ["current_page" => 1])}}" class="btn button-primary-outline px-5 py-2">More News</a>
                </div>
            </div>
        </div>
    </div>
    <!-- content 3 end  -->


    <!-- Footer Start -->
    @extends('templates.footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    <!-- <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a> -->
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

    <!-- slider  -->
    <script>
        const prev = document.querySelector(".prev");
        const next = document.querySelector(".next");
        const images = document.querySelectorAll(".img");
        let counter = 0;
        var autoInterval = setInterval(autoSlide, 3000);

        function removeGlitch() {
        clearInterval(autoInterval);
        autoInterval = setInterval(autoSlide, 3000);
        }

        next.addEventListener("click", () => {
        removeGlitch();
        changeInCounter();
        changeImage();
        });

        prev.addEventListener("click", () => {
        removeGlitch();
        changeDecCounter();
        changeImage();
        });

        function changeInCounter() {
        if (counter >= 3) {
            counter = -1;
        }
        counter++;
        }

        function changeDecCounter() {
        if (counter <= 0) {
            counter = 4;
        }
        counter--;
        }

        function changeImage() {
        images.forEach((elem) => {
            elem.style.transform = `translate(-${counter * 100}%`;
        });
        }

        function autoSlide() {
        changeInCounter();
        changeImage();
        }

    </script>

@endsection
@extends('templates.globalscript')
