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
          <h4 class="color-dark font-black mt-3">Panduan Pengiriman Sample</h4>

          <!-- list  -->
          <h6 class="color-dark font-black mt-4">Alamat Pengiriman</h6>
          <p>
            Please send samples to Jl. Ganesa 10, Bandung, 40132 and confirm it on the web to ensure the lab team put it
            on the waiting list.
          </p>

          <h6 class="color-dark font-black mt-4">SOP Packing</h6>
          <p>
            This practice covers the guidelines, requirements, and procedures for core drilling, coring, and sampling of
            rock for the purposes of site exploration. The borehole could be vertical, horizontal, or angled.
          </p>

          <h6 class="color-dark font-black mt-4">SOP Dimensi Sample</h6>
          <p>please refer to the sample <a href="#">specification page</a>.</p>

          <h5 class="color-dark font-black mt-5 mb-3">Status Pengiriman Sample</h5>
          <table class="table table-borderless">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">No Pesanan</th>
                <th scope="col">Status</th>
                <th scope="col">Waktu Diterima</th>
                <th scope="col">Estimasi Sample Dibuka</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>{{$project->no_order}}</td>
                <td>{{$project->status}}</td>
                <td id="accepted_at">{{indonesianDateFormat($project->accepted_at)}}</td>
                <td id="dates">{{indonesianDateFormat($project->estimated_opened)}}</td>
              </tr>
            </tbody>
          </table>

          <div class="mt-5">
            <hr />
          </div>

          <!-- btn next  -->
          <div class="mt-4">
            <a href="{{route('user.quotation')}}" class="btn button-primary-outline float-md-start px-5 py-2">Back</a>
            <button id="submit" type="submit" class="btn button-primary float-md-end px-5 py-2" style="margin-left: 50px">
              Next
            </button>
          </div>
          <br /><br /><br />
        </div>
      </div>
    </div>
    </body>
    </html>
@endsection
@extends('order.js.pengiriman-js')
@extends('order.user.globaluserscript')
