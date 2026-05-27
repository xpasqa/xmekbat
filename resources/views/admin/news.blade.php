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
                                <h1><i class="fas fa-newspaper mr-2"></i> News & IRMS Management</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.manageNews')}}">Home</a></li>
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
                                    <h3 class="card-title"><i class="fas fa-newspaper mr-2"></i> News & IRMS Management</h3>
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
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Filter</label>
                                            <select class="form-control" id="type_filter" name="type_filter">
                                                <option value="News">News</option>
                                                <option value="IRMS">IRMS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <table id="example1" style="width: 100% !important;"
                                        class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Title</th>
                                                <th>Cover</th>
                                                <th>Content</th>
                                                <th>Tags</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- /.card-body -->

                                <!-- Modal tambah -->
                                <div class="modal fade" id="exampleModalTambah" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalTambahLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
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
                                                <form id="form" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">News Title</label>
                                                        <input type="hidden" class="form-control" id="id_news"
                                                            name="id_news" />
                                                        <input type="text" class="form-control" id="title"
                                                            name="title" placeholder="ex : Mining the rocks" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">News Cover</label>
                                                        <input type="file" class="form-control" id="cover"
                                                            name="cover" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Image Content
                                                            (Optional)</label>
                                                        <input type="file" class="form-control" id="image_content"
                                                            name="image_content" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea3">News Content</label>
                                                        <textarea class="form-control" name="content" id="content" rows="5" placeholder="ex : By the time of ..."></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Types</label>
                                                        <select class="form-control" id="type" name="type">
                                                            <option value="News">News</option>
                                                            <option value="IRMS">IRMS</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Tags</label>
                                                        <select class="form-control" id="tags" name="tags">
                                                            <option value="" id="">-- Select Tag --</option>
                                                            @foreach ($tags as $row)
                                                                <option value="{{ $row->id_tag }}"
                                                                    id="{{ $row->name }}">{{ $row->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Selected Tags</label>
                                                        <div class="row" id="selected_tag">
                                                        </div>
                                                    </div>
                                            </div>
                                            </form>
                                            <div class="modal-footer">
                                                <button id="submit" class="btn btn-primary">
                                                    Simpan
                                                </button>
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
            @extends('admin.js.news-js')
    </body>

    </html>
@endsection
