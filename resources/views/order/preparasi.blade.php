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
                    <h4 class="color-dark font-black mt-3">Preparasi Sample</h4>

                    <div class="row">
                        <div class="col-4">
                            <p class="mb-1 mt-2 pcard color-dark">Waktu Sample Dibuka</p>
                            <p>{{indonesianDateFormat($project->estimated_opened)}}</p>
                        </div>
                        <div class="col">
                            @if (isset($notes->notes))
                                <p class="mb-1 mt-2 pcard color-dark">Catatan</p>
                                <p>{{$notes->notes}}</p>
                            @endif
                            <div class="">
                              @foreach ($images as $item)
                                <img src="{{ url('storage/feedback/images/'.$item->image.'') }}" width="80px" />
                              @endforeach
                            </div>
                        </div>
                    </div>

                    @if (count($preparing) > 0)
                        <h5 class="color-dark font-black mt-5 mb-3">Table Preparasi Sample</h5>
                        <table class="table table-bordered">
                            <thead class="fill-bluesky">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Sample Code</th>
                                    <th scope="col">Depth (m)</th>
                                    <th scope="col">Legth</th>
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
                                    <?php $i++; ?>;
                                @endforeach
                            </tbody>
                            <thead class="fill-bluesky">
                                <tr">
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
                            </thead>
                        </table>
                    @endif
                    <div class="mt-5">
                        <hr />
                    </div>

                    <!-- btn next  -->
                    <div class="mt-4">
                        <a href="{{route('user.pengiriman')}}" class="btn button-primary-outline float-md-start px-5 py-2">Back</a>
                        <button id="submit" type="submit" class="btn button-primary float-md-end px-5 py-2"
                            style="margin-left: 50px">
                            Next
                        </button>
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
@extends('order.js.preparasi-js')
@extends('order.user.globaluserscript')
