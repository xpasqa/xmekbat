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
                    <h4 class="color-dark font-black mt-3">QUOTATION</h4>

                    <!-- list  -->
                    <div class="container">
                        <div class="row mt-4 justify-content-between">
                            <div class="col-1 text-center">
                                <p>No</p>
                            </div>
                            <div class="col-3 text-center">
                                <p>Test</p>
                            </div>
                            <div class="col-3 text-center">
                                <p>Rates</p>
                            </div>
                            <div class="col-2 text-center">
                                <p>Quantity</p>
                            </div>
                            <div class="col-3 text-center">
                                <p>Total</p>
                            </div>
                        </div>
                    </div>
                    <!-- scroll  -->
                    <div class="scroll-content">

                        <?php $i = 1; ?>
                        <?php $totalqty_sample = 0; ?>
                        <?php $total_price = 0; ?>
                        @foreach ($orders as $row)
                            <!-- card rows-->
                            <div class="card my-3">
                                <div class="row m-3">
                                    <div class="col-1 text-center">
                                        <p>{{ $i }}</p>
                                    </div>
                                    <div class="col-3 text-center">
                                        <p class="m-0 pcard">{{ $row->name }}</p>
                                    </div>
                                    <div class="col-3 text-center">
                                        <p class="m-0 pcard">{{ rupiah($row->price_rates) }} / {{ $row->sample_rates }} Sample
                                        </p>
                                    </div>
                                    <div class="col-2 text-center">
                                        <p class="m-0 pcard">
                                            {{ $row->quantity }}
                                        </p>
                                    </div>
                                    <div class="col-3 text-center pcard">{{ rupiah($row->total) }}</div>
                                </div>
                            </div>
                            <?php $totalqty_sample += $row->quantity * $row->sample_rates; ?>
                            <?php $total_price += $row->total; ?>
                            <?php $i++; ?>
                        @endforeach

                        <div class="card my-3">
                            <div class="row m-3">
                                <div class="col-1 text-center">
                                    <p>{{ $i }}</p>
                                </div>
                                <div class="col-3 text-center">
                                    <p class="m-0 pcard">{{ $preparation->name }}</p>
                                </div>
                                <div class="col-3 text-center">
                                    <p class="pcard">{{ rupiah($preparation->price_rates) }} /
                                        {{ $preparation->sample_rates }} Sample</p>
                                </div>
                                <div class="col-2 text-center">
                                    {{ $totalqty_sample }}
                                </div>
                                <div class="col-3 text-center pcard">{{ rupiah($preparation->price_rates * $totalqty_sample) }}</div>
                            </div>
                        </div>

                        <div class="col justify-content-end">
                            <span class="float-md-end my-2 mx-5">Total Payment &emsp; <strong>
                                    {{ rupiah($total_price + $preparation->price_rates * $totalqty_sample) }}</strong>
                            </span>
                        </div>
                    </div>
                    <!-- end list  -->

                    <h5 class="color-dark font-black mt-4">Additional Notes :</h5>

                    <li class="color-dark">There is an additional fee for the preparation fee of Rp. 40.000/specimen</li>
                    <li class="color-dark">
                        Sampling using coring method for Igneous rocks Rp. 10,000/cm and Sedimentary rocks Rp. 7,500/cm. The
                        coring
                        fee will be included on the invoice after the sample is received.
                    </li>
                    <li class="color-dark">harga belum termasuk pajak.</li>

                    <!-- btn next  -->
                    <div class="mt-5">
                        <a href="{{route('user.pilihlab')}}" class="btn button-primary-outline float-md-start px-5 py-2">Back</a>
                        <button id="submit" type="submit" class="btn button-primary float-md-end px-5 py-2"
                            style="margin-left: 50px">
                            Pesan
                        </button>
                    </div>
                    <br /><br /><br />
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
@extends('order.js.quotation-js')
@extends('order.user.globaluserscript')
