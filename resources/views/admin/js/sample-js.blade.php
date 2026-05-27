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
        var images = [];
        var isEdit = false;
        var table;

        function readURL(input) {
            images.push(input.files[0]);

            let i = 0;
            images.forEach(function(item) {
                let component = '<img src="" class="img-thumbnail" id="preview-box' + i + '" alt="riki' + i + '">'
                $("#preview-box" + i + "").remove();
                $("#row-preview").append(component);
                reader(item, i);
                i++;
            });
        }

        function reader(item, id) {
            var reader = new FileReader();
            reader.readAsDataURL(item);
            reader.onload = function(e) {
                $('#preview-box' + id + '').attr('src', e.target.result);
            }
        }

        $(document).ready(function() {

            //Preview Image
            $("#preview").hide();
            $("#file1").change(function() {
                readURL(this);
                $("#preview").show();
            });

            //Datatable
            table = $('#example1').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ route('sample.ajax-datatable') }}",
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
                            return formatRupiah(row.price_rates, 0) + ' / ' + row.sample_rates +
                                ' Sample';
                        },
                    },
                    {
                        data: "method",
                        name: "method",
                    },
                    {
                        data: "output",
                        name: "output",
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
                                output += '<img src="{{ url('storage/testinfo') }}/' + item
                                    .image + '" class="img-thumbnail" width="200px">';
                            });
                            return output;
                        }
                    },
                    {
                        data: "display",
                        name: "display",
                        render: function(data, type, row, meta) {
                            if (data == 'Show') {
                                return '<i class="fa fa-check"></i>';
                            } else {
                                return '<i class="fa fa-times"></i>';
                            }
                        },
                        orderable: false,
                        searchable: false,
                        printable: true
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
                var type = $(this).data('type');
                var output = $(this).data('output');
                var method = $(this).data('method');
                var standard_method_description = $(this).data('standard_method_description');
                var output_description = $(this).data('output_description');
                var display = $(this).data('display');
                $("#id_sample").val(id_sample);
                $("#name").val(name);
                $("#sample_rates").val(sample_rates);
                $("#price_rates").val(price_rates);
                $("#type").val(type);
                $("#output").val(output);
                $("#method").val(method);
                $("#standard_method_description").val(standard_method_description);
                $("#output_description").val(output_description);
                $("#display").val(display);
                $("#modal-edit").modal('show');
                $('#form').attr('action', '{{ route('sample.editSample') }}');
                isEdit = true;
            });

            //Edit Image
            $("#example1").on("click", ".open-image", function() {
                $("#image-body").children().remove();
                var id_sample = $(this).data('id_sample');
                var sample = getAllImage(id_sample);
                sample.images.forEach(function(item, index) {
                    let component = `<div class="form-group">
                    <span class="form-control" aria-hidden="true"><a target="_blank" href="{{ url('storage/testinfo/${item.image}') }}">Image - ${index+1}</a>
                    <span class="ml-3 closedr" id="${item.id_sample_image}">×</span></span>
                    </div>`;
                    $("#image-body").append(component);
                });

                //Delete Image Event Triggered
                $(".closedr").click(function() {
                    var id_sample_image = $(this).attr('id');
                    var result = deleteImageFromSample(id_sample_image);
                    $(this).parent().remove();
                    table.ajax.reload();
                    Swal.fire({
                        title: 'Success',
                        text: 'Image Deleted',
                        icon: 'success',
                        showConfirmButton: false,
                    });
                });
            });

            //Tambah
            $("#button_tambah").click(function() {
                $("#id_sample").val('');
                $("#name").val('');
                $("#sample_rates").val('');
                $("#price_rates").val('');
                $("#type").val('Sample');
                $("#output").val('');
                $("#method").val('');
                $("#standard_method_description").val('');
                $("#output_description").val('');
                $("#display").val('Show');
                $('#form').attr('action', '{{ route('sample.addSample') }}');
                isEdit = false;
            });

            buttonSubmit();
            $(".display").hide();
        });

        function getAllImage(id_sample) {
            var form = new FormData();
            form.append('id_sample', id_sample);
            form.append("_token", '{{ csrf_token() }}');

            return $.ajax({
                type: "POST",
                url: "{{ route('sample.ajax-selectone') }}",
                data: form,
                dataType: "json",
                async: false,
                contentType: false,
                cache: false,
                processData: false,
            }).responseJSON;
        }

        function deleteImageFromSample(id_sample_image){
            var form = new FormData();
            form.append('id_sample_image', id_sample_image);
            form.append("_token", '{{ csrf_token() }}');

            return $.ajax({
                type: "POST",
                url: "{{ route('sample.deleteImageFromSample') }}",
                data: form,
                dataType: "json",
                async: false,
                contentType: false,
                cache: false,
                processData: false,
            }).responseJSON;
        }


        function buttonSubmit() {
            $("#submit").click(function(e) {
                e.preventDefault();
                var url;
                if (isEdit == false) {
                    url = '{{ route('sample.addSample') }}';
                } else {
                    url = '{{ route('sample.editSample') }}';
                }
                var form = new FormData();
                var id_sample = $("#id_sample").val();
                var name = $("#name").val();
                var sample_rates = $("#sample_rates").val();
                var price_rates = $("#price_rates").val();
                var type = $("#type").val();
                var output = $('#output').val();
                var method = $('#method').val();
                var standard_method_description = $('#standard_method_description').val();
                var output_description = $('#output_description').val();
                var display = $('#display').val();

                form.append('id_sample', id_sample);
                form.append('name', name);
                form.append('sample_rates', sample_rates);
                form.append('price_rates', price_rates);
                form.append("type", type);
                form.append("output", output);
                form.append("method", method);
                form.append("standard_method_description", standard_method_description);
                form.append("output_description", output_description);
                form.append("display", display);
                form.append("_token", '{{ csrf_token() }}');

                images.forEach(function(image, i) {
                    form.append('images' + i, image);
                });

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
                        table.ajax.reload();
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
    </script>
@endsection
