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
                                <h1><i class="fas fa-user mr-2"></i> User Management</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.manageUser')}}">Home</a></li>
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
                                    <h3 class="card-title"><i class="fas fa-user mr-2"></i> Management User</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row justify-content-end mr-1">
                                        <button id="button_tambah" type="button" class="btn btn-success mb-4 flex-row-reverse"
                                            data-toggle="modal" data-target="#exampleModalTambah">
                                            <i class="fas fa-user-plus mr-2"></i>
                                            Tambah
                                        </button>
                                    </div>
                                    <table id="example1" style="width: 100% !important;"
                                        class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Dibuat Pada</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- /.card-body -->

                                <!-- Modal tambah -->
                                <div class="modal fade" id="exampleModalTambah" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalTambahLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalTambahLabel">
                                                    Tambah
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="form" action="{{route('admin.addUser')}}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Nama</label>
                                                        <input type="hidden" class="form-control" id="id"
                                                            name="id" />
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" placeholder="cth : Riki Ahmad" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Email</label>
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" placeholder="cth : ahmadriki9512@gmail.com" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Password</label>
                                                        <input type="password" class="form-control" id="password"
                                                            name="password" placeholder="cth : password123" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect3">Role User</label>
                                                        <select class="form-control" id="role" name="role">
                                                            <option value="admin">admin</option>
                                                            <option value="user">user</option>
                                                            <option value="editor">editor</option>
                                                            <option value="tester">tester</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">
                                                    Simpan
                                                </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
            @extends('admin.js.user-js')
    </body>

    </html>
@endsection
