@extends('templates.header')

<body class="fill-bluewhite order-workflow">
    @extends('templates.navbar')
    @section('content')
        <div class="container p-0 my-5">
            <div class="order-shell">
                @include('templates.sidebar')

                <div class="my-container active-cont order-main">
                    <div class="order-page-header">
                        <h4>Sample Preparation</h4>
                        <p>Ringkasan jadwal pembukaan sample, catatan admin, dan detail preparasi.</p>
                    </div>

                    <div class="order-section prep-overview">
                        <div class="info-card">
                            <span>Waktu Sample Dibuka</span>
                            <strong>{{ indonesianDateFormat($project->estimated_opened) }}</strong>
                        </div>
                        <div class="info-card">
                            <span>Catatan</span>
                            <p>{{ isset($notes->notes) ? $notes->notes : 'Belum ada catatan dari admin.' }}</p>
                            @if (count($images) > 0)
                                <div class="prep-images">
                                    @foreach ($images as $item)
                                        <img src="{{ url('storage/feedback/images/' . $item->image . '') }}" alt="Feedback image" />
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    @if (count($preparing) > 0)
                        <div class="order-section">
                            <h5>Table Preparasi Sample</h5>
                            <div class="responsive-table-card">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Sample Code</th>
                                            <th scope="col">Depth (m)</th>
                                            <th scope="col">Length</th>
                                            <th scope="col">Lithology</th>
                                            <th scope="col">PP</th>
                                            <th scope="col">UCS</th>
                                            <th scope="col">DS</th>
                                            <th scope="col">UV</th>
                                            <th scope="col">PLI</th>
                                            <th scope="col">BZ</th>
                                            <th scope="col">TX</th>
                                            <th scope="col">Notice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($preparing as $row)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $row->sample_code }}</td>
                                                <td>{{ $row->depth }}</td>
                                                <td>{{ $row->length }}</td>
                                                <td>{{ $row->lithology }}</td>
                                                <td>{{ $row->pp }}</td>
                                                <td>{{ $row->ucs }}</td>
                                                <td>{{ $row->ds }}</td>
                                                <td>{{ $row->uv }}</td>
                                                <td>{{ $row->pli }}</td>
                                                <td>{{ $row->bz }}</td>
                                                <td>{{ $row->tx }}</td>
                                                <td>{{ $row->notice }}</td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="col" colspan="5" class="text-center">Total Tested</th>
                                            <th scope="col">{{ $preparing->sum('pp') }}</th>
                                            <th scope="col">{{ $preparing->sum('ucs') }}</th>
                                            <th scope="col">{{ $preparing->sum('ds') }}</th>
                                            <th scope="col">{{ $preparing->sum('uv') }}</th>
                                            <th scope="col">{{ $preparing->sum('pli') }}</th>
                                            <th scope="col">{{ $preparing->sum('bz') }}</th>
                                            <th scope="col">{{ $preparing->sum('tx') }}</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    @endif

                    <div class="order-actions">
                        <a href="{{ route('user.pengiriman') }}" class="btn button-primary-outline">Back</a>
                        <button id="submit" type="submit" class="btn button-primary">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
@extends('order.js.preparasi-js')
@extends('order.user.globaluserscript')
