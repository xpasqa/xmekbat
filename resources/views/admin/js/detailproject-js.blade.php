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
            loadTables();
            editAction();
            archiveButton();
            addAction();
        });

        function loadTables() {
            //Datatable
            $('#example1').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                searching: false,
                paging: false,
                info: false,
                ajax: {
                    url: "{{ route('project.ajax-detail-datatable') }}",
                    data: function(data) {
                        data.id = '{{ $id }}';
                    }
                },
                columns: [{
                        data: "id_order",
                        name: "id_order",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false,
                        searchable: false,
                        printable: true
                    },
                    {
                        data: "project_name",
                        name: "project_name",
                    },
                    {
                        data: "project_location",
                        name: "project_location"
                    },
                    {
                        data: "company_name",
                        name: "company_name",
                    },
                    {
                        data: "pic",
                        name: "pic",
                    },
                    {
                        data: "email",
                        name: "email",
                    },
                    {
                        data: "phone",
                        name: "phone",
                    },
                    {
                        data: "file",
                        name: "file",
                        render: function(data, type, row, meta) {
                            return '<a target="_blank" href="{{url('storage/project/docs')}}/'+data+'" class="btn btn-sm btn-outline-info"><span class="fa fa-file"/></a';
                        },
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            //Table 2
            $('#example2').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{ route('order.ajax') }}",
                    data: function(data) {
                        data.id_project = '{{ $id }}';
                    }
                },
                columns: [{
                        data: "id_order",
                        name: "id_order",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false,
                        searchable: false,
                        printable: true
                    },
                    {
                        data: "sample.name",
                        name: "sample.name"
                    },
                    {
                        data: "sample",
                        name: "sample",
                        render: function(data, type, full) {
                            return `${data.price_rates} / ${data.sample_rates} Sample`;
                        }
                    },
                    {
                        data: "quantity",
                        name: "quantity",
                    },
                    {
                        data: "total",
                        name: "total",
                        render: function(data, type, full) {
                            return `Rp. ${formatRupiah(data)}`;
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
            $("#example2_wrapper").css("width", "100%");

            //Table 3
            $('#example3').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                searching: false,
                paging: false,
                info: false,
                ajax: {
                    url: "{{ route('project.ajax-detail-datatable') }}",
                    data: function(data) {
                        data.id = '{{ $id }}';
                        data.type = 'preparation';
                    }
                },
                columns: [{
                        data: "id_order",
                        name: "id_order",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false,
                        searchable: false,
                        printable: true
                    },
                    {
                        data: "accepted_at",
                        name: "accepted_at",
                        render: function(data, type, full) {
                            return convertIndonesianDate(data);
                        }
                    },
                    {
                        data: "estimated_opened",
                        name: "estimated_opened",
                        render: function(data, type, full) {
                            return convertIndonesianDate(data);
                        }
                    },
                    {
                        data: "preparing_image",
                        name: "preparing_image",
                        render: function(data, type, row, meta) {
                            var output = '';
                            data.forEach(function(item) {
                                output +=
                                    '<img src="{{ url('storage/feedback/images') }}/' +
                                    item.image + '" class="img-thumbnail" width="100px">';
                            });
                            return output;
                        },

                    },
                    {
                        data: "notes",
                        name: "notes",
                        render: function(data, type, row, meta) {
                            var output = '';
                            data.forEach(function(item) {
                                output += item.notes + '<br>';
                            });
                            return output;
                        },
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $("#example3_wrapper").css("width", "100%");

            //Table 4
            $('#example4').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{ route('project.getAjaxTestSample2') }}",
                    data: function(data) {
                        data.id_project = '{{ $id }}';
                    }
                },
                columns: [{
                        data: "id_order",
                        name: "id_order",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false,
                        searchable: false,
                        printable: true
                    },
                    {
                        data: "sample.name",
                        name: "sample.name",
                    },
                    {
                        data: "sample.sample_rates",
                        name: "sample.sample_rates",
                        render: function(data, type, row, meta) {
                            if(data == null)
                                return 0;
                            else
                            return row.sample.sample_rates * data;
                        },
                    },
                    {
                        data: "labtest.selesai_qty",
                        name: "labtest.selesai_qty",
                        render: function(data, type, row, meta) {
                            if(data == null)
                                return 0;
                            else
                            return data;
                        },

                    },
                    {
                        data: "labtest.selesai_qty",
                        name: "labtest.selesai_qty",
                        render: function(data, type, row, meta) {
                            if(data == null)
                                return 0;
                            else
                            return row.labtest.selesai_qty / (row.sample.sample_rates * data) * 100;
                        },
                    }
                ]
            });
            $("#example4_wrapper").css("width", "100%");

            //Table 5
            $('#example5').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                searching: false,
                paging: false,
                info: false,
                ajax: {
                    url: "{{ route('project.ajax-detail-datatable') }}",
                    data: function(data) {
                        data.id = '{{ $id }}';
                        data.type = 'invoicing';
                    }
                },
                columns: [{
                        data: "id_order",
                        name: "id_order",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false,
                        searchable: false,
                        printable: true
                    },
                    {
                        data: "invoice",
                        name: "invoice",
                        render: function(data, type, row, meta) {
                            if (data != null || data != '') {
                                return `<a class="btn btn-outline-primary" href="{{ url('storage/order/invoice') }}/${data}" target="_blank">Lihat</a>`;
                            } else {
                                return 'Belum Upload';
                            }
                        },

                    },
                    {
                        data: "bukti_pembayaran",
                        name: "bukti_pembayaran",
                        render: function(data, type, row, meta) {
                            if (data != null || data != '') {
                                return `<a class="btn btn-outline-primary"  href="{{ url('storage/order/bukti') }}/${data}" target="_blank">Lihat</a>`;
                            } else {
                                return 'Belum Upload';
                            }
                        },
                    },
                    {
                        data: "status",
                        name: "status",
                    },
                    {
                        data: "updated_at",
                        name: "updated_at",
                        render: function(data, type, full) {
                            return convertIndonesianDate(data);
                        }
                    }
                ]
            });
            $("#example5_wrapper").css("width", "100%");

            //Table 6
            $('#example6').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                searching: false,
                paging: false,
                info: false,
                ajax: {
                    url: "{{ route('project.getAjaxHasilImage') }}",
                    data: function(data) {
                        data.id_project = '{{ $id }}';
                    }
                },
                columns: [{
                        data: "id_order",
                        name: "id_order",
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

                    },
                    {
                        data: "image",
                        name: "image",
                        render: function(data, type, row, meta) {
                            if (data != null || data != '') {
                                return `<a class="btn btn-outline-primary" href="{{ url('storage/order/document') }}/${data}" target="_blank">Lihat</a>`;
                            } else {
                                return 'Belum Upload';
                            }
                        },
                    }
                ]
            });
            $("#example6_wrapper").css("width", "100%");

            //Table 7
            $('#example7').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                searching: false,
                paging: false,
                lengthChange: false,
                info: false,
                ajax: {
                    url: "{{ route('survey.ajax-datatable') }}",
                    data: function(data) {
                        data.id_project = '{{ $id }}';
                    }
                },
                columns: [{
                        data: "name",
                        name: "name",
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

                    },
                    {
                        data: "value",
                        name: "value",

                    },
                ]
            });
            $("#example7_wrapper").css("width", "100%");
        }

        function editAction() {
            //Edit
            $("#example2").on("click", ".open-edit", function() {
                var id_project = $(this).data('id_project');
                var id_order = $(this).data('id_order');
                var id_sample = $(this).data('id_sample');
                var sample_name = $(this).data('sample_name');
                var quantity = $(this).data('quantity');
                var total = $(this).data('total');
                var price_rates = $(this).data('price_rates');
                $("#id_project2").val(id_project);
                $("#id_order").val(id_order);
                $("#id_sample").val(id_sample);
                $("#sample_name").val(sample_name);
                $("#quantity").val(quantity);
                $("#total").val(total);
                $("#price_rates").val(price_rates);
                $("#form-order").attr('action', '{{ route('order.edit') }}');
            });
            $("#id_sample").on("change", function() {
                var id_sample = $(this).val();
                $.ajax({
                    url: "{{ route('order.select') }}",
                    type: "POST",
                    data: {
                        id_sample: id_sample,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        var quantity = $("#quantity").val();
                        $("#price_rates").val(data.data.price_rates);
                        $("#total").val(quantity * data.data.price_rates);
                        $("#sample_name").val(data.data.name);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
            $("#quantity").on("change", function() {
                var quantity = $(this).val();
                var price_rates = $("#price_rates").val();
                $("#total").val(quantity * price_rates);
            });

            //Edit
            $("#example3").on("click", ".open-edit", function() {
                var url = "{{ url('') }}";
                var numbering = 0;
                var id_project = $(this).data('id_project');
                $("#notice-body").children().remove();
                $(".img-display").remove();
                var table_head =
                    '<tr class="bg-bluelight"><th>No</th><th>Sample Code</th><th>Depth</th><th>Length</th><th>Lithology</th><th>PP</th>' +
                    '<th>UCS</th><th>DS</th><th>UV</th><th>PLI</th><th>BZ</th><th>TX</th><th>Notice</th></tr>';
                $("#notice-body").append(table_head);

                //Get Table Data If Exist
                var form = new FormData();
                var req_url = '{{ route('project.getAjaxPreparasiSample') }}';
                form.append("id_project", id_project);
                form.append("_token", '{{ csrf_token() }}');
                $.ajax({
                    type: "POST",
                    url: req_url,
                    data: form,
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        if (result.data2 != null) {
                            $("#notes").val(result.data2.notes);
                        }
                        result.data3.forEach((item, index) => {
                            var imagecontent =
                                ' <span class="img-display"><img src="' + url +
                                '/storage/feedback/images/' + item.image +
                                '" alt="placeholder" width="150" class="img-thumbnail"></span>';
                            $("#image-modal").prepend(imagecontent);
                        })
                        result.data.forEach((item, index) => {
                            numbering++;
                            var rowcontent =
                                '<tr><td>' + numbering +
                                '</td><td><input type="text" class="form-control" name="sample_code[]" value="' +
                                item.sample_code + '" /></td>' +
                                '<td><input type="text" class="form-control" name="depth[]" value="' +
                                item.depth + '"/></td>' +
                                '<td><input type="text" class="form-control" name="length[]" value="' +
                                item.length + '"/></td>' +
                                '<td><input type="text" class="form-control" name="lithology[]" value="' +
                                item.lithology + '"/></td>' +
                                '<td><input type="number" class="form-control" name="pp[]" value="' +
                                item.pp + '"/></td>' +
                                '<td><input type="number" class="form-control" name="ucs[]" value="' +
                                item.ucs + '"/></td>' +
                                '<td><input type="number" class="form-control" name="ds[]" value="' +
                                item.ds + '"/></td>' +
                                '<td><input type="number" class="form-control" name="uv[]" value="' +
                                item.uv + '"/></td>' +
                                '<td><input type="number" class="form-control" name="pli[]" value="' +
                                item.pli + '"/></td>' +
                                '<td><input type="number" class="form-control" name="bz[]" value="' +
                                item.bz + '"/></td>' +
                                '<td><input type="number" class="form-control" name="tx[]" value="' +
                                item.tx + '"/></td>' +
                                '<td><input type="text" class="form-control" name="notice[]" value="' +
                                item.notice + '"/></td></tr>';
                            var totalcontent =
                                '<tr class="bg-bluelight total"><th colspan="5" class="text-center">Total tested</th><th>1</th><th>1</th><th>1</th><th>1</th><th>1</th><th>1</th><th>1</th><th></th></tr>';
                            $("#notice-body").append(rowcontent);
                        })
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            //Tambah
            $("#button_tambah").click(function() {
                $("#id_project").val('');
                $("#project_name").val('');
                $("#project_location").val('');
                $("#pic").val('');
                $("#company_name").val('');
                $("#company_address").val('');
                $("#file").val('');
                $("#email").val('');
                $("#phone").val('');
                $('#form').attr('action', '{{ route('project.addProject') }}');
            });
            //Edit
            $("#example1").on("click", ".open-edit", function() {
                var id_project = $(this).data('id_project');
                var no_order = $(this).data('no_order');
                var project_name = $(this).data('project_name');
                var project_location = $(this).data('project_location');
                var pic = $(this).data('pic');
                var company_name = $(this).data('company_name');
                var company_address = $(this).data('company_name');
                var email = $(this).data('email');
                var phone = $(this).data('phone');
                $("#id_project").val(id_project);
                $("#no_order").val(no_order);
                $("#project_name").val(project_name);
                $("#project_location").val(project_location);
                $("#pic").val(pic);
                $("#company_name").val(company_name);
                $("#company_address").val(company_address);
                $("#email").val(email);
                $("#phone").val(phone);
                $("#file").val('');
                $('#form').attr('action', '{{ route('project.editProject') }}');
            });
        }

        function addAction() {
            $("#button_add_quotation").click(function() {
                var id_project = $(this).data('id_project');
                $("#id_project2").val(id_project);
                $("#id_order").val('');
                $("#id_sample").val('');
                $("#sample_name").val('');
                $("#quantity").val('');
                $("#total").val('');
                $("#price_rates").val('');
                $("#form-order").attr('action', '{{ route('order.addData') }}');
            });
        }

        function archiveButton() {
            $("#button_archive").click(function() {
                var id_project = $(this).data('id_project');
                Swal.fire({
                    title: 'Information',
                    text: 'Are you sure want to archive this project?',
                    icon: 'info',
                    showCancelButton: true,
                    showConfirmButton: true,
                    showCloseButton: true,
                    confirmButtonText: 'Yes',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            async: false,
                            url: `{{ url('project/delete-response-json/${id_project}') }}`,
                            type: 'GET',
                            success: function(result) {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Data has been archived',
                                    icon: 'success',
                                    showConfirmButton: true,
                                    showCloseButton: true,
                                }).then((result) => {
                                    if (result.value) {
                                        $(location).attr('href', "{{ url('/admin/manage/project') }}");
                                    }
                                });
                            },
                            error: function(result) {
                                console.log(result);
                            }
                        });
                    }
                });
            });
        }
    </script>
@endsection
