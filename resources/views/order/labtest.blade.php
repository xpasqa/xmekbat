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
                            <h4>Rock Testing</h4>
                            <p>Progress pengujian untuk {{ strtoupper($project[0]->project->project_name) }}.</p>
                        </div>
                        <div class="header-meta">
                            <span>Test Dimulai</span>
                            <strong>{{ indonesianDateFormat(date('Y-m-d', strtotime($project[0]->project->created_at))) }}</strong>
                        </div>
                    </div>

                    <div class="order-section">
                        <div class="lab-progress-summary">
                            <span>Total Progress</span>
                            <strong>{{ calculatePercentage($total_sample, $total_selesai) }}%</strong>
                        </div>
                        <div class="progress progress-big lab-progress-bar">
                            <div id="total_progress" class="progress-bar fill-blue" role="progressbar"
                                style="width: {{ calculatePercentage($total_sample, $total_selesai) }}%"
                                aria-valuenow="{{ calculatePercentage($total_sample, $total_selesai) }}" aria-valuemin="0"
                                aria-valuemax="100">
                                {{ calculatePercentage($total_sample, $total_selesai) }}%
                            </div>
                        </div>
                    </div>

                    <div class="lab-test-list">
                        <?php $i = 1; ?>
                        @foreach ($project as $row)
                            <div class="lab-test-card">
                                <div class="lab-test-card-head">
                                    <strong>{{ $i }}. {{ $row->sample->name }}</strong>
                                    <span>{{ $row->quantity }} Sample</span>
                                </div>
                                @if (isset($row->labtest))
                                    <div class="progress lab-progress-bar">
                                        <div class="progress-bar bg-success green-rounded" role="progressbar"
                                            style="width: {{ calculatePercentage($row->quantity * $row->sample->sample_rates, $row->labtest->selesai_qty) }}%"
                                            aria-valuenow="{{ calculatePercentage($row->quantity * $row->sample->sample_rates, $row->labtest->selesai_qty) }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                            {{ calculatePercentage($row->quantity * $row->sample->sample_rates, $row->labtest->selesai_qty) }}%
                                        </div>
                                    </div>
                                @else
                                    <div class="progress lab-progress-bar">
                                        <div class="progress-bar bg-success green-rounded" role="progressbar" style="width: 5%"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                            0%
                                        </div>
                                    </div>
                                @endif
                                <p>
                                    <span>Catatan</span>
                                    {{ isset($row->labtest->catatan) ? $row->labtest->catatan : 'There is no noted provided for this data' }}
                                </p>
                            </div>
                            <?php $i++; ?>
                        @endforeach
                    </div>

                    <div class="order-actions">
                        <a href="{{ route('user.preparasi') }}" class="btn button-primary-outline">Back</a>
                        <button id="submit" type="submit" class="btn button-primary">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
@endsection
@extends('order.js.labtest-js')
@extends('order.user.globaluserscript')
