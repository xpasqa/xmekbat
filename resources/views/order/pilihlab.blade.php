@extends('templates.header')

<body class="fill-bluewhite">
    <!-- body  -->

    @extends('templates.navbar')
    @section('content')
        <div class="container p-0 my-5 fill-white">
            <div class="col mt-5">
                
                @include('templates.sidebar')

                <!-- Main Wrapper -->
                <div class="p-4 my-container active-cont">
                    <!-- Top Nav -->
                    <!-- <nav class="navbar top-navbar navbar-light fill-white px-5">
                      <a class="btn border-0" id="menu-btn"><i class="bx bx-menu"></i></a>
                    </nav> -->
                    <!--End Top Nav -->
                    <h4 class="color-dark font-black mt-3">GEOMECHANICS LABORATORY TEST - PROJECT ({{strtoupper($project->project_name)}})</h4>

                    <!-- list  -->
                    <div class="container">
                        <div class="row mt-4 justify-content-between">
                            <div class="col-1">
                            </div>
                            <div class="col-md-3 text-center">
                                <p>Test</p>
                            </div>
                            <div class="col-md-3 text-center">
                                <p>Rates</p>
                            </div>
                            <div class="col-md-2 ">
                                <p>Quantity</p>
                            </div>
                            <div class="col-md-3 text-center">
                                <p>Total</p>
                            </div>
                        </div>
                    </div>
                    <!-- scroll  -->
                    <div class="scroll-content">
                        @foreach ($sample as $row)
                            <div class="card my-3">
                                <div class="row m-3" id="rows">
                                    <div class="col-1 text-center">
                                        <input class="form-check-input m-0 p-0" type="checkbox" value="{{$row->price_rates}}" id="{{$row->id_sample}}" />
                                    </div>
                                    <div class="col-3 text-center">
                                        <p class="m-0 pcard">{{$row->name}}</p>
                                    </div>
                                    <div class="col-3 text-center">
                                        <p class="pcard">{{rupiah($row->price_rates)}} / {{$row->sample_rates}} Sample</p>
                                    </div>
                                    <div class="col-2 text-center">
                                        <p class="qty">
                                            <!-- <button class="btnqty" aria-hidden="true" id="btnqty-{{$row->id_sample}}">&minus;</button> -->
                                            <input type="number" class="boxqty" min="0" max="99" name="qty[]" id="qty-{{$row->id_sample}}" step="1" value="0" readonly />
                                            <!-- <button class="btnqty" aria-hidden="true" id="btnqty2-{{$row->id_sample}}">&plus;</button> -->
                                        </p>
                                    </div>
                                    <div class="col-3 text-center pcard" id="selfprice-{{$row->id_sample}}">Rp. 0</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- end list  -->

                    <!-- btn next  -->
                    <div class="mt-5">
                        <a href="{{route('user.informasi')}}" class="btn button-primary-outline float-md-start px-5 py-2">Back</a>
                        <button id="submit" type="submit" class="btn button-primary float-md-end px-5 py-2" style="margin-left: 50px">Next</button>
                        <span class="float-md-end mt-2" id="total_produk">Total (0 Produk) : <strong> Rp 0</strong> </span>
                    </div>
                    <br /><br /><br />
                </div>
            </div>
        </div>

        <!-- end body  -->
    </body>

    </html>
@endsection
@extends('order.js.pilihlab-js')
@extends('order.user.globaluserscript')
