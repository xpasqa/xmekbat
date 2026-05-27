@extends('templates.header')

<body class="fill-bluewhite">
    <!-- body  -->

    @extends('templates.navbar')
    @section('content')
    <div class="container p-0 my-5 fill-white">
      <div class="col mt-5">
        <div class="side-navbar active-nav d-flex justify-content-between flex-wrap flex-column" id="sidebar">
            <ul class="nav flex-column text-white w-100">
                <li>
                    <div class="my-5 mx-4">
                        <h6 class="font-black color-dark">LABORATORY TEST</h6>
                        <div class="progress progressside mt-3">
                            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </li>
                <a href="{{ url('informasi') }}" class="side-nav-link nav-link font-bold color-dark ">
                    <img src="assets/icons/checked.png" alt="checked">
                    <span class="mx-2 side-link">Informasi Proyek</span>
                </a>
                <a href="{{ url('pilihlab') }}" class="side-nav-link nav-link font-bold color-dark">
                    <img src="assets/icons/checked.png" alt="checked">
                    <span class="mx-2 side-link">Pilih Laboratory Test</span>
                </a>
                <a href="{{ url('quotation') }}" class="side-nav-link nav-link font-bold color-dark">
                    <img src="assets/icons/checked.png" alt="checked">
                    <span class="mx-2 side-link">Quotation</span>
                </a>
                <a href="{{ url('pengiriman') }}" class="side-nav-link nav-link font-bold color-dark">
                    <img src="assets/icons/checked.png" alt="checked">
                    <span class="mx-2 side-link">Pengiriman Sample</span>
                </a>
                <a href="{{ url('preparasi') }}" class="side-nav-link nav-link font-bold color-dark">
                    <img src="assets/icons/checked.png" alt="checked">
                    <span class="mx-2 side-link">Preparasi Sample</span>
                </a>
                <a href="{{ url('labtest') }}" class="side-nav-link nav-link font-bold color-dark">
                    <img src="assets/icons/checked.png" alt="checked">
                    <span class="mx-2 side-link">Lab Test</span>
                </a>
                <a href="{{ url('invoice') }}" class="side-nav-link nav-link font-bold color-dark">
                    <img src="assets/icons/checked.png" alt="checked">
                    <span class="mx-2 side-link">Invoice</span>
                </a>
                <a href="{{ url('download') }}" class="side-nav-link nav-link font-bold color-dark nav-active">
                    <span class="mx-2 side-link">Download</span>
                </a>
            </ul>
        </div>

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

          <!-- download  -->
          <div class="card p-3 my-4">
            <div class="row">
              <div class="col">
                <label class="mt-2 color-dark">Data-Hasil-Test-PTABC.pdf</label>
              </div>
              <div class="col text-end">
                <button type="submit" class="btn button-primary px-5 py-2" style="margin-left: 50px">
                  Download
                </button>
              </div>
            </div>
          </div>
          <br>
          <h4 class="color-dark font-black mt-4">Surat Persetujuan Pembuangan Limbah</h4>
          <li class="color-dark">
          Penjelasan mengenai surat pembuangan limbah
          </li>
          <li class="color-dark">
              Silahkan <a href="#">Download Template</a>
          </li>
          <div class="mb-3 mt-4">
              <label for="formFile" class="form-label">Upload file</label>
              <input class="form-control" type="file" id="formFile" multiple>
          </div>
          <br>
          <h4 class="color-dark font-black mt-4">Tanda Terima Laporan</h4>
          <li class="color-dark">
          Penjelasan mengenai surat tanda terima laporan
          </li>
          <li class="color-dark">
              Silahkan <a href="#">Download Template</a>
          </li>
          <div class="mb-3 mt-4">
              <label for="formFile" class="form-label">Upload file</label>
              <input class="form-control" type="file" id="formFile" multiple>
          </div>
          <br>
          <br>
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
                        <input type="radio" name="likert" value="strong_agree">
                        <label>Sangat baik</label>
                      </li>
                      <li>
                        <input type="radio" name="likert" value="agree">
                        <label>Baik</label>
                      </li>
                      <li>
                        <input type="radio" name="likert" value="agree">
                        <label>Cukup</label>
                      </li>
                      <li>
                        <input type="radio" name="likert" value="disagree">
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
                        <input type="radio" name="likert" value="strong_agree">
                        <label>Sangat baik</label>
                      </li>
                      <li>
                        <input type="radio" name="likert" value="agree">
                        <label>Baik</label>
                      </li>
                      <li>
                        <input type="radio" name="likert" value="agree">
                        <label>Cukup</label>
                      </li>
                      <li>
                        <input type="radio" name="likert" value="disagree">
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
                        <input type="radio" name="likert" value="strong_agree">
                        <label>Sangat baik</label>
                      </li>
                      <li>
                        <input type="radio" name="likert" value="agree">
                        <label>Baik</label>
                      </li>
                      <li>
                        <input type="radio" name="likert" value="agree">
                        <label>Cukup</label>
                      </li>
                      <li>
                        <input type="radio" name="likert" value="disagree">
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
                        <input type="radio" name="likert" value="strong_agree">
                        <label>Sangat baik</label>
                      </li>
                      <li>
                        <input type="radio" name="likert" value="agree">
                        <label>Baik</label>
                      </li>
                      <li>
                        <input type="radio" name="likert" value="agree">
                        <label>Cukup</label>
                      </li>
                      <li>
                        <input type="radio" name="likert" value="disagree">
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
            <input class="form-control" type="text" style="height : 100px;" placeholder="Overall, kinerja lab sudah baik!" />
          </div>

          <div class="mt-5">
            <hr />
          </div>

          <!-- btn next  -->
          <div class="mt-4">
            <button type="submit" class="btn button-primary-outline float-md-start px-5 py-2">Back</button>
            <a href="{{ url('download') }}" type="submit" class="btn button-primary float-md-end px-5 py-2" style="margin-left: 50px">
              Simpan
            </a>
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
@extends('order.user.globaluserscript')
