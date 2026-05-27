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
            <!-- Content Start -->
            <div class="container">
                <div class="col-lg-12">
                    <!-- people 1 -->
                    <div class="row my-5 justify-content-around">
                        <div class="col-md-2">
                            <img src="{{ url('storage/people/' . $people->image . '') }}" width="100%" class="mt-3">
                        </div>
                        <div class="col-md-8">
                            <h5 class="title m-0 p-0">{{ $people->name }}</h5>
                            <p class="subtitle mb-3 p-0">{{ $people->position }}</p>
                            <p class="">
                                {{ $people->description }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <!-- list  -->
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
                        <?php $i = 1; ?>
                        @foreach ($people->journals as $row)
                            <!-- List Journals -->
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
                                                    <a target="_blank" href="{{ url('storage/journals/'.$row->file.'') }}" class="btn button-primary px-4 py-2">Download</a>

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
                        @foreach ($people->self_journals as $row)
                            <!-- List Journals -->
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
                                            <a href="#demo-modal-{{$row->id_self_journals}}" class="color-black">More Details</a>
                                            <div id="demo-modal-{{$row->id_self_journals}}" class="modal modalpeople">
                                                <div class="modal__contentpeople">
                                                    <p>Journal</p>
                                                    <h5 class="title mb-3">{{$row->title}}</h5>
                                                    <p class="mb-1">{{$row->author}}</p>
                                                    <p class="mt-1">{{$row->year}}</p>
                                                    <p>
                                                        {{$row->description}}
                                                    </p>
                                                    <p>keyword : {{$row->keyword}}</p>
                                                    <a target="_blank" href="{{ url('storage/selfjournals/'.$row->file.'') }}" class="btn button-primary px-4 py-2">Download</a>

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
                    </div>
                    <br><br><br>
                </div>
            </div>

            <!-- Content End -->

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
