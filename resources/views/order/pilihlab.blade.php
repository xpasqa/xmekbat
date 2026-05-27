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
                        <h4>Test Categories</h4>
                        <p>Project: {{ strtoupper($project->project_name) }}</p>
                    </div>

                    <!-- list  -->
                    <div class="test-table-card">
                        <div class="test-table-head">
                            <span></span>
                            <span>Test</span>
                            <span>Rates</span>
                            <span>Quantity</span>
                            <span>Total</span>
                        </div>
                        <div class="scroll-content test-list">
                            @foreach ($sample as $row)
                                <div class="test-row" id="rows">
                                    <div class="test-select">
                                        <input class="form-check-input m-0 p-0" type="checkbox"
                                            value="{{ $row->price_rates }}" id="{{ $row->id_sample }}" />
                                    </div>
                                    <div class="test-name">
                                        <p class="m-0 pcard">{{ $row->name }}</p>
                                    </div>
                                    <div class="test-rate">
                                        <p class="pcard">{{ rupiah($row->price_rates) }} / {{ $row->sample_rates }} Sample</p>
                                    </div>
                                    <div class="test-qty">
                                        <p class="qty">
                                            <input type="number" class="boxqty" min="0" max="99" name="qty[]"
                                                id="qty-{{ $row->id_sample }}" step="1" value="0" readonly />
                                        </p>
                                    </div>
                                    <div class="test-total pcard" id="selfprice-{{ $row->id_sample }}">Rp. 0</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- end list  -->

                    <!-- btn next  -->
                    <div class="order-actions test-actions">
                        <a href="{{ route('user.informasi') }}" class="btn button-primary-outline">Back</a>
                        <div class="test-summary">
                            <span id="total_produk">Total (0 Produk) : <strong> Rp 0</strong> </span>
                            <button id="submit" type="submit" class="btn button-primary">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end body  -->
    </body>

    </html>
@endsection
@extends('order.js.pilihlab-js')
@extends('order.user.globaluserscript')
