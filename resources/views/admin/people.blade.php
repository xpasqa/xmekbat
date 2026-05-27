@extends('templates-admin.header')
@section('content')

    <body class="hold-transition sidebar-mini layout-fixed">
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
                                <h1><i class="fas fa-user-friends mr-2"></i> People Management</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.managePeople')}}">Home</a></li>
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
                                    <h3 class="card-title"><i class="fas fa-user-friends mr-2"></i> Management People</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row justify-content-end mr-1">
                                        <button id="button_tambah" type="button"
                                            class="btn btn-success mb-4 flex-row-reverse" data-toggle="modal"
                                            data-target="#exampleModalTambah">
                                            <i class="fas fa-user-plus mr-2"></i>
                                            Tambah
                                        </button>
                                    </div>
                                    <table id="example1" style="width: 100% !important;"
                                        class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Position</th>
                                                <th>Description</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- /.card-body -->

                                <!-- Modal tambah people -->
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
                                                <form id="form" action="{{ route('admin.addUser') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Name</label>
                                                        <input type="hidden" class="form-control" id="id_people"
                                                            name="id_people" />
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" placeholder="ex : Prof. Made Astawa Rai" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Slug</label>
                                                        <input id="slug" type="text" class="form-control" name="slug"
                                                            placeholder="ex : prof-made-astawa-rai" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Position</label>
                                                        <input type="text" class="form-control" id="position" name="position"
                                                            placeholder="ex : Professor of Mining Engineering" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea3">Description</label>
                                                        <textarea class="form-control" name="description" id="description" rows="5" placeholder="ex : By the time of ..."></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">File</label>
                                                        <input type="file" class="form-control" id="file"
                                                            name="file" />
                                                    </div>
                                                    <div class="form-group research">
                                                        <select class="form-control" id="tags" name="tags">
                                                            <option value="" id="">-- Select Research --
                                                            </option>
                                                            @foreach ($journals as $row)
                                                                <option value="{{ $row->id_journal }}"
                                                                    id="{{ $row->title }}">{{ $row->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group research">
                                                        <label for="exampleFormControlInput1">Selected Research</label>
                                                        <div class="row" id="selected_tag">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" id="submit" class="btn btn-primary">
                                                    Simpan
                                                </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal tambah jurnal -->
                                <div class="modal fade" id="modalJournals" tabindex="-1" role="dialog"
                                    aria-labelledby="modalJournalsLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalJournalsLabel">
                                                    Add Self Journals
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="form" action="{{ route('people.addSelfJournals') }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Title</label>
                                                        <input type="hidden" class="form-control" id="id_people2"
                                                            name="id_people2" />
                                                        <input type="text" class="form-control" id="title"
                                                            name="title" placeholder="ex : Research Of Mining" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Author</label>
                                                        <input type="text" class="form-control" id="author"
                                                            name="author" placeholder="ex : Iwan Sumarwan, Phd" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Type</label>
                                                        <input type="text" class="form-control" id="type"
                                                            name="type" placeholder="ex : Journals, Paper" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Date</label>
                                                        <input type="text" class="form-control" id="year"
                                                            name="year" placeholder="ex : 2022" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea3">Description</label>
                                                        <textarea class="form-control" name="description" id="description" rows="5"
                                                            placeholder="ex : By the time of ..."></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">keyword</label>
                                                        <input type="text" class="form-control" id="keyword"
                                                            name="keyword" placeholder="ex : mining,rock" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">File</label>
                                                        <input type="file" class="form-control" id="file"
                                                            name="file" />
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
            @extends('admin.js.people-js')
    </body>

    </html>
@endsection
