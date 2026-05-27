@extends('templates.header')

<body class="fill-bluewhite">
    <!-- body  -->

    @extends('templates.navbar')
    @section('content')
        <div class="container p-0 my-5 fill-white">
            <div class="col mt-5 ">
                @include('templates.sidebar')

                <!-- Main Wrapper -->
                <div class="p-4 my-container active-cont">
                    <h4 class="color-dark font-black mt-3">Customer Information</h4>
                    <form class="mt-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Company</label>
                            <input id="company_name" name="company_name" type="text" class="form-control form-box" style="height: 8%" placeholder="PT. LAPI ITB">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Address</label>
                            <input id="address" name="address" type="text" class="form-control form-box" placeholder="Jl. Ganesha no.15B, Kel. Lebak Gede, Kec. Coblong, Kota Bandung 40132" style="height: 8%">
                        </div>
                    </form>
                    <h4 class="color-dark font-black mt-5">Project Information</h4>
                    <form class="mt-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Project Name</label>
                            <input id="project_name" name="project_name" type="text" class="form-control form-box" placeholder="2022 Geotechnical Sample" style="height: 8%">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Project Location</label>
                            <input id="project_location" name="project_location" type="text" class="form-control form-box" placeholder="Bandung, Jawa Barat" style="height: 8%">
                        </div>
                    </form>
                    <h4 class="color-dark font-black mt-5">Project Account</h4>
                    <form class="mt-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input id="pic" name="pic" type="text" class="form-control form-box" style="height: 8%">
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input id="email_project" name="email_project" type="email" class="form-control form-box form-height">
                                </div>
                            </div>
                            <div class="col-md-6 pl-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Phone</label>
                                    <input id="phone" name="phone" type="number" class="form-control form-box form-height">
                                </div>
                            </div>
                        </div>
                    </form>
                    <br><br><br>
                    <h4 class="color-dark font-black mt-4">Test Application Letter</h4>
                    <li class="color-dark">
                        Dimohon untuk melampirkan Surat Permohonan Pengujian resmi dari perusahaan sebelum dapat melanjutkan ke tahap selanjutnya.
                    </li>
                    <li class="color-dark">
                        Silahkan Download Contoh Surat Permohonan => <a target="_blank" href="{{URL::asset('template.pdf')}}">Silahkan Download Contoh Surat Permohonan Pengajuan</a>
                    </li>
                    <li class="color-dark">
                        Surat Permohonan Pengujian ditujukan kepada:<br>
                    </li>
                    <li class="color-dark">DIREKTUR UTAMA PT. LAPI ITB</li>
                    <li class="color-dark">jl. Ganesha no15B, Bandung 40132</li>
                    <div class="mb-3 mt-4">
                        <label for="formFile" class="form-label">Upload file</label>
                        <input id="file" name="file" class="form-control" type="file" multiple>
                    </div>
                    <br>
                    <!-- btn next  -->
                    <div class="">
                        <button id="submit" type="submit" class="btn button-primary float-md-end">Next</button>
                    </div>
                    <br><br><br>
                </div>

            </div>
        </div>

        <!-- end body  -->
    </body>

    </html>
@endsection
@extends('order.js.informasi-js')
@extends('order.user.globaluserscript')
