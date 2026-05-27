@extends('templates-admin.header')
@section('content')
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @extends('templates-admin.navbar')

        <!-- Main Sidebar Container -->
        @extends('templates-admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-shopping-bag mr-2"></i> {{ $project->project_name }} - {{ $project->status }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">DataTables</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-shopping-bag mr-2"></i> {{ $project->project_name }} - {{ $project->status }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row justify-content-end mr-1">
                                    <button id="button_tambah" type="button" class="btn btn-success mb-4 flex-row-reverse mr-2" data-toggle="modal" data-target="#exampleModalTambah">
                                        <i class="fas fa-user-plus mr-2"></i>
                                        Tambah
                                    </button>
                                    @if ($project->status == 'completed')
                                        <a id="print" href="{{ route('admin.pdfDetailProject', ['id' => $project->id_project]) }}"
                                            class="btn btn-info mb-4 flex-row-reverse mr-2">
                                            <i class="fas fa-print mr-2"></i>
                                            Print PDF
                                        </a>
                                    @endif
                                    <button id="button_archive" type="button" data-id_project="{{ $project->id_project }}" class="btn btn-warning mb-4 flex-row-reverse">
                                        <i class="fas fa-archive mr-2"></i>
                                        Archive Project
                                    </button>
                                </div>
                                <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Project Name</th>
                                            <th>Project Location</th>
                                            <th>Company</th>
                                            <th>Nama PIC</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Surat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row mt-4 m-1">
                                        <h5 class="font-weight-bold">Quotation</h5>
                                    </div>
                                    <div class="row justify-content-end m-1">
                                        <button id="button_add_quotation" type="button"
                                            class="btn btn-success mb-1 flex-row-reverse mr-2" data-toggle="modal"
                                            data-target="#exampleModalOrder" data-id_project="{{ $project->id_project }}">
                                            <i class="fas fa-user-plus mr-2"></i>
                                            Tambah
                                        </button>
                                        <table id="example2" class="table table-bordered table-striped" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Test Sample</th>
                                                    <th>Rates</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>

                                    <div class="row mt-4 m-1">
                                        <h5 class="font-weight-bold">Preparation</h5>
                                    </div>
                                    <div class="row m-1">
                                        <table id="example3" class="table table-bordered table-striped" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Accepted Date</th>
                                                    <th>Process Estimation</th>
                                                    <th>Images</th>
                                                    <th>Notes</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="row mt-4 m-1">
                                        <h5 class="font-weight-bold">Testing</h5>
                                    </div>
                                    <div class="row m-1">
                                        <table id="example4" class="table table-bordered table-striped" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Test Categories</th>
                                                    <th>Jumlah Sample</th>
                                                    <th>Selesai Test</th>
                                                    <th>%</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="row mt-4 m-1">
                                        <h5 class="font-weight-bold">Invoicing</h5>
                                    </div>
                                    <div class="row m-1">
                                        <table id="example5" class="table table-bordered table-striped" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Invoice</th>
                                                    <th>Bukti Pembayaran</th>
                                                    <th>Status Pembayaran</th>
                                                    <th>Finished Date</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="row mt-4 m-1">
                                        <h5 class="font-weight-bold">Sample Report</h5>
                                    </div>
                                    <div class="row m-1">
                                        <table id="example6" class="table table-bordered table-striped" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Document Name</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    @if (isset($survey))
                                        <div class="row mt-4 m-1">
                                            <h5 class="font-weight-bold">Survey Kepuasan</h5>
                                        </div>
                                        <div class="row m-1">
                                            <table id="example7" class="table table-bordered table-striped" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    @endif
                                    @if (isset($project->saran))
                                        <div class="row mt-3 m-1">
                                            <h5>Saran :</h5>
                                        </div>
                                        <div class="border border-dark">
                                            <p class="m-3 text-left">{{$project->saran}}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->
                            @include('admin.partial.detail-project-modal')
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
        </div>
        <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @extends('templates-admin.footer')
    @extends('admin.js.detailproject-js')
</body>

</html>
@endsection
