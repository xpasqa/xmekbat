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
                            <h4 class="color-dark font-black mt-3">LAB TEST PROCESS - {{ strtoupper($project[0]->project->project_name) }}</h4>
                        </div>
                        <div class="col text-end">
                            <span class="float-md-end pcard">Test Dimulai <br />
                                <strong>{{ indonesianDateFormat(date('Y-m-d', strtotime($project[0]->project->created_at))) }}</strong></span>
                        </div>
                    </div>

                    <!-- list  -->
                    <div class="progress progress-big">
                        <div id="total_progress" class="progress-bar fill-blue" role="progressbar"
                            style="width: {{ calculatePercentage($total_sample, $total_selesai) }}%"
                            aria-valuenow="{{ calculatePercentage($total_sample, $total_selesai) }}" aria-valuemin="0"
                            aria-valuemax="100">
                            {{ calculatePercentage($total_sample, $total_selesai) }}%
                        </div>
                    </div>

                    <!-- 1  -->
                    <?php $i = 1; ?>
                    @foreach ($project as $row)
                        <p class="color-dark font-bold mt-4">{{ $i }}. {{ $row->sample->name }}
                            ({{ $row->quantity }} Sample )</p>
                        <div class="progress">
                            @if (isset($row->labtest))
                                <div class="progress-bar bg-success green-rounded" role="progressbar"
                                    style="width: {{ calculatePercentage($row->quantity * $row->sample->sample_rates, $row->labtest->selesai_qty) }}%"
                                    aria-valuenow="{{ calculatePercentage($row->quantity * $row->sample->sample_rates, $row->labtest->selesai_qty) }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    {{ calculatePercentage($row->quantity * $row->sample->sample_rates, $row->labtest->selesai_qty) }}%
                                @else
                                    <div class="progress-bar bg-success green-rounded" role="progressbar" style="width: 5%"
                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        0%
                            @endif
                        </div>
                </div>
                @if (isset($row->labtest->catatan))
                    <p class="pcard mt-3 color-dark">
                        Catatan : <br />
                        {{ $row->labtest->catatan }}
                    </p>
                @else
                    <p class="pcard mt-3 color-dark">
                        Catatan : <br />
                        There is no noted provided for this data
                    </p>
                @endif
                <?php $i++; ?>
                @endforeach
                <div class="mt-5">
                    <hr />
                </div>

                <!-- btn next  -->
                <div class="mt-4">
                    <a href="{{route('user.preparasi')}}" class="btn button-primary-outline float-md-start px-5 py-2">Back</a>
                    <button id="submit" type="submit" class="btn button-primary float-md-end px-5 py-2"
                        style="margin-left: 50px">
                        Next
                    </button>
                </div>
                <br /><br /><br />
            </div>
        </div>
        </div>
    </body>
    </html>
@endsection
@extends('order.js.labtest-js')
@extends('order.user.globaluserscript')
