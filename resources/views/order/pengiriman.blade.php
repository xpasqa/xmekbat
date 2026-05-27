@extends('templates.header')

<body class="fill-bluewhite order-workflow">
    @extends('templates.navbar')
    @section('content')
        <div class="container p-0 my-5">
            <div class="order-shell">
                @include('templates.sidebar')

                <div class="my-container active-cont order-main">
                    <div class="order-page-header">
                        <h4>Shipping</h4>
                        <p>Informasi pengiriman sample dan status penerimaan dari laboratorium.</p>
                    </div>

                    <div class="order-section info-grid">
                        <div class="info-card">
                            <span>Alamat Pengiriman</span>
                            <p>Please send samples to Jl. Ganesa 10, Bandung, 40132 and confirm it on the web to ensure the lab team put it on the waiting list.</p>
                        </div>
                        <div class="info-card">
                            <span>SOP Packing</span>
                            <p>This practice covers the guidelines, requirements, and procedures for core drilling, coring, and sampling of rock for the purposes of site exploration.</p>
                        </div>
                        <div class="info-card">
                            <span>SOP Dimensi Sample</span>
                            <p>Please refer to the sample <a href="#">specification page</a>.</p>
                        </div>
                    </div>

                    <div class="order-section">
                        <h5>Status Pengiriman Sample</h5>
                        <div class="status-grid">
                            <div>
                                <span>No Pesanan</span>
                                <strong>{{ $project->no_order }}</strong>
                            </div>
                            <div>
                                <span>Status</span>
                                <strong>{{ $project->status }}</strong>
                            </div>
                            <div>
                                <span>Waktu Diterima</span>
                                <strong id="accepted_at">{{ indonesianDateFormat($project->accepted_at) }}</strong>
                            </div>
                            <div>
                                <span>Estimasi Sample Dibuka</span>
                                <strong id="dates">{{ indonesianDateFormat($project->estimated_opened) }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="order-actions">
                        <a href="{{ route('user.quotation') }}" class="btn button-primary-outline">Back</a>
                        <button id="submit" type="submit" class="btn button-primary">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
@endsection
@extends('order.js.pengiriman-js')
@extends('order.user.globaluserscript')
