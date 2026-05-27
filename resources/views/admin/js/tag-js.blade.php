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
                ajax: "{{ route('tag.ajax-datatable') }}",
                columns: [{
                        data: "id_tag",
                        name: "id_tag",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false,
                        searchable: false,
                        printable: true
                    },
                    {
                        data: "name",
                        name: "name",
                        render: function(data, type, row, meta) {
                            return '<button href="#" class="btn btn-outline-primary"><i class="fa fa-hashtag mr-1"/></i>' + data + '</button>';
                        },
                    },
                    {
                        data: "created_at",
                        name: "created_at",
                        render: function(data, type, full) {
                            return convertIndonesianDate(data);
                        }
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
                var id_tag = $(this).data('id_tag');
                var name = $(this).data('name');
                $("#id_tag").val(id_tag);
                $("#name").val(name);
                $('#form').attr('action', '{{ route("tag.editTag") }}');
            });

            //Tambah
            $("#button_tambah").click(function() {
                $("id_tag").val('');
                $("#name").val('');
                $('#form').attr('action', '{{ route("tag.addTag") }}');
            });
        });
    </script>
@endsection
