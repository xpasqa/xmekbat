@section('page-js')
    <!-- DataTables -->
    <script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ URL::asset('helpers/generalhelper.js') }}"></script>

    @if (session('action'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Success!',
                    icon: 'success',
                    showConfirmButton: false,
                })
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            //Datatable
            $('#example1').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ route('journals.ajax-datatable') }}",
                columns: [{
                        data: "id_journal",
                        name: "id_journal",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false,
                        searchable: false,
                        printable: true
                    },
                    {
                        data: "title",
                        name: "title"
                    },
                    {
                        data: "author",
                        name: "author",
                    },
                    {
                        data: "type",
                        name: "type",
                    },
                    {
                        data: "year",
                        name: "year",
                    },
                    {
                        data: "description",
                        name: "description",
                    },
                    {
                        data: "keyword",
                        name: "keyword",
                    },
                    {
                        data: "file",
                        name: "file",
                        render: function(data, type, full) {
                            return '<a href="{{url("storage/journals")}}/'+data+'" target="_blank" class="btn btn-sm btn-outline-info"><span class="fa fa-file-pdf"/></a>';
                        }
                    },
                    {
                        data: "created_at",
                        name: "created_at",
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            //Edit
            $("#example1").on("click", ".open-edit", function() {
                var id_journal = $(this).data('id_journal');
                var title = $(this).data('title');
                var author = $(this).data('author');
                var type = $(this).data('type');
                var year = $(this).data('year');
                var description = $(this).data('description');
                var keyword = $(this).data('keyword');
                $("#id_journal").val(id_journal);
                $("#title").val(title);
                $("#author").val(author);
                $("#type").val(type);
                $("#year").val(year);
                $("#description").val(description);
                $("#keyword").val(keyword);
                $("#file").val('');
                $('#form').attr('action', '{{ route('journals.editJournals') }}');
            });

            //Tambah
            $("#button_tambah").click(function() {
                $("#id_journal").val('');
                $("#title").val('');
                $("#author").val('');
                $("#type").val('');
                $("#year").val('');
                $("#description").val('');
                $("#keyword").val('');
                $("#file").val('');
                $('#form').attr('action', '{{ route('journals.addJournals') }}');
            });
        });
    </script>
@endsection
