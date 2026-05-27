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
          <div class="row mb-4">
            <div class="col">
              <h4 class="color-dark font-black mt-3">Dokumen Hasil Test</h4>
            </div>
          </div>

          <input class="form-check-input" type="checkbox" value="" id="menyetujui">
          <label class="form-check-label" for="defaultCheck1">
            Dengan ini menyetujui <b class="font-weight-bold"><strong>pembuangan sisa sampel uji</strong></b> dan menerima laporan data sample.
          </label>
          <br>
          <br>
          <!-- download  -->
          @foreach ($project->hasil_image as $row)
            <div class="card p-3 my-4">
              <div class="row">
                <div class="col">
                  <label class="mt-2 color-dark">{{$row->name}}</label>
                </div>
                <div class="col text-end">
                  <a target="_blank" href="{{url('storage/order/document/'.$row->image.'')}}" type="submit" class="btn button-primary px-5 py-2 btn_download" style="margin-left: 50px">
                    Download
                  </a>
                </div>
              </div>
            </div>
          @endforeach
          <br>

          <div class="row">
            <div class="col">
              <h4 class="color-dark font-black mt-3">Survey Kepuasan</h4>
            </div>
          </div>
          <div class="">
            <div class="wrap">
              <form action="">
                <!-- 1  -->
                <div class="row my-5">
                  <div class="col-md">
                    <label class="mt-2 px-3">1. Ketepatan Waktu</label>
                  </div>
                  <div class="col-md text-end">
                    <ul class='likert p-0 m-0'>
                      <li>
                        <input type="radio" name="ketepatan_waktu" value="Sangat Baik" {{ (optional($survey)->ketepatan_waktu == "Sangat Baik") ? 'checked ' : '' }}>
                        <label>Sangat baik</label>
                      </li>
                      <li>
                        <input type="radio" name="ketepatan_waktu" value="Baik" {{ (optional($survey)->ketepatan_waktu == "Baik") ? 'checked ' : '' }}>
                        <label>Baik</label>
                      </li>
                      <li>
                        <input type="radio" name="ketepatan_waktu" value="Cukup" {{ (optional($survey)->ketepatan_waktu == "Cukup") ? 'checked ' : '' }}>
                        <label>Cukup</label>
                      </li>
                      <li>
                        <input type="radio" name="ketepatan_waktu" value="Kurang" {{ (optional($survey)->ketepatan_waktu== "Kurang") ? 'checked ' : '' }}>
                        <label>Kurang</label>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- 2  -->
                <div class="row my-5">
                  <div class="col-md">
                    <label class="mt-2 px-3">2. Komunikasi laboratorium dengan pelanggan</label>
                  </div>
                  <div class="col-md text-end">
                    <ul class='likert p-0 m-0'>
                      <li>
                        <input type="radio" name="komunikasi" value="Sangat Baik" {{ (optional($survey)->komunikasi == "Sangat Baik") ? 'checked ' : '' }}>
                        <label>Sangat baik</label>
                      </li>
                      <li>
                        <input type="radio" name="komunikasi" value="Baik" {{ (optional($survey)->komunikasi == "Baik") ? 'checked ' : '' }}>
                        <label>Baik</label>
                      </li>
                      <li>
                        <input type="radio" name="komunikasi" value="Cukup" {{ (optional($survey)->komunikasi == "Cukup") ? 'checked ' : '' }}>
                        <label>Cukup</label>
                      </li>
                      <li>
                        <input type="radio" name="komunikasi" value="Kurang" {{ (optional($survey)->komunikasi == "Kurang") ? 'checked ' : '' }}>
                        <label>Kurang</label>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- 3  -->
                <div class="row my-5">
                  <div class="col-md">
                    <label class="mt-2 px-3">3. Kejelasan pelaporan</label>
                  </div>
                  <div class="col-md text-end">
                    <ul class='likert p-0 m-0'>
                      <li>
                        <input type="radio" name="kejelasan" value="Sangat Baik" {{ (optional($survey)->kejelasan == "Sangat Baik") ? 'checked ' : '' }}>
                        <label>Sangat baik</label>
                      </li>
                      <li>
                        <input type="radio" name="kejelasan" value="Baik" {{ (optional($survey)->kejelasan == "Baik") ? 'checked ' : '' }}>
                        <label>Baik</label>
                      </li>
                      <li>
                        <input type="radio" name="kejelasan" value="Cukup" {{ (optional($survey)->kejelasan == "Cukup") ? 'checked ' : '' }}>
                        <label>Cukup</label>
                      </li>
                      <li>
                        <input type="radio" name="kejelasan" value="Kurang" {{ (optional($survey)->kejelasan == "Kurang") ? 'checked ' : '' }}>
                        <label>Kurang</label>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- 4  -->
                <div class="row my-5">
                  <div class="col-md">
                    <label class="mt-2 px-3">4. Kejelasan informasi yang diberikan laboratorium</label>
                  </div>
                  <div class="col-md text-end">
                    <ul class='likert p-0 m-0'>
                      <li>
                        <input type="radio" name="informasi" value="Sangat Baik" {{ (optional($survey)->informasi == "Sangat Baik") ? 'checked ' : '' }}>
                        <label>Sangat baik</label>
                      </li>
                      <li>
                        <input type="radio" name="informasi" value="Baik" {{ (optional($survey)->informasi == "Baik") ? 'checked ' : '' }}>
                        <label>Baik</label>
                      </li>
                      <li>
                        <input type="radio" name="informasi" value="Cukup" {{ (optional($survey)->informasi == "Cukup") ? 'checked ' : '' }}>
                        <label>Cukup</label>
                      </li>
                      <li>
                        <input type="radio" name="informasi" value="Kurang" {{ (optional($survey)->informasi == "Kurang") ? 'checked ' : '' }}>
                        <label>Kurang</label>
                      </li>
                    </ul>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <br><br>
          <h4 class="color-dark font-black mt-5">Saran</h4>

          <div class="mb-3 mt-4">
            <input id="id_survey" type="hidden" class="form-control" value="{{ optional($survey)->id_survey}}">
            <textarea id="saran" class="form-control" rows="4" placeholder="Masukan saran">{{$project->saran}}</textarea>
          </div>

          <div class="mt-5">
            <hr />
          </div>

          <!-- btn next  -->
          <div class="mt-4">
            <a href="{{route('user.invoice')}}" class="btn button-primary-outline float-md-start px-5 py-2">Back</a>
            <button id="submit" type="submit" class="btn button-primary float-md-end px-5 py-2" style="margin-left: 50px">
              Simpan
            </button>
          </div>
          <br /><br /><br />
        </div>
      </div>
    </div>

        <!-- end body  -->
    </body>

    </html>

    <!-- script  -->
    <script src="{{ URL::asset('/dist/js/custom.js') }}"></script>
@endsection
@extends('order.js.download-js')
@extends('order.user.globaluserscript')
