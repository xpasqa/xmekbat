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
                        <h1 class="display-1 text-white mb-md-4">News</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
        <!-- news  -->
        <div class="container mt-5">
            <div class="row justify-content-between">
                <div class="col-md-8 col-lg-8">
                    <div class="justifytext">
                        <img src="{{ url('storage/news/cover/' . $data->cover . '') }}" class="img-fluid pb-3" width="600"
                            alt="Responsive image">
                        <h2><b>{{ $data->title }}</b></h2>
                        <br>
                        <p class="color-grey">{{ indonesianDateFormat($data->created_at) }}</p>
                        <p class="text-justify">{!! nl2br(str_replace(' ', ' &nbsp;', $data->content)) !!} </p>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 ">
                    @foreach ($news as $row)
                        @if ($row->type == 'News')
                            <!-- repeat card  -->
                            <a href="{{ route('news.detailNews', ['slug' => $row->slug]) }}"
                                class="card card-body card-list mb-4 ">
                                <div class="row ">
                                    <div class="col px-2">
                                        <img class="card-img-top" src="{{ url('storage/news/cover/' . $row->cover . '') }}"
                                            alt="Card image cap">
                                    </div>
                                    <div class="col px-2">
                                        <h5 class="card-title">{{ $row->title }}</h5>
                                        <p>{{ truncateString($row->content) }}</p>
                                    </div>
                                </div>
                                <br>
                                <p class="color-grey m-0 p-0">{{ indonesianDateFormat($data->created_at) }}</p>
                            </a>
                        @else
                            <!-- repeat card  -->
                            <a href="{{ route('news.detailIrms', ['slug' => $row->slug]) }}"
                                class="card card-body card-list mb-4 ">
                                <div class="row ">
                                    <div class="col px-2">
                                        <img class="card-img-top" src="{{ url('storage/news/cover/' . $row->cover . '') }}"
                                            alt="Card image cap">
                                    </div>
                                    <div class="col px-2">
                                        <h5 class="card-title">{{ $row->title }}</h5>
                                        <p>{{ truncateString($row->content) }}</p>
                                    </div>
                                </div>
                                <br>
                                <p class="color-grey m-0 p-0">{{ indonesianDateFormat($data->created_at) }}</p>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            <br>
            <br><br>
            <br>
        </div>

        <!-- end body  -->
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
@endsection
