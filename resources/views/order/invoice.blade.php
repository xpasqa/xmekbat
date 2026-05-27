@extends('templates.header')

<body class="fill-bluewhite order-workflow">
    @extends('templates.navbar')
    @section('content')
        <div class="container p-0 my-5">
            <div class="order-shell">
                @include('templates.sidebar')

                <div class="my-container active-cont order-main">
                    <div class="order-page-header order-page-header-split">
                        <div>
                            <h4>Invoice</h4>
                            <p>Download invoice dan upload bukti pembayaran untuk verifikasi admin.</p>
                        </div>
                        @if ($project->invoice != null)
                            <a href="{{ url('storage/order/invoice/' . $project->invoice . '') }}" target="_blank"
                                class="btn button-primary">Download PDF</a>
                        @endif
                    </div>

                    <div class="order-section invoice-panel">
                        <p>Sample telah selesai ditest. Silahkan lakukan pembayaran untuk dapat mendownload hasil test.</p>
                        @if ($project->invoice != null)
                            <div class="pdf-viewer">
                                <embed src="{{ url('storage/order/invoice/' . $project->invoice . '') }}"
                                    type="application/pdf" frameBorder="0" scrolling="auto"></embed>
                            </div>
                        @else
                            <div class="empty-state">Invoice belum tersedia.</div>
                        @endif
                    </div>

                    <div class="order-section">
                        <h5>Bukti Pembayaran</h5>
                        <div class="payment-upload">
                            <label for="file" class="form-label">Upload file</label>
                            @if ($project->bukti_pembayaran != null)
                                <span class="form-control payment-file" aria-hidden="true">
                                    <a target="_blank" href="{{ url('storage/order/bukti/' . $project->bukti_pembayaran . '') }}">{{ $project->bukti_pembayaran }}</a>
                                    <span class="closed" id="{{ $project->id_project }}">&times;</span>
                                </span>
                            @else
                                <input class="form-control" type="file" id="file" name="file" multiple />
                            @endif
                        </div>

                        <p class="helper-text">* Mohon menunggu pembayaran terverifikasi untuk dapat mendownload dokumen hasil test.</p>
                    </div>

                    <div class="order-actions">
                        <a href="{{ route('user.labtest') }}" class="btn button-primary-outline">Back</a>
                        <button id="submit" type="submit" class="btn button-primary">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
@extends('order.js.invoice-js')
@extends('order.user.globaluserscript')
