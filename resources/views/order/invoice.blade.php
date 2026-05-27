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
                            <h4 class="color-dark font-black mt-3">Invoice</h4>
                        </div>
                        @if ($project->invoice != null)
                            <div class="col text-end">
                                <a href="{{ url('storage/order/invoice/' . $project->invoice . '') }}" target="_blank"
                                    class="btn button-primary">Download PDF</a>
                            </div>
                        @endif
                    </div>

                    <p>Sample telah selesai ditest. Silahkan lakukan Pembayaran untuk dapat mendownload hasil test.</p>
                    @if ($project->invoice != null)
                      <embed src="{{ url('storage/order/invoice/' . $project->invoice . '') }}"
                                type="application/pdf" frameBorder="0" scrolling="auto" height="100%"
                                width="100%"></embed>
                    @endif

                   <?php
                    if($project->bukti_pembayaran == null){
                        $icon = 'times';
                    }
                    else {
                        $icon = 'check';
                    } 
                   
                   ?>
                    <h4 class="color-dark font-black mt-5">Bukti Pembayaran</h4>

                    <div class="mb-3 mt-4">
                        <label for="formFile" class="form-label">Upload file</label>
                        @if ($project->bukti_pembayaran != null)
                            <span class="form-control" aria-hidden="true"><a target="_blank" href="{{ url('storage/order/bukti/' . $project->bukti_pembayaran . '') }}">{{$project->bukti_pembayaran}}</a>
                            <span class="ml-3 pl-4 closed" id="{{$project->id_project}}">&times;</span></span>
                        @else
                            <input class="form-control" type="file" id="file" name="file" multiple />
                        @endif
                    </div>

                    <p class="pcard">* Mohon menunggu pembayaran terverifikasi untuk dapat mendownload dokumen hasil test.
                    </p>

                    <div class="mt-5">
                        <hr />
                    </div>

                    <!-- btn next  -->
                    <div class="mt-4">
                        <a href="{{route('user.labtest')}}" class="btn button-primary-outline float-md-start px-5 py-2">Back</a>
                        <button id="submit" type="submit" class="btn button-primary float-md-end px-5 py-2" style="margin-left: 50px">
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
@extends('order.js.invoice-js')
@extends('order.user.globaluserscript')
