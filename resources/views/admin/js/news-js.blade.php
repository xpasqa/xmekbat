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
    @if (session('error'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Opps !',
                    icon: "Image must below 4Mb",
                    showConfirmButton: false,
                })
            });
        </script>
    @endif
    <script>
        var tags = [];
        var isEdit = false;
        var table;
        const AJAX_URL = "{{ route('news.ajax-datatable') }}"
        $(document).ready(function() {
            //Datatable
            var dataTable = $('#example1').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: AJAX_URL,
                    data(d) {
                        d.type = $("#type_filter").val();
                    }
                },
                columns: [{
                        data: "id_news",
                        name: "id_news",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false,
                        searchable: false,
                        printable: true
                    },
                    {
                        data: "title",
                        name: "title",
                    },
                    {
                        data: "cover",
                        name: "cover",
                        render: function(data, type, row, meta) {
                            return '<img src="{{ url('storage/news/cover') }}/' + data + '" alt="' +
                                row.title + '" class="img-thumbnail" width="200px">';
                        }
                    },
                    {
                        data: "content",
                        name: "content",
                    },
                    {
                        data: "tags",
                        name: "tags",
                        render: function(data, type, row, meta) {
                            var output = '';
                            data.forEach(function(item) {
                                output +=
                                    '<button href="#" class="btn btn-outline-primary m-1 text-left"><i class="fa fa-hashtag"/></i>' +
                                    item.name + '</button>';
                            });
                            return output;
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
                var id_news = $(this).data('id_news');
                var title = $(this).data('title');
                var content = $(this).data('content');
                var cover = $(this).data('cover');
                var image_content = $(this).data('image_content');
                var type = $(this).data('type');
                var tags = $(this).data('tags');
                $("#id_news").val(id_news);
                $("#title").val(title);
                $("#content").val(content);
                $("#cover").val(cover);
                $("#image_content").val(image_content);
                $("#type").val(type);
                $('#form').attr('action', '{{ route('news.editNews') }}');
                isEdit = true;
                var data = getNewsTag(id_news).responseJSON.data;
                data.tags.forEach(function(item) {
                    content =
                        `<div class="btn btn-outline-primary m-1 text-left tagging" data-id_tag = ${item.id_tag} data-id_news = ${data.id_news}><i class="fa fa-hashtag"></i>` +
                        item.name + `</div>`;
                    $("#selected_tag").append(content);
                });
            });

            // Modal closing event
            $('#exampleModalTambah').on('hidden.bs.modal', function () {
                $("#selected_tag").children().remove();
            })

            //Tag delete event
            $('body').on('click', '.tagging', function (e) {
                var id_tag = $(this).data('id_tag');
                var id_news = $(this).data('id_news');
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Delete tag ?',
                    icon: 'info',
                    showCancelButton: true,
                    showConfirmButton: true,
                    showCloseButton: true,
                    confirmButtonText: 'Yes',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            async: false,
                            url: `{{ url('tag/delete-ajax/${id_tag}/${id_news}') }}`,
                            type: 'GET',
                            success: function(result) {
                                $(e.target).remove();
                                dataTable.ajax.reload();
                            },
                            error: function(result) {
                                console.log(result);
                            }
                        });
                    }
                });
            })

            //Tambah
            $("#button_tambah").click(function() {
                $("id_news").val('');
                $("#title").val('');
                $("#content").val('');
                $("#cover").val('');
                $("#image_content").val('');
                isEdit = false;
            });

            //Select Option Change
            $('#tags').on('change', function() {
                var id_tag = $(this).val();
                var name = $('#tags :selected').text();
                tags.push({
                    id_tag: id_tag,
                    name: name
                });
                var content =
                    '<div class="btn btn-outline-primary m-1 text-left"><i class="fa fa-hashtag"></i>' +
                    $('#tags :selected').text(); + '</div>'
                $("#selected_tag").append(content);
                $("#tags option[value='" + this.value + "']").remove();
            });
            buttonSubmit();

            //FILTER
            $("#type_filter").change(function() {
                dataTable.ajax.reload();
            });

            table = dataTable;
        });

        function buttonSubmit() {
            $("#submit").click(function(e) {
                var url;
                if (isEdit == false) {
                    url = '{{ route('news.addNews') }}';
                } else {
                    url = '{{ route('news.editNews') }}';
                }
                var form = new FormData();
                var id_news = $("#id_news").val();
                var tagsObject = JSON.stringify(tags);
                var title = $("#title").val();
                var cover = $('#cover').prop('files')[0];
                var content = $("#content").val();
                var image_content = $("#image_content").prop('files')[0];
                var type = $('#type').val();

                if (typeof image_content == 'undefined') {
                    image_content = '';
                }
                if (typeof cover == 'undefined') {
                    cover = '';
                }

                form.append('id_news', id_news);
                form.append('title', title);
                form.append('cover', cover);
                form.append('content', content);
                form.append('image_content', image_content);
                form.append("tags", tagsObject);
                form.append("type", type);
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

        function getNewsTag(id_news) {
            var newsUrl = '{{ route("admin.getNewsTag", ["id" => 100]) }}';
            newsUrl = newsUrl.replace('100', id_news);
            return $.ajax({
                type: "GET",
                url: newsUrl,
                dataType: "json",
                contentType: false,
                cache: false,
                async: false,
                processData: false,
                success: function(result) {
                    return result;
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
