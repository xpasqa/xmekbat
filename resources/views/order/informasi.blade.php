@extends('templates.header')

<body class="fill-bluewhite order-workflow">
    <!-- body  -->

    @extends('templates.navbar')
    @section('content')
        <div class="container p-0 my-5">
            <div class="order-shell">
                @include('templates.sidebar')

                <!-- Main Wrapper -->
                <div class="my-container active-cont order-main">
                    <div class="order-page-header">
                        <h4>Project Details</h4>
                        <p>Lengkapi informasi pelanggan, proyek, dan akun penanggung jawab sebelum memilih kategori test.</p>
                    </div>

                    <section class="order-section">
                        <h5>Customer Information</h5>
                        <div class="order-form-grid">
                            <div class="order-field">
                            <label for="" class="form-label">Company</label>
                                <input id="company_name" name="company_name" type="text" class="form-control form-box" placeholder="PT. LAPI ITB">
                        </div>
                            <div class="order-field">
                            <label for="" class="form-label">Address</label>
                                <input id="address" name="address" type="text" class="form-control form-box" placeholder="Jl. Ganesha no.15B, Kel. Lebak Gede, Kec. Coblong, Kota Bandung 40132">
                        </div>
                        </div>
                    </section>

                    <section class="order-section">
                        <h5>Project Information</h5>
                        <div class="order-form-grid">
                            <div class="order-field">
                            <label for="" class="form-label">Project Name</label>
                                <input id="project_name" name="project_name" type="text" class="form-control form-box" placeholder="2022 Geotechnical Sample">
                        </div>
                            <div class="order-field">
                            <label for="" class="form-label">Project Location</label>
                                <input id="project_location" name="project_location" type="text" class="form-control form-box" placeholder="Bandung, Jawa Barat">
                        </div>
                        </div>
                    </section>

                    <section class="order-section">
                        <h5>Project Account</h5>
                        <div class="order-form-grid">
                            <div class="order-field order-field-wide">
                            <label for="" class="form-label">Name</label>
                                <input id="pic" name="pic" type="text" class="form-control form-box">
                        </div>
                            <div class="order-field">
                                    <label for="" class="form-label">Email</label>
                                    <input id="email_project" name="email_project" type="email" class="form-control form-box form-height">
                                </div>
                            <div class="order-field">
                                    <label for="" class="form-label">Phone</label>
                                    <input id="phone" name="phone" type="number" class="form-control form-box form-height">
                                </div>
                            </div>
                    </section>

                    <section class="order-section order-note-section">
                        <h5>Test Application Letter</h5>
                        <ul>
                            <li>Dimohon untuk melampirkan Surat Permohonan Pengujian resmi dari perusahaan sebelum dapat melanjutkan ke tahap selanjutnya.</li>
                            <li>Silahkan download contoh surat permohonan: <a target="_blank" href="{{ URL::asset('template.pdf') }}">Download template</a></li>
                            <li>Surat Permohonan Pengujian ditujukan kepada DIREKTUR UTAMA PT. LAPI ITB, Jl. Ganesha no15B, Bandung 40132.</li>
                        </ul>
                        <div class="order-field mt-4">
                        <label for="formFile" class="form-label">Upload file</label>
                        <input id="file" name="file" class="form-control" type="file" multiple>
                    </div>
                    </section>

                    <!-- btn next  -->
                    <div class="order-actions">
                        <button id="submit" type="submit" class="btn button-primary float-md-end">Next</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- end body  -->
    </body>

    </html>
@endsection
@extends('order.js.informasi-js')
@extends('order.user.globaluserscript')
