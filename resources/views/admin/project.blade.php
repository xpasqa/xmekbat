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
                                <h1><i class="fas fa-shopping-bag mr-2"></i> Orders Management</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.manageProject')}}">Home</a></li>
                                    <li class="breadcrumb-item active">DataTables</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                        <li class="nav-item" id="all">
                                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                                href="#custom-tabs-four-home" role="tab"
                                                aria-controls="custom-tabs-four-home" aria-selected="true">All</a>
                                        </li>
                                        <li class="nav-item" id="waiting">
                                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                                href="#custom-tabs-four-profile" role="tab"
                                                aria-controls="custom-tabs-four-profile" aria-selected="false">Waiting
                                                ({{ $waiting }})</a>
                                        </li>
                                        <li class="nav-item" id="accepted">
                                            <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                                href="#custom-tabs-four-messages" role="tab"
                                                aria-controls="custom-tabs-four-messages" aria-selected="false">Accepted
                                                ({{ $accepted }})</a>
                                        </li>
                                        <li class="nav-item" id="preparing">
                                            <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                                                href="#custom-tabs-four-settings" role="tab"
                                                aria-controls="custom-tabs-four-settings" aria-selected="false">Preparing
                                                ({{ $preparing }})</a>
                                        </li>
                                        <li class="nav-item" id="testing">
                                            <a class="nav-link" id="custom-tabs-four-testing-tab" data-toggle="pill"
                                                href="#custom-tabs-four-testing" role="tab"
                                                aria-controls="custom-tabs-four-testing" aria-selected="false">Testing
                                                ({{ $testing }})</a>
                                        </li>
                                        <li class="nav-item" id="invoicing">
                                            <a class="nav-link" id="custom-tabs-four-invoicing-tab" data-toggle="pill"
                                                href="#custom-tabs-four-invoicing" role="tab"
                                                aria-controls="custom-tabs-four-invoicing" aria-selected="false">Invoicing
                                                ({{ $invoicing }})</a>
                                        </li>
                                        <li class="nav-item" id="completed">
                                            <a class="nav-link" id="custom-tabs-four-completed-tab" data-toggle="pill"
                                                href="#custom-tabs-four-completed" role="tab"
                                                aria-controls="custom-tabs-four-completed" aria-selected="false">Completed
                                                ({{ $completed }})</a>
                                        </li>
                                        <li class="nav-item" id="archived">
                                            <a class="nav-link" id="custom-tabs-four-archived-tab" data-toggle="pill"
                                                href="#custom-tabs-four-archived" role="tab"
                                                aria-controls="custom-tabs-four-archived" aria-selected="false">Archived
                                                ({{ $archived }})</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-end mr-1">
                                        <button id="button_tambah" type="button"
                                            class="btn btn-success mb-4 flex-row-reverse mr-2" data-toggle="modal"
                                            data-target="#exampleModalTambah2">
                                            <i class="fas fa-user-plus mr-2"></i>
                                            Tambah
                                        </button>
                                    </div>
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                                            aria-labelledby="custom-tabs-four-home-tab">
                                            <table id="example1" style="width: 100% !important;"
                                                class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No.Order</th>
                                                        <th>Project Name</th>
                                                        <th>Company</th>
                                                        <th>PIC</th>
                                                        <th>Document</th>
                                                        <th>Payment</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                            aria-labelledby="custom-tabs-four-profile-tab">
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                                            aria-labelledby="custom-tabs-four-messages-tab">
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                                            aria-labelledby="custom-tabs-four-settings-tab">
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-four-testing" role="tabpanel"
                                            aria-labelledby="custom-tabs-four-testing-tab">
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-four-invoicing" role="tabpanel"
                                            aria-labelledby="custom-tabs-four-invoicing-tab">
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-four-completed" role="tabpanel"
                                            aria-labelledby="custom-tabs-four-completed-tab">
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-four-archived" role="tabpanel"
                                            aria-labelledby="custom-tabs-four-archived-tab">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </section>
                @include('admin.partial.project-modal')
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            @extends('templates-admin.footer')
            @extends('admin.js.project-js')
    </body>

    </html>
@endsection
