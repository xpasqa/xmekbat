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
                ajax: "{{ route('preparation.ajax-datatable') }}",
                columns: [{
                        data: "id_sample",
                        name: "id_sample",
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
                        data: "price_rates",
                        name: "price_rates",
                        render: function(data, type, row, meta) {
                            return formatRupiah(row.price_rates, 0) + ' / ' + row.sample_rates + ' Sample';
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
                var id_sample = $(this).data('id_sample');
                var name = $(this).data('name');
                var sample_rates = $(this).data('sample_rates');
                var price_rates = $(this).data('price_rates');
                $("#id_sample").val(id_sample);
                $("#name").val(name);
                $("#sample_rates").val(sample_rates);
                $("#price_rates").val(price_rates);
                $("#modal-edit").modal('show');
                $('#form').attr('action', '{{ route('preparation.editPreparation') }}');
            });

            //Tambah
            $("#button_tambah").click(function() {
                $("id_sample").val('');
                $("#name").val('');
                $("#sample_rates").val('');
                $("#price_rates").val('');
                $('#form').attr('action', '{{ route('preparation.addPreparation') }}');
            });
        });
    </script>
@endsection
