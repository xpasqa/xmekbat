@extends('templates.header')



<body class="fill-bluewhite">
    <!-- body  -->

    @extends('templates.navbar')
    @section('content')
        <div class="container my-5 fill-white" style="padding-bottom: 20px; min-height: 550px;">
            <div class="d-flex px-3 py-4 justify-content-between">
                <div class="">
                    <h6 class="font-black color-dark">LABORATORY TEST</h6>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('user.informasi') }}" class="btn button-primary px-5">New Order</a>
                </div>
            </div>
            @if ($project->count() > 0)
                <!-- list  -->
                <div class="my-3">
                    <div class="row m-3">
                        <div class="col-md-1 text-center">
                            <p>No</p>
                        </div>
                        <div class="col-md-2">
                            <p class="m-0 ">No. Order</p>
                        </div>
                        <div class="col-md-2 text-center">
                            <p class="">Status Order</p>
                        </div>
                        <div class="col-md-2 text-center">
                            <p class="">Dates Ordered</p>
                        </div>
                        <div class="col-md-3 text-center">
                            <p class="">Total</p>
                        </div>
                        <div class="col-md-2 text-center">
                            <p class="">Action</p>
                        </div>
                    </div>
                </div>
                <div>
                    <!-- Data -->
                    <?php $i = 1; ?>
                    @foreach ($project as $row)
                        <div class="card fill-bluewhite my-3">
                            <div class="row align-items-center m-3">
                                <div class="col-md-1 text-center">
                                    <p class="m-0 pcard">{{ $i }}</p>
                                </div>
                                <div class="col-md-2">
                                    <p class="m-0 pcard">MEKBAT-{{ $row->no_order }}</p>
                                </div>
                                <div class="col-md-2 text-center">
                                    <p class="m-0 pcard">{{ $row->status }}</p>
                                </div>
                                <div class="col-md-2 text-center">
                                    <p class="m-0 pcard">
                                        {{ indonesianDateFormat(date('Y-m-d', strtotime($row->created_at))) }}</p>
                                </div>
                                <div class="col-md-3 text-center">
                                    <p class="m-0 pcard">{{ rupiah($row->orders->sum('total')) }}</p>
                                </div>
                                <div class="col-md-2 text-center">
                                    <button class="linkbtn btn btn-secondary"
                                        value="{{ $row->id_project }}">{{ $row->status }}</button>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                </div>
            @else
                <div class="col mt-5 text-center">
                    <br><br><br>
                    <h6 class="color-grey small-title font-bold">You have no order</h6>
                    <p class="color-grey paragraf">Create your first order by Clicking “New Order” above</p>
                </div>
            @endif
            <!-- end body  -->
    </body>

    </html>
@endsection
@extends('order.js.index-js')
@extends('order.user.globaluserscript')
