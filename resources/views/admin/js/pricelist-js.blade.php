@section('page-js')
    <!-- DataTables -->
    <script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                ajax: "{{ route('pricelist.ajax-datatable') }}",
                columns: [{
                        data: "id_pricelist",
                        name: "id_pricelist",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false,
                        searchable: false,
                        printable: true
                    },
                    {
                        data: "file",
                        name: "file",
                        render: function(data, type, row, meta) {
                            return '<a href="{{ url("storage/pricelist") }}/' + data + '" class="btn btn-outline-primary"><i class="fa fa-file mr-1"/></i>View File</a>';
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
            $("#example1").on("click", ".open-edit", function(){
                var id_pricelist = $(this).data('id_pricelist');
                $("#id_pricelist").val(id_pricelist);
                $('#form').attr('action', '{{route("pricelist.editPricelist")}}');
            });

            //Tambah
            $("#button_tambah").click(function(){
                $("#id_pricelist").val('');
                $('#form').attr('action', '{{route("pricelist.addPricelist")}}');
            });
        });

        function convertIndonesianDate(date) {
            var date = new Date(date);
            var day = date.getDate();
            var bulan = date.getMonth() + 1;
            var year = date.getFullYear();
            switch (bulan) {
                case 0:
                    bulan = "Januari";
                    break;
                case 1:
                    bulan = "Februari";
                    break;
                case 2:
                    bulan = "Maret";
                    break;
                case 3:
                    bulan = "April";
                    break;
                case 4:
                    bulan = "Mei";
                    break;
                case 5:
                    bulan = "Juni";
                    break;
                case 6:
                    bulan = "Juli";
                    break;
                case 7:
                    bulan = "Agustus";
                    break;
                case 8:
                    bulan = "September";
                    break;
                case 9:
                    bulan = "Oktober";
                    break;
                case 10:
                    bulan = "November";
                    break;
                case 11:
                    bulan = "Desember";
                    break;
            }
            var time = day + " " + bulan + " " + year;
            return time;
        }
    </script>
@endsection
