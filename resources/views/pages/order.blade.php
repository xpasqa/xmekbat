@extends('templates.header')



<body class="fill-bluewhite">
    <!-- body  -->

    @extends('templates.navbar')
    @section('content')
        <div class="container my-5 fill-white" style="padding-bottom: 20px;">
            <div class="d-flex px-3 py-4 justify-content-between">
                <div class="">
                    <h6 class="font-black color-dark">LABORATORY TEST</h6>
                </div>
                <div class="ml-auto">
                    <a href="{{ url('/informasi') }}" class="btn button-primary px-5">New Order</a>
                </div>
            </div>
            <!-- list  -->
            <div class="my-3">
              <div class="row m-3">
                <div class="col-md-1 text-center">
                    <p>No</p>
                </div>
                <div class="col-md-2">
                  <p class="m-0 ">No. Order</p>
                </div>
                <div class="col-md-2">
                  <p class="">Status Order</p>
                </div>
                <div class="col-md-2 text-center">
                  <p class="">Dates Orderd</p>
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
            <!-- card  1-->
            <div class="card fill-bluewhite my-3">
              <div class="row align-items-center m-3">
                <div class="col-md-1 text-center">
                    <p class="m-0 pcard">1</p>
                </div>
                <div class="col-md-2">
                  <p class="m-0 pcard">IF001</p>
                </div>
                <div class="col-md-2">
                  <p class="m-0 pcard">Test Selesai</p>
                </div>
                <div class="col-md-2 text-center">
                  <p class="m-0 pcard">5 Juni 2022</p>
                </div>
                <div class="col-md-3 text-center">
                  <p class="m-0 pcard">Rp. 8.000.000</p>
                </div>
                <div class="col-md-2 text-center">
                  <button class="btn btn-secondary">Status</button>
                </div>
              </div>
            </div>
            <!-- card  2-->
            <div class="card fill-bluewhite my-3">
              <div class="row align-items-center m-3">
                <div class="col-md-1 text-center">
                    <p class="m-0 pcard">2</p>
                </div>
                <div class="col-md-2">
                  <p class="m-0 pcard">IF001</p>
                </div>
                <div class="col-md-2">
                  <p class="m-0 pcard">Sample Dibuka</p>
                </div>
                <div class="col-md-2 text-center">
                  <p class="m-0 pcard">5 Juni 2022</p>
                </div>
                <div class="col-md-3 text-center">
                  <p class="m-0 pcard">Rp. 16.000.000</p>
                </div>
                <div class="col-md-2 text-center">
                  <button class="btn btn-secondary">Status</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- end body  -->
    </body>

    </html>
    <!-- script  -->
    <script src="{{ URL::asset('/dist/js/custom.js') }}"></script>
@endsection
