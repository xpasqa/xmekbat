@extends('templates.header')

<body class="fill-bluewhite order-workflow">
    @extends('templates.navbar')
    @section('content')
        <div class="container p-0 my-5">
            <div class="order-shell">
                @include('templates.sidebar')

                <div class="my-container active-cont order-main">
                    <div class="order-page-header">
                        <h4>Quotation</h4>
                        <p>Review estimasi biaya pengujian dan preparasi sebelum pesanan dikonfirmasi.</p>
                    </div>

                    <div class="quote-table-card">
                        <div class="quote-table-head">
                            <span>No</span>
                            <span>Test</span>
                            <span>Rates</span>
                            <span>Quantity</span>
                            <span>Total</span>
                        </div>

                        <div class="quote-list scroll-content">
                            <?php $i = 1; ?>
                            <?php $totalqty_sample = 0; ?>
                            <?php $total_price = 0; ?>
                            @foreach ($orders as $row)
                                <div class="quote-row">
                                    <span class="quote-no">{{ $i }}</span>
                                    <span class="quote-name">{{ $row->name }}</span>
                                    <span>{{ rupiah($row->price_rates) }} / {{ $row->sample_rates }} Sample</span>
                                    <span>{{ $row->quantity }}</span>
                                    <strong>{{ rupiah($row->total) }}</strong>
                                </div>
                                <?php $totalqty_sample += $row->quantity * $row->sample_rates; ?>
                                <?php $total_price += $row->total; ?>
                                <?php $i++; ?>
                            @endforeach

                            <div class="quote-row quote-row-muted">
                                <span class="quote-no">{{ $i }}</span>
                                <span class="quote-name">{{ $preparation->name }}</span>
                                <span>{{ rupiah($preparation->price_rates) }} / {{ $preparation->sample_rates }} Sample</span>
                                <span>{{ $totalqty_sample }}</span>
                                <strong>{{ rupiah($preparation->price_rates * $totalqty_sample) }}</strong>
                            </div>
                        </div>

                        <div class="quote-total">
                            <span>Total Payment</span>
                            <strong>{{ rupiah($total_price + $preparation->price_rates * $totalqty_sample) }}</strong>
                        </div>
                    </div>

                    <div class="order-section order-note-section">
                        <h5>Additional Notes</h5>
                        <ul>
                            <li>There is an additional fee for the preparation fee of Rp. 40.000/specimen.</li>
                            <li>Sampling using coring method for Igneous rocks Rp. 10,000/cm and Sedimentary rocks Rp. 7,500/cm. The coring fee will be included on the invoice after the sample is received.</li>
                            <li>Harga belum termasuk pajak.</li>
                        </ul>
                    </div>

                    <div class="order-actions">
                        <a href="{{ route('user.pilihlab') }}" class="btn button-primary-outline">Back</a>
                        <button id="submit" type="submit" class="btn button-primary">Pesan</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
@extends('order.js.quotation-js')
@extends('order.user.globaluserscript')
