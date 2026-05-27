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
                ajax: "{{ route('testinfo.ajax-datatable') }}",
                columns: [
                    {
                        data: "id_test_info",
                        name: "id_test_info",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false,
                        searchable: false,
                        printable: true
                    },
                    {
                        data: "name",
                        name: "name"
                    },
                    {
                        data: "output",
                        name: "output",
                    },
                    {
                        data: "method",
                        name: "method",
                    },
                    {
                        data: "standard_method_description",
                        name: "standard_method_description",
                    },
                    {
                        data: "output_description",
                        name: "output_description",
                    },
                    {
                        data: "images",
                        name: "images",
                        render: function(data, type, row, meta) {
                            var output = '';
                            data.forEach(function(item) {
                                output += '<img src="{{ url('storage/testinfo') }}/' + item.image + '" class="img-thumbnail" width="200px">';
                            });
                            return output;
                        }
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
                var id_test_info = $(this).data('id_test_info');
                var name = $(this).data('name');
                var output = $(this).data('output');
                var method = $(this).data('method');
                var standard_method_description = $(this).data('standard_method_description');
                var output_description = $(this).data('output_description');
                $("#id_test_info").val(id_test_info);
                $("#name").val(name);
                $("#output").val(output);
                $("#method").val(method);
                $("#standard_method_description").val(standard_method_description);
                $("#output_description").val(output_description);
                $("#modal-edit").modal('show');

                $("#group1").hide();
                $("#group2").hide();
                $("#group3").hide();
                $('#form').attr('action', '{{ route('testinfo.editTestInfo') }}');
            });

            //Tambah
            $("#button_tambah").click(function() {
                $("#id_test_info").val('');
                $("#group1").show();
                $("#group2").show();
                $("#group3").show();
                $("#name").val('');
                $("#output").val('');
                $("#method").val('');
                $("#output_description").val('');
                $("#standard_method_description").val('');
                $('#form').attr('action', '{{ route('testinfo.addTestInfo') }}');
            });
        });
    </script>
@endsection
