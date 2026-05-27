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
        var peoples = [];
        var isEdit = false;
        $(document).ready(function() {
            //Datatable
            $('#example1').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ route('people.ajax-datatable') }}",
                columns: [{
                        data: "id_people",
                        name: "id_people",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false,
                        searchable: false,
                        printable: true
                    },
                    {
                        data: "image",
                        name: "image",
                        render: function(data, type, row, meta) {
                            return '<img class="rounded-circle" width="80px" alt="80x80" src="{{url("storage/people")}}/'+data+'" data-holder-rendered="true">';
                        },
                    },
                    {
                        data: "name",
                        name: "name",
                    },
                    {
                        data: "slug",
                        name: "slug",
                    },
                    {
                        data: "position",
                        name: "position",
                    },
                    {
                        data: "description",
                        name: "description",
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
                var id_people = $(this).data('id_people');
                var name = $(this).data('name');
                var slug = $(this).data('slug');
                var position = $(this).data('position');
                var description = $(this).data('description');
                $("#id_people").val(id_people);
                $("#name").val(name);
                $("#slug").val(slug);
                $("#position").val(position);
                $("#description").val(description);
                $("#modal-edit").modal('show');
                $('#form').attr('action', '{{ route('people.editPeople') }}');
                isEdit = true;
            });

            //Add Journals
            $("#example1").on("click", ".open-journals", function(e) {
                e.preventDefault();
                var id_people2 = $(this).data('id_people');
                $("#id_people2").val(id_people2);
            });

            //Tambah
            $("#button_tambah").click(function() {
                $("#id_people").val('');
                $("#name").val('');
                $("#slug").val('');
                $("#position").val('');
                $("#description").val('');
                $('#form').attr('action', '{{ route('people.addPeople') }}');
                isEdit = false;
            });

             //Select Option Change
             $('#tags').on('change', function() {
                $(".research").show();
                var id_journal = $(this).val();
                var title = $('#tags :selected').text();
                peoples.push({
                    id_journal: id_journal,
                    title: title
                });
                var content =
                    '<button href="#" class="btn btn-outline-primary m-1 text-left"><i class="fa fa-hashtag"></i>' +
                    $('#tags :selected').text(); + '</button>'
                $("#selected_tag").append(content);
                $("#tags option[value='" + this.value + "']").remove();
                console.log(peoples);
            });
            buttonSubmit();
            checkboxToggle();
            $(".research").hide();
        });

        function buttonSubmit() {
            $("#submit").click(function(e) {
                e.preventDefault();
                var url;
                if (isEdit == false) {
                    url = '{{route("people.addPeople")}}';
                } else {
                    url = '{{route("people.editPeople")}}';
                }
                var form = new FormData();
                var id_people = $("#id_people").val();
                var slug = $("#slug").val();
                var name = $("#name").val();
                var journalsObject = JSON.stringify(peoples);
                var position = $("#position").val();
                var description = $("#description").val();
                var file = $("#file").prop('files')[0];

                if(typeof file == 'undefined')
                {
                    file = '';
                }

                form.append('id_people', id_people);
                form.append('slug', slug);
                form.append('name', name);
                form.append('position', position);
                form.append('description', description);
                form.append('file', file);
                form.append("journals", journalsObject);
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
                        location.reload();
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

        function checkboxToggle(){
            $(".toggle").click(function(){
            if($(this).is(':checked')){
                $(".research").hide();
                $('#exampleModalTambah').modal('hide');
                setTimeout(function() {
                    $('#modalJournals').modal('show');
                    $("#toggle2").prop('checked', true);
                }, 1000);
            }else{
                $(".research").show();
                $('#modalJournals').modal('hide');
                setTimeout(function() {
                    $('#exampleModalTambah').modal('show');
                    $("#toggle1").prop('checked', false);
                }, 1000);
            }
            });
        }
    </script>
@endsection
