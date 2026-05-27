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
        var url = "{{ url('') }}";
        var project_global = '';
        var i = 0;
        var table_all;
        var table_invoice;
        var table_completed;
        $(document).ready(function() {
            //Datatable
            allTable();
            statusTable();
            listener();

            $('a[data-toggle="pill"]').on('shown.bs.tab', function() {
                $.fn.dataTable
                    .tables({
                        visible: true,
                        api: true
                    })
                    .columns.adjust();
            });

            //Sample Modal
            $("#example1").on("click", ".status", function() {
                var id_project = $(this).data('id_project');
                var status = $(this).data('status');
                $("#id_project_status").val(id_project);
                $("#status_project").val(status);
                $("#exampleModalSample").modal("show");
                $('#form').attr('action', '{{ route('project.changeStatus') }}');
            });

            //Edit
            $("#example1").on("click", ".open-edit", function() {
                var id_project = $(this).data('id_project');
                var project_name = $(this).data('project_name');
                var project_location = $(this).data('project_location');
                var pic = $(this).data('pic');
                var company_name = $(this).data('company_name');
                var company_address = $(this).data('company_name');
                $("#id_project").val(id_project);
                $("#project_name").val(project_name);
                $("#project_location").val(project_location);
                $("#pic").val(pic);
                $("#company_name").val(company_name);
                $("#company_address").val(company_address);
                $("#file").val('');
                $('#form').attr('action', '{{ route('project.editProject') }}');
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
                $('#form').attr('action', '{{ route('project.addProject') }}');
            });
            /*end ready */

            //document
            tableDocumentListener("#example1");
            invoicingModalListener("#example1");
            documentListener();
            invoiceListener();
        });

        function convertIndonesianDate(date) {

            if (date == null || date == '') {
                return '-';
            } else {
                var date = new Date(date);
                var day = date.getDate();
                var bulan = date.getMonth() + 1;
                var year = date.getFullYear();
                switch (bulan) {
                    case 1:
                        bulan = "Januari";
                        break;
                    case 2:
                        bulan = "Februari";
                        break;
                    case 3:
                        bulan = "Maret";
                        break;
                    case 4:
                        bulan = "April";
                        break;
                    case 5:
                        bulan = "Mei";
                        break;
                    case 6:
                        bulan = "Juni";
                        break;
                    case 7:
                        bulan = "Juli";
                        break;
                    case 8:
                        bulan = "Agustus";
                        break;
                    case 9:
                        bulan = "September";
                        break;
                    case 10:
                        bulan = "Oktober";
                        break;
                    case 11:
                        bulan = "November";
                        break;
                    case 12:
                        bulan = "Desember";
                        break;
                }
                var time = day + " " + bulan + " " + year;
                return time;
            }
        }

        function getHasilImageData(id_project) {
            return $.ajax({
                async: false,
                url: `{{ url('project/detail/${id_project}') }}`,
                type: 'GET',
                success: function(result) {
                    return result.data;
                },
                error: function(result) {
                    console.log(result);
                }
            }).responseJSON.data;
        }

        function tableDocumentListener(tableid) {
            $(tableid).on("click", ".document", function() {
                var status = $(this).data('status');
                var id_project = $(this).data('id_project');
                project_global = id_project;

                if (status == "invoicing" || status == "completed") {
                    var sample = getHasilImageData(project_global);
                    $("#modalDocument").modal("show");
                    $("#form-document").children().remove();
                    sample.hasil_image.forEach((item, index) => {
                        var content = `
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a for="exampleFormControlInput1">Nama</a>
                                    <input type="hidden" class="form-control" id="id_hasil_image" name="id_hasil_image" value="${item.id_hasil_image}"/>
                                    <input type="text" class="form-control" id="name" name="name" value="${item.name}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mt-1">
                                    <a>File</a>
                                </div>
                                <div class="row mt-1">
                                    <a target="_blank" href="{{ url('storage/order/document/${item.image}') }}">${item.image}</a>
                                    <span class="ml-1 closed" id="${item.id_hasil_image}">&times;</span>
                                </div>
                            </div>
                        </div>`;
                        i++;
                        $("#form-document").append(content);
                        $(".closed").click(function() {
                            var id_hasil_image = $(this).attr('id');
                            Swal.fire({
                                title: 'Confirmation',
                                text: 'Delete this data ?',
                                icon: 'info',
                                showCancelButton: true,
                                showConfirmButton: true,
                                showCloseButton: true,
                                confirmButtonText: 'Yes',
                            }).then((result) => {
                                if (result.value) {
                                    $.ajax({
                                        url: `{{ url('project/delete-hasil-image/${id_hasil_image}') }}`,
                                        type: 'GET',
                                        success: function(result) {
                                            Swal.fire({
                                                title: 'Success',
                                                text: 'Data has been deleted',
                                                icon: 'success',
                                                showConfirmButton: true,
                                                showCloseButton: true,
                                            }).then((result) => {
                                                if (result.value) {
                                                    table_all.ajax
                                                        .reload();
                                                    documentListener();
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
                    })
                }
            });
        }

        //Cursor event on enter and leave closed button
        $('body').on({
            mouseenter: function() {
                $(this).css('cursor', 'pointer');
            },
            mouseleave: function() {
                $(this).css('cursor', 'auto');
            }
        }, '.closed');

        function getProjectById(id_project) {
            var form = new FormData();
            form.append("id_project", id_project);
            form.append("_token", '{{ csrf_token() }}');

            return $.ajax({
                type: "POST",
                async: false,
                url: "{{ route('project.getProjectById') }}",
                data: form,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    return result.data;
                },
                error: function(error) {
                    console.log(error);
                }
            }).responseJSON.data;
        }

        function invoicingModalListener(tableid) {
            $(tableid).on("click", ".invo", function() {
                var id_project = $(this).data('id_project');
                var status = $(this).data('status');
                var data = getProjectById(id_project);
                project_global = id_project;

                if (status == "invoicing" || status == "completed") {
                    $("#invoicingproofModal").modal("show");
                    $("#modal-invoice-body").children().remove();
                    if (data.invoice != null && data.invoice != '') {
                        var content = `<div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <a>Invoice</a>
                                    <span class="form-control" aria-hidden="true"><a target="_blank" href="{{ url('storage/order/invoice/${data.invoice}') }}">${data.invoice}</a>
                                    <span class="ml-3 closed" id="${data.id_project}">&times;</span></span>
                                </div>
                            </div>`;
                        $("#modal-invoice-body").append(content);
                    } else {
                        var content = `<div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <a>Invoice</a>
                                    <input type="file" class="form-control" id="file_invoice" name="file_invoice" />
                                </div>
                            </div>`;
                        $("#modal-invoice-body").append(content);
                    }
                    if (data.bukti_pembayaran != null && data.bukti_pembayaran != '') {
                        var content = `<div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <a>Proof Of Payment</a>
                                    <span class="form-control" aria-hidden="true"><a target="_blank" href="{{ url('storage/order/bukti/${data.bukti_pembayaran}') }}">${data.bukti_pembayaran}</a></span>
                                </div>
                            </div>`;
                        $("#modal-invoice-body").append(content);
                    } else {
                        var content = `<div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <a>Proof Of Payment</a>
                                    <input type="text" class="form-control" id="proof_payment" name="proof_payment" readonly/>
                                </div>
                            </div>`;
                        $("#modal-invoice-body").append(content);
                    }
                    $(".closed").click(function() {
                        var id_project = $(this).attr('id');
                        Swal.fire({
                            title: 'Confirmation',
                            text: 'Delete this data ?',
                            icon: 'info',
                            showCancelButton: true,
                            showConfirmButton: true,
                            showCloseButton: true,
                            confirmButtonText: 'Yes',
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    url: `{{ url('project/delete-invoice/${id_project}') }}`,
                                    type: 'GET',
                                    success: function(result) {
                                        Swal.fire({
                                            title: 'Success',
                                            text: 'Data has been deleted',
                                            icon: 'success',
                                            showConfirmButton: true,
                                            showCloseButton: true,
                                        }).then((result) => {
                                            if (result.value) {
                                                table_all.ajax.reload();
                                                table_invoice.ajax.reload();
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
            })
        }

        function documentListener() {
            $("#add-document").click(function() {
                var content = `<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Document A" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">File</label>
                                <input type="file" class="form-control" id="image_document-${i}" name="image_document-${i}"/>
                            </div>
                        </div>
                    </div>`;
                $("#form-document").append(content);
                i++;
            });
            $("#submit-document").click(function() {
                var form = new FormData();
                var url = '{{ route('project.addHasilImage') }}';
                var id_hasil_image = $("input[name='id_hasil_image']").map(function() {
                    return $(this).val();
                }).get();
                var name = $("input[name='name']").map(function() {
                    return $(this).val();
                }).get();

                name.forEach((item, index) => {
                    var file = $(`#image_document-${index}`).prop('files')[0];
                    form.append(`image-${index}`, file);
                });
                if (id_hasil_image.length > 0) {
                    form.append('id_hasil_image', JSON.stringify(id_hasil_image));
                }
                form.append("id_project", project_global);
                form.append("name", JSON.stringify(name));
                form.append("_token", '{{ csrf_token() }}');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form,
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Form has been stored',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function() {
                            swal.close();
                            table_all.ajax.reload();
                            table_invoice.ajax.reload();
                        }, 1500);
                    },
                    error: function(error) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Form has not been stored',
                            icon: 'error',
                            confirmButtonText: 'Got it'
                        })
                    }
                });
            });
        }

        function invoiceListener() {
            $("#submit-invoice").click(function() {
                var form = new FormData();
                var file = $("#file_invoice").prop('files')[0];

                form.append("id_project", project_global);
                form.append("file", file);
                form.append("_token", '{{ csrf_token() }}');

                $.ajax({
                    type: "POST",
                    url: "{{ route('project.uploadInvoice') }}",
                    data: form,
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Form has been stored',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function() {
                            swal.close();
                            table_all.ajax.reload();
                            table_invoice.ajax.reload();
                        }, 1500);
                    },
                    error: function(error) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Form has not been stored',
                            icon: 'error',
                            confirmButtonText: 'Got it'
                        })
                    }
                });
            });
        }

        function allTable() {
            table_all = $('#example1').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ route('project.ajax-datatable') }}",
                columns: [{
                        data: "id_project",
                        name: "id_project",
                        render: function(data, type, row, meta) {
                            return `MEKBAT-${row.no_order}`;
                        },
                        orderable: false,
                        searchable: false,
                        printable: true
                    },
                    {
                        data: "project_name",
                        name: "project_name"
                    },
                    {
                        data: "project_location",
                        name: "project_location"
                    },
                    {
                        data: "pic",
                        name: "pic"
                    },
                    {
                        data: "hasil_image",
                        name: "hasil_image",
                        render: function(data, type, row, meta) {
                            if (data.length <= 0 && row.status == "invoicing" || data.length <= 0 && row
                                .status == "completed") {
                                return `<button class="btn btn-outline-secondary document" data-status="${row.status}" data-id_project="${row.id_project}">Upload</button>`;
                            } else if (data.length <= 0 && row.status != "invoicing") {
                                return `<button class="btn btn-secondary document" data-status="${row.status}" data-id_project="${row.id_project}">Upload</button>`;
                            } else {
                                return `<button class="btn btn-outline-success document" data-status="${row.status}" data-id_project="${row.id_project}">Uploaded</button>`;
                            }
                        },
                    },
                    {
                        data: "invoice",
                        name: "invoice",
                        render: function(data, type, row, meta) {
                            if (data == null || data == '') {
                                return `<button class="btn btn-outline-info invo" data-status="${row.status}" data-id_project="${row.id_project}">Unpaid</button>`;
                            } else if (data != null && data != '' && row.bukti_pembayaran == null) {
                                return `<button class="btn btn-outline-primary invo" data-status="${row.status}" data-id_project="${row.id_project}">Invoicing</button>`;
                            } else {
                                return `<button class="btn btn-outline-success invo" data-status="${row.status}" data-id_project="${row.id_project}">Paid</button>`;
                            }
                        },
                    },
                    {
                        data: "status",
                        name: "status",
                        render: function(data, type, row, meta) {
                            if (data == 'result') {
                                return '<div class="badge badge-success" data-id_project="' +
                                    row.id_project + '" data-status="' + row.status + '">' +
                                    data + '</div>';
                            } else {
                                return '<div class="badge badge-info" data-id_project="' + row
                                    .id_project + '" data-status="' + row.status + '">' + data +
                                    '</div>';
                            }
                        }
                    },
                ]
            });
        }

        function statusTable() {
            //Waiting
            $("#waiting").click(function() {
                $("#custom-tabs-four-profile").children().remove();
                var content =
                    '<table id="example2" style="width: 100% !important;" class="table table-bordered table-striped"><thead><tr>' +
                    '<th>No.Order</th><th>Project Name</th><th>Company</th><th>PIC</th><th>Document</th><th>Payment</th>' +
                    '<th>Status</th><th>Action</th></tr></thead></table>';
                $("#custom-tabs-four-profile").append(content);

                $('#example2').DataTable({
                    scrollX: true,
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: {
                        url: "{{ route('project.ajax-bystatus') }}",
                        data(d) {
                            d.status = 'waiting';
                        }
                    },
                    columns: [{
                            data: "id_project",
                            name: "id_project",
                            render: function(data, type, row, meta) {
                                return `MEKBAT-${row.no_order}`;
                            },
                            orderable: false,
                            searchable: false,
                            printable: true
                        },
                        {
                            data: "project_name",
                            name: "project_name"
                        },
                        {
                            data: "project_location",
                            name: "project_location"
                        },
                        {
                            data: "pic",
                            name: "pic"
                        },
                        {
                            data: "hasil_image",
                            name: "hasil_image",
                            render: function(data, type, row, meta) {
                                if (data.length <= 0 && row.status == "invoicing") {
                                    return `<button class="btn btn-outline-secondary document" data-status="${row.status}">Upload</button>`;
                                } else if (data.length <= 0 && row.status != "invoicing") {
                                    return `<button class="btn btn-secondary document" data-status="${row.status}">Upload</button>`;
                                } else {
                                    return `<button class="btn btn-outline-secondary document" data-status="${row.status}">Uploaded</button>`;
                                }
                            },
                        },
                        {
                            data: "invoice",
                            name: "invoice",
                            render: function(data, type, row, meta) {
                                return `<button class="btn btn-outline-primary">Unpaid</button>`;
                            },
                        },
                        {
                            data: "status",
                            name: "status",
                            render: function(data, type, row, meta) {
                                if (data == 'result') {
                                    return '<div class="badge badge-success" data-id_project="' +
                                        row.id_project + '" data-status="' + row.status + '">' +
                                        data + '</div>';
                                } else {
                                    return '<div class="badge badge-info" data-id_project="' + row
                                        .id_project + '" data-status="' + row.status + '">' + data +
                                        '</div>';
                                }
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

                $("#example2").on("click", ".status", function() {
                    var id_project = $(this).data('id_project');
                    var status = $(this).data('status');
                    $("#id_project_status").val(id_project);
                    $("#status_project").val(status);
                    $("#exampleModalSample").modal("show");
                    $('#form').attr('action', '{{ route('project.changeStatus') }}');
                });
            });

            //Accepted
            $("#accepted").click(function() {
                $("#custom-tabs-four-messages").children().remove();
                var content =
                    '<table id="example3" style="width: 100% !important;" class="table table-bordered table-striped"><thead><tr>' +
                    '<th>No.Order</th><th>Project Name</th><th>Company</th><th>PIC</th><th>Document</th><th>Payment</th>' +
                    '<th>Status</th><th>Action</th></tr></thead></table>';
                $("#custom-tabs-four-messages").append(content);

                $('#example3').DataTable({
                    scrollX: true,
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: {
                        url: "{{ route('project.ajax-bystatus') }}",
                        data(d) {
                            d.status = 'accepted';
                        }
                    },
                    columns: [{
                            data: "id_project",
                            name: "id_project",
                            render: function(data, type, row, meta) {
                                return `MEKBAT-${row.no_order}`;
                            },
                            orderable: false,
                            searchable: false,
                            printable: true
                        },
                        {
                            data: "project_name",
                            name: "project_name"
                        },
                        {
                            data: "project_location",
                            name: "project_location"
                        },
                        {
                            data: "pic",
                            name: "pic"
                        },
                        {
                            data: "pic",
                            name: "pic",
                            render: function(data, type, row, meta) {
                                return `<button class="btn btn-outline-secondary">Uploaded</button>`;
                            },
                        },
                        {
                            data: "invoice",
                            name: "invoice",
                            render: function(data, type, row, meta) {
                                return `<button class="btn btn-outline-primary">Unpaid</button>`;
                            },
                        },
                        {
                            data: "status",
                            name: "status",
                            render: function(data, type, row, meta) {
                                if (data == 'result') {
                                    return '<div class="badge badge-success" data-id_project="' +
                                        row.id_project + '" data-status="' + row.status + '">' +
                                        data + '</div>';
                                } else {
                                    return '<div class="badge badge-info" data-id_project="' + row
                                        .id_project + '" data-status="' + row.status + '">' + data +
                                        '</div>';
                                }
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

                var numbering = 0;
                var project_id = 0;

                function addPreparasiRow(rowData = {}) {
                    function cellValue(field) {
                        return rowData[field] !== undefined && rowData[field] !== null ? rowData[field] : '';
                    }

                    numbering++;
                    $(".total").remove();
                    var rowcontent =
                        '<tr><td>' + numbering +
                        '</td><td><input type="text" class="form-control" name="sample_code[]" value="' + cellValue('sample_code') + '"/></td>' +
                        '<td><input type="text" class="form-control" name="depth[]" value="' + cellValue('depth') + '"/></td>' +
                        '<td><input type="text" class="form-control" name="length[]" value="' + cellValue('length') + '"/></td>' +
                        '<td><input type="text" class="form-control" name="lithology[]" value="' + cellValue('lithology') + '"/></td>' +
                        '<td><input type="number" class="form-control" name="pp[]" value="' + cellValue('pp') + '"/></td>' +
                        '<td><input type="number" class="form-control" name="ucs[]" value="' + cellValue('ucs') + '"/></td>' +
                        '<td><input type="number" class="form-control" name="ds[]" value="' + cellValue('ds') + '"/></td>' +
                        '<td><input type="number" class="form-control" name="uv[]" value="' + cellValue('uv') + '"/></td>' +
                        '<td><input type="number" class="form-control" name="pli[]" value="' + cellValue('pli') + '"/></td>' +
                        '<td><input type="number" class="form-control" name="bz[]" value="' + cellValue('bz') + '"/></td>' +
                        '<td><input type="number" class="form-control" name="tx[]" value="' + cellValue('tx') + '"/></td>' +
                        '<td><input type="text" class="form-control" name="notice[]" value="' + cellValue('notice') + '"/></td></tr>';
                    $("#notice-body").append(rowcontent);
                }

                $("#example3").on("click", ".status", function() {
                    numbering = 0;
                    var id_project = $(this).data('id_project');
                    project_global = id_project;
                    project_id = id_project;
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
                                addPreparasiRow(item);
                            })
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                    //End Get Table Data If Exist
                    $("#exampleModal").modal("show");
                });

                $("#notice-table").dblclick(function() {
                    addPreparasiRow();
                });

                $("#add-sample-code").click(function() {
                    addPreparasiRow();
                });

                $("#clear-delete").click(function() {
                    var form = new FormData();
                    var route = '{{ route('project.ajaxDeletePreparasiSample') }}';
                    form.append("id_project", project_global);
                    form.append("_token", '{{ csrf_token() }}');
                    $.ajax({
                        type: "POST",
                        url: route,
                        data: form,
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(result) {
                            Swal.fire({
                                title: 'Deleted !',
                                text: 'Table has been cleared',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                        },
                        error: function(error) {
                            Swal.fire({
                                title: 'Error',
                                text: 'Form has not been stored',
                                icon: 'error',
                                confirmButtonText: 'Got it'
                            })
                        }
                    });
                });

                $("#button-simpan").click(function() {
                    var sample_code = $("input[name='sample_code[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var depth = $("input[name='depth[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var length = $("input[name='length[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var lithology = $("input[name='lithology[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var pp = $("input[name='pp[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var ucs = $("input[name='ucs[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var ds = $("input[name='ds[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var uv = $("input[name='uv[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var pli = $("input[name='pli[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var bz = $("input[name='bz[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var tx = $("input[name='tx[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var notice = $("input[name='notice[]']").map(function() {
                        return $(this).val();
                    }).get();

                    var form = new FormData();
                    var url = '{{ route('project.ajaxAddPreparasiSample') }}';
                    var notes = $("#notes").val();
                    form.append("id_project", project_id);
                    form.append("notes", notes);
                    form.append("sample_code", JSON.stringify(sample_code));
                    form.append("depth", JSON.stringify(depth));
                    form.append("length", JSON.stringify(length));
                    form.append("lithology", JSON.stringify(lithology));
                    form.append("pp", JSON.stringify(pp));
                    form.append("ucs", JSON.stringify(ucs));
                    form.append("ds", JSON.stringify(ds));
                    form.append("uv", JSON.stringify(uv));
                    form.append("pli", JSON.stringify(pli));
                    form.append("bz", JSON.stringify(bz));
                    form.append("tx", JSON.stringify(tx));
                    form.append("notice", JSON.stringify(notice));
                    form.append("_token", '{{ csrf_token() }}');

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: form,
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(result) {
                            Swal.fire({
                                title: 'Success',
                                text: 'Form has been stored',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            setTimeout(function() {
                                swal.close();
                            }, 1500);
                        },
                        error: function(error) {
                            Swal.fire({
                                title: 'Error',
                                text: 'Form has not been stored',
                                icon: 'error',
                                confirmButtonText: 'Got it'
                            })
                        }
                    });
                })

                $("#image").change(function() {
                    var image = $(this)[0].files[0];
                    var form = new FormData();
                    var url = '{{ route('project.ajaxAddPreparasiImage') }}';
                    form.append("id_project", project_global);
                    form.append("image", image);
                    form.append("_token", '{{ csrf_token() }}');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: form,
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(result) {
                            $("#image").val(null);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });

                $("#button-proceed").click(function() {
                    var form = new FormData();
                    var route = '{{ route('project.changeStatusAjax') }}';
                    form.append("id_project", project_global);
                    form.append("_token", '{{ csrf_token() }}');
                    $.ajax({
                        type: "POST",
                        url: route,
                        data: form,
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(result) {
                            Swal.fire({
                                title: 'Success',
                                text: 'Form has been stored',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            setTimeout(function() {
                                swal.close();
                                location.reload();
                            }, 1500);
                        },
                        error: function(error) {
                            Swal.fire({
                                title: 'Error',
                                text: 'Form has not been stored',
                                icon: 'error',
                                confirmButtonText: 'Got it'
                            })
                        }
                    });
                })
            });

            //Preparing
            $("#preparing").click(function() {
                $("#custom-tabs-four-settings").children().remove();
                var content =
                    '<table id="example4" style="width: 100% !important;" class="table table-bordered table-striped"><thead><tr>' +
                    '<th>No.Order</th><th>Project Name</th><th>Company</th><th>PIC</th><th>Document</th><th>Payment</th>' +
                    '<th>Status</th><th>Action</th></tr></thead></table>';
                $("#custom-tabs-four-settings").append(content);

                $('#example4').DataTable({
                    scrollX: true,
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: {
                        url: "{{ route('project.ajax-bystatus') }}",
                        data(d) {
                            d.status = 'preparing';
                        }
                    },
                    columns: [{
                            data: "id_project",
                            name: "id_project",
                            render: function(data, type, row, meta) {
                                return `MEKBAT-${row.no_order}`;
                            },
                            orderable: false,
                            searchable: false,
                            printable: true
                        },
                        {
                            data: "project_name",
                            name: "project_name"
                        },
                        {
                            data: "project_location",
                            name: "project_location"
                        },
                        {
                            data: "pic",
                            name: "pic"
                        },
                        {
                            data: "pic",
                            name: "pic",
                            render: function(data, type, row, meta) {
                                return `<button class="btn btn-outline-secondary">Uploaded</button>`;
                            },
                        },
                        {
                            data: "invoice",
                            name: "invoice",
                            render: function(data, type, row, meta) {
                                return `<button class="btn btn-outline-primary">Unpaid</button>`;
                            },
                        },
                        {
                            data: "status",
                            name: "status",
                            render: function(data, type, row, meta) {
                                if (data == 'result') {
                                    return '<div class="badge badge-success" data-id_project="' +
                                        row.id_project + '" data-status="' + row.status + '">' +
                                        data + '</div>';
                                } else {
                                    return '<div class="badge badge-info" data-id_project="' + row
                                        .id_project + '" data-status="' + row.status + '">' + data +
                                        '</div>';
                                }
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

                $("#example4").on("click", ".status", function() {
                    var id_project = $(this).data('id_project');
                    var status = $(this).data('status');
                    $("#startTestModal").modal("show");
                    $("#start-test").click(function() {
                        var form = new FormData();
                        var route = '{{ route('project.changeStatusAjax') }}';
                        form.append("id_project", id_project);
                        form.append("_token", '{{ csrf_token() }}');
                        $.ajax({
                            type: "POST",
                            url: route,
                            data: form,
                            dataType: "json",
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(result) {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Form has been stored',
                                    icon: 'success',
                                    showConfirmButton: false,
                                })
                                setTimeout(function() {
                                    swal.close();
                                    location.reload();
                                }, 1500);
                            },
                            error: function(error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Form has not been stored',
                                    icon: 'error',
                                    confirmButtonText: 'Got it'
                                })
                            }
                        });
                    });
                });
            });

            //testing
            $("#testing").click(function() {
                $("#custom-tabs-four-testing").children().remove();
                var content =
                    '<table id="example5" style="width: 100% !important;" class="table table-bordered table-striped"><thead><tr>' +
                    '<th>No.Order</th><th>Project Name</th><th>Company</th><th>PIC</th><th>Document</th><th>Payment</th>' +
                    '<th>Status</th><th>Action</th></tr></thead></table>';
                $("#custom-tabs-four-testing").append(content);

                $('#example5').DataTable({
                    scrollX: true,
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: {
                        url: "{{ route('project.ajax-bystatus') }}",
                        data(d) {
                            d.status = 'testing';
                        }
                    },
                    columns: [{
                            data: "id_project",
                            name: "id_project",
                            render: function(data, type, row, meta) {
                                return `MEKBAT-${row.no_order}`;
                            },
                            orderable: false,
                            searchable: false,
                            printable: true
                        },
                        {
                            data: "project_name",
                            name: "project_name"
                        },
                        {
                            data: "project_location",
                            name: "project_location"
                        },
                        {
                            data: "pic",
                            name: "pic"
                        },
                        {
                            data: "pic",
                            name: "pic",
                            render: function(data, type, row, meta) {
                                return `<button class="btn btn-outline-secondary">Uploaded</button>`;
                            },
                        },
                        {
                            data: "invoice",
                            name: "invoice",
                            render: function(data, type, row, meta) {
                                return `<button class="btn btn-outline-primary">Unpaid</button>`;
                            },
                        },
                        {
                            data: "status",
                            name: "status",
                            render: function(data, type, row, meta) {
                                if (data == 'result') {
                                    return '<div class="badge badge-success" data-id_project="' +
                                        row.id_project + '" data-status="' + row.status + '">' +
                                        data + '</div>';
                                } else {
                                    return '<div class="badge badge-info" data-id_project="' + row
                                        .id_project + '" data-status="' + row.status + '">' + data +
                                        '</div>';
                                }
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

                var project_id = 0;
                $("#example5").on("click", ".status", function() {
                    var numbering2 = 0;
                    var id_project = $(this).data('id_project');
                    project_id = id_project;
                    $("#testingModal").modal("show");
                    $("#notice-body2").children().remove();
                    var table_head =
                        '<tr class="bg-bluelight"><th>No</th><th>Test Categories</th><th>Jumlah Sample</th><th>Selesai Test</th><th>%</th><th>Notes</th></tr>';
                    $("#notice-body2").append(table_head);

                    //Get Table Data If Exist
                    var form = new FormData();
                    var req_url = '{{ route('project.getAjaxTestSample') }}';
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
                            var selesai_qty;
                            var notes;
                            var total_sample = 0;
                            var total_selesai_test = 0;
                            function percentageDone(done, total) {
                                if (total == 0) {
                                    return 0;
                                }

                                return Math.round((done / total) * 100);
                            }

                            result.data.forEach((item, index) => {
                                var sample_total = item.quantity * item.sample.sample_rates;
                                if (item.labtest == null) {
                                    selesai_qty = 0;
                                    notes = '-';
                                } else {
                                    selesai_qty = item.labtest.selesai_qty;
                                    notes = item.labtest.catatan;
                                }
                                numbering2++;
                                var rowcontent =
                                    '<tr><td>' + numbering2 + '</td>' +
                                    '<td>' + item.sample.name + '</td>' +
                                    '<td>' + sample_total + '</td>' +
                                    '<td><input type="text" class="form-control" name="selesai_qty[]" value="' +
                                    selesai_qty +
                                    '" /> <input type="hidden" class="form-control" name="id_order[]" value="' +
                                    item.id_order + '" /></td>' +
                                    '<td>' + percentageDone(selesai_qty, sample_total) + '</td>' +
                                    '<td><input type="text" class="form-control" name="catatan[]" value="' +
                                    notes + '" /></td></tr>';
                                $("#notice-body2").append(rowcontent);
                                total_sample += sample_total;
                                total_selesai_test += selesai_qty;
                            })
                            var totalcontent =
                                '<tr class="bg-bluelight total"><th colspan="2" class="text-center">Total tested</th><th>' +
                                total_sample + '</th><th>' + total_selesai_test +
                                '</th><th colspan="2" id="grand-total">' + percentageDone(total_selesai_test, total_sample) + '</th></tr>';
                            $("#notice-body2").append(totalcontent);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });

                    $("#simpan-testing").click(function() {
                        var id_order = $("input[name='id_order[]']").map(function() {
                            return $(this).val();
                        }).get();
                        var selesai_qty = $("input[name='selesai_qty[]']").map(function() {
                            return $(this).val();
                        }).get();
                        var catatan = $("input[name='catatan[]']").map(function() {
                            return $(this).val();
                        }).get();

                        var form = new FormData();
                        var url = '{{ route('project.ajaxAddLabtest') }}';
                        var notes = $("#notes").val();
                        form.append("id_order", JSON.stringify(id_order));
                        form.append("catatan", JSON.stringify(catatan));
                        form.append("selesai_qty", JSON.stringify(selesai_qty));
                        form.append("_token", '{{ csrf_token() }}');

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: form,
                            dataType: "json",
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(result) {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Form has been stored',
                                    icon: 'success',
                                    showConfirmButton: false,
                                })
                                setTimeout(function() {
                                    swal.close();
                                }, 1500);
                            },
                            error: function(error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Form has not been stored',
                                    icon: 'error',
                                    confirmButtonText: 'Got it'
                                })
                            }
                        });
                    })
                });

                $("#button-proceed2").click(function() {
                    Swal.fire({
                        title: 'Testing Sample',
                        text: 'Apakah yakin bahwa test telah selesai ?',
                        icon: 'info',
                        showConfirmButton: true,
                        confirmButtonText: 'Sudah Selesai',
                        showCancelButton: true,
                        cancelButtonText: 'Belum Selesai',
                        showCloseButton: true,
                    }).then((result) => {
                        if (result.value) {
                            var form = new FormData();
                            var route = '{{ route('project.changeStatusAjax') }}';
                            form.append("id_project", project_id);
                            form.append("_token", '{{ csrf_token() }}');
                            $.ajax({
                                type: "POST",
                                url: route,
                                data: form,
                                dataType: "json",
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(result) {
                                    Swal.fire({
                                        title: 'Success',
                                        text: 'Form has been stored',
                                        icon: 'success',
                                        showConfirmButton: false,
                                    })
                                    setTimeout(function() {
                                        swal.close();
                                        location.reload();
                                    }, 1500);
                                },
                                error: function(error) {
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Form has not been stored',
                                        icon: 'error',
                                        confirmButtonText: 'Got it'
                                    })
                                }
                            });
                            swal.close();
                        }
                    })
                })
            });

            //invoicing
            $("#invoicing").click(function() {
                $("#custom-tabs-four-invoicing").children().remove();
                var content =
                    '<table id="example6" style="width: 100% !important;" class="table table-bordered table-striped"><thead><tr>' +
                    '<th>No.Order</th><th>Project Name</th><th>Company</th><th>PIC</th><th>Document</th><th>Payment</th>' +
                    '<th>Status</th><th>Action</th></tr></thead></table>';
                $("#custom-tabs-four-invoicing").append(content);

                table_invoice = $('#example6').DataTable({
                    scrollX: true,
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: {
                        url: "{{ route('project.ajax-bystatus') }}",
                        data(d) {
                            d.status = 'invoicing';
                        }
                    },
                    columns: [{
                            data: "id_project",
                            name: "id_project",
                            render: function(data, type, row, meta) {
                                return `MEKBAT-${row.no_order}`;
                            },
                            orderable: false,
                            searchable: false,
                            printable: true
                        },
                        {
                            data: "project_name",
                            name: "project_name"
                        },
                        {
                            data: "project_location",
                            name: "project_location"
                        },
                        {
                            data: "pic",
                            name: "pic"
                        },
                        {
                            data: "hasil_image",
                            name: "hasil_image",
                            render: function(data, type, row, meta) {
                                if (data.length <= 0 && row.status == "invoicing" || data.length <=
                                    0 && row
                                    .status == "completed") {
                                    return `<button class="btn btn-outline-secondary document" data-status="${row.status}" data-id_project="${row.id_project}">Upload</button>`;
                                } else if (data.length <= 0 && row.status != "invoicing") {
                                    return `<button class="btn btn-secondary document" data-status="${row.status}" data-id_project="${row.id_project}">Upload</button>`;
                                } else {
                                    return `<button class="btn btn-outline-success document" data-status="${row.status}" data-id_project="${row.id_project}">Uploaded</button>`;
                                }
                            },
                        },
                        {
                            data: "invoice",
                            name: "invoice",
                            render: function(data, type, row, meta) {
                                if (data == null || data == '') {
                                    return `<button class="btn btn-outline-info invo" data-status="${row.status}" data-id_project="${row.id_project}">Unpaid</button>`;
                                } else if (data != null && data != '' && row.bukti_pembayaran ==
                                    null) {
                                    return `<button class="btn btn-outline-primary invo" data-status="${row.status}" data-id_project="${row.id_project}">Invoicing</button>`;
                                } else {
                                    return `<button class="btn btn-outline-success invo" data-status="${row.status}" data-id_project="${row.id_project}">Paid</button>`;
                                }
                            },
                        },
                        {
                            data: "status",
                            name: "status",
                            render: function(data, type, row, meta) {
                                if (data == 'result') {
                                    return '<div class="badge badge-success" data-id_project="' +
                                        row.id_project + '" data-status="' + row.status + '">' +
                                        data + '</div>';
                                } else {
                                    return '<div class="badge badge-info" data-id_project="' + row
                                        .id_project + '" data-status="' + row.status + '">' + data +
                                        '</div>';
                                }
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

                $("#example6").on("click", ".status", function() {
                    Swal.fire({
                        title: 'Confirmation',
                        text: 'Apakah user telah melakukan pembayaran ?',
                        icon: 'info',
                        showCancelButton: true,
                        showConfirmButton: true,
                        showCloseButton: true,
                        confirmButtonText: 'Yes',
                    }).then((result) => {
                        if (result.value) {
                            var form = new FormData();
                            var route = '{{ route('project.changeStatusAjax') }}';
                            form.append("id_project", project_global);
                            form.append("_token", '{{ csrf_token() }}');
                            $.ajax({
                                type: "POST",
                                url: route,
                                data: form,
                                dataType: "json",
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(result) {
                                    Swal.fire({
                                        title: 'Success',
                                        text: 'Form has been stored',
                                        icon: 'success',
                                        showConfirmButton: false,
                                    })
                                    setTimeout(function() {
                                        swal.close();
                                        location.reload();
                                    }, 1500);
                                },
                                error: function(error) {
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Form has not been stored',
                                        icon: 'error',
                                        confirmButtonText: 'Got it'
                                    })
                                }
                            });
                        }
                    });
                });

                i = 0;
                tableDocumentListener("#example6");
                invoicingModalListener("#example6");

            });

            //completed
            $("#completed").click(function() {
                $("#custom-tabs-four-completed").children().remove();
                var content =
                    '<table id="example7" style="width: 100% !important;" class="table table-bordered table-striped"><thead><tr>' +
                    '<th>No.Order</th><th>Project Name</th><th>Company</th><th>PIC</th><th>Document</th><th>Payment</th>' +
                    '<th>Status</th><th>Action</th></tr></thead></table>';
                $("#custom-tabs-four-completed").append(content);

                $('#example7').DataTable({
                    scrollX: true,
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: {
                        url: "{{ route('project.ajax-bystatus') }}",
                        data(d) {
                            d.status = 'completed';
                        }
                    },
                    columns: [{
                            data: "id_project",
                            name: "id_project",
                            render: function(data, type, row, meta) {
                                return `MEKBAT-${row.no_order}`;
                            },
                            orderable: false,
                            searchable: false,
                            printable: true
                        },
                        {
                            data: "project_name",
                            name: "project_name"
                        },
                        {
                            data: "project_location",
                            name: "project_location"
                        },
                        {
                            data: "pic",
                            name: "pic"
                        },
                        {
                            data: "hasil_image",
                            name: "hasil_image",
                            render: function(data, type, row, meta) {
                                if (data.length <= 0 && row.status == "invoicing" || data.length <=
                                    0 && row
                                    .status == "completed") {
                                    return `<button class="btn btn-outline-secondary document" data-status="${row.status}" data-id_project="${row.id_project}">Upload</button>`;
                                } else if (data.length <= 0 && row.status != "invoicing") {
                                    return `<button class="btn btn-secondary document" data-status="${row.status}" data-id_project="${row.id_project}">Upload</button>`;
                                } else {
                                    return `<button class="btn btn-outline-success document" data-status="${row.status}" data-id_project="${row.id_project}">Uploaded</button>`;
                                }
                            },
                        },
                        {
                            data: "invoice",
                            name: "invoice",
                            render: function(data, type, row, meta) {
                                if (data == null || data == '') {
                                    return `<button class="btn btn-outline-info invo" data-status="${row.status}" data-id_project="${row.id_project}">Unpaid</button>`;
                                } else if (data != null && data != '' && row.bukti_pembayaran ==
                                    null) {
                                    return `<button class="btn btn-outline-primary invo" data-status="${row.status}" data-id_project="${row.id_project}">Invoicing</button>`;
                                } else {
                                    return `<button class="btn btn-outline-success invo" data-status="${row.status}" data-id_project="${row.id_project}">Paid</button>`;
                                }
                            },
                        },
                        {
                            data: "status",
                            name: "status",
                            render: function(data, type, row, meta) {
                                if (data == 'result') {
                                    return '<div class="badge badge-success" data-id_project="' +
                                        row.id_project + '" data-status="' + row.status + '">' +
                                        data + '</div>';
                                } else {
                                    return '<div class="badge badge-info" data-id_project="' + row
                                        .id_project + '" data-status="' + row.status + '">' + data +
                                        '</div>';
                                }
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

                i = 0;
                tableDocumentListener("#example7");
                invoicingModalListener("#example7");
            });

            //archived
            $("#archived").click(function() {
                $("#custom-tabs-four-archived").children().remove();
                var content =
                    '<table id="example8" style="width: 100% !important;" class="table table-bordered table-striped"><thead><tr>' +
                    '<th>No.Order</th><th>Project Name</th><th>Company</th><th>PIC</th><th>Document</th><th>Payment</th>' +
                    '<th>Status</th><th>Action</th></tr></thead></table>';
                $("#custom-tabs-four-archived").append(content);

                $('#example8').DataTable({
                    scrollX: true,
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: {
                        url: "{{ route('project.ajaxArchived') }}",
                    },
                    columns: [{
                            data: "id_project",
                            name: "id_project",
                            render: function(data, type, row, meta) {
                                return `MEKBAT-${row.no_order}`;
                            },
                            orderable: false,
                            searchable: false,
                            printable: true
                        },
                        {
                            data: "project_name",
                            name: "project_name"
                        },
                        {
                            data: "project_location",
                            name: "project_location"
                        },
                        {
                            data: "pic",
                            name: "pic"
                        },
                        {
                            data: "pic",
                            name: "pic",
                            render: function(data, type, row, meta) {
                                return `<button class="btn btn-outline-secondary">Uploaded</button>`;
                            },
                        },
                        {
                            data: "invoice",
                            name: "invoice",
                            render: function(data, type, row, meta) {
                                return `<button class="btn btn-outline-primary">Unpaid</button>`;
                            },
                        },
                        {
                            data: "status",
                            name: "status",
                            render: function(data, type, row, meta) {
                                if (data == 'result') {
                                    return '<div class="badge badge-success" data-id_project="' +
                                        row.id_project + '" data-status="' + row.status + '">' +
                                        data + '</div>';
                                } else {
                                    return '<div class="badge badge-info" data-id_project="' + row
                                        .id_project + '" data-status="' + row.status + '">' + data +
                                        '</div>';
                                }
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
            });
        }

        function listener() {
            $("#all").click(function() {
                $("#custom-tabs-four-profile").empty();
                $("#custom-tabs-four-messages").empty();
                $("#custom-tabs-four-settings").empty();
                $("#custom-tabs-four-testing").empty();
                $("#custom-tabs-four-invoicing").empty();
                $("#custom-tabs-four-completed").empty();
                $("#custom-tabs-four-archived").empty();
                $("#example1").show();
            });
            $("#accepted").click(function() {
                $("#custom-tabs-four-profile").empty();
                $("#custom-tabs-four-settings").empty();
                $("#custom-tabs-four-testing").empty();
                $("#custom-tabs-four-invoicing").empty();
                $("#custom-tabs-four-completed").empty();
                $("#custom-tabs-four-archived").empty();
                $("#example1").hide();
            });
            $("#waiting").click(function() {
                $("#custom-tabs-four-messages").empty();
                $("#custom-tabs-four-settings").empty();
                $("#custom-tabs-four-testing").empty();
                $("#custom-tabs-four-invoicing").empty();
                $("#custom-tabs-four-completed").empty();
                $("#custom-tabs-four-archived").empty();
                $("#example1").hide();
            });
            $("#preparing").click(function() {
                $("#custom-tabs-four-profile").empty();
                $("#custom-tabs-four-messages").empty();
                $("#custom-tabs-four-testing").empty();
                $("#custom-tabs-four-invoicing").empty();
                $("#custom-tabs-four-completed").empty();
                $("#custom-tabs-four-archived").empty();
                $("#example1").hide();
            });
            $("#testing").click(function() {
                $("#custom-tabs-four-profile").empty();
                $("#custom-tabs-four-messages").empty();
                $("#custom-tabs-four-settings").empty();
                $("#custom-tabs-four-invoicing").empty();
                $("#custom-tabs-four-completed").empty();
                $("#custom-tabs-four-archived").empty();
                $("#example1").hide();
            });
            $("#invoicing").click(function() {
                $("#custom-tabs-four-profile").empty();
                $("#custom-tabs-four-messages").empty();
                $("#custom-tabs-four-settings").empty();
                $("#custom-tabs-four-testing").empty();
                $("#custom-tabs-four-completed").empty();
                $("#custom-tabs-four-archived").empty();
                $("#example1").hide();
            });
            $("#completed").click(function() {
                $("#custom-tabs-four-profile").empty();
                $("#custom-tabs-four-messages").empty();
                $("#custom-tabs-four-settings").empty();
                $("#custom-tabs-four-testing").empty();
                $("#custom-tabs-four-invoicing").empty();
                $("#custom-tabs-four-archived").empty();
                $("#example1").hide();
            });
            $("#archived").click(function() {
                $("#custom-tabs-four-profile").empty();
                $("#custom-tabs-four-messages").empty();
                $("#custom-tabs-four-settings").empty();
                $("#custom-tabs-four-testing").empty();
                $("#custom-tabs-four-invoicing").empty();
                $("#custom-tabs-four-completed").empty();
                $("#example1").hide();
            });
        }
    </script>
@endsection
