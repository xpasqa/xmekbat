@section('page-js')
    <script src="{{ URL::asset('/dist/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="a5885500-81c4-441f-a3a0-6456d35497ee";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>

    <script>
        $(document).ready(function() {
            $('.side-nav-link').click(function(e) {
                e.preventDefault();
            });
            checkForm(
                $('#project_name').val(),
                $('#project_location').val(),
                $('#pic').val(),
                $('#company_name').val(),
                $('#file').val(),
            );
            changeEvent();
            submitForm();
        });

        function changeEvent() {
            $("#project_name").on("keyup change", function() {
                if ($("#project_name").val() != '') {
                    $("#project_name").css("border-color", "#ced4da");
                } else {
                    $("#project_name").css("border-color", "red");
                }

                checkForm(
                    $('#project_name').val(),
                    $('#project_location').val(),
                    $('#pic').val(),
                    $('#company_name').val(),
                    $('#file').val(),
                );
            })
            $("#project_location").on("keyup change", function() {
                if ($("#project_location").val() != '') {
                    $("#project_location").css("border-color", "#ced4da");
                } else {
                    $("#project_location").css("border-color", "red");
                }

                checkForm(
                    $('#project_name').val(),
                    $('#project_location').val(),
                    $('#pic').val(),
                    $('#company_name').val(),
                    $('#file').val(),
                );
            })
            $("#pic").on("keyup change", function() {
                if ($("#pic").val() != '') {
                    $("#pic").css("border-color", "#ced4da");
                } else {
                    $("#pic").css("border-color", "red");
                }

                checkForm(
                    $('#project_name').val(),
                    $('#project_location').val(),
                    $('#pic').val(),
                    $('#company_name').val(),
                    $('#file').val(),
                );
            })
            $("#company_name").on("keyup change", function() {
                if ($("#company_name").val() != '') {
                    $("#company_name").css("border-color", "#ced4da");
                } else {
                    $("#company_name").css("border-color", "red");
                }

                checkForm(
                    $('#project_name').val(),
                    $('#project_location').val(),
                    $('#pic').val(),
                    $('#company_name').val(),
                    $('#file').val(),
                );
            })
            $("#file").change(function() {
                if ($("#file").val() != '') {
                    $("#file").css("border-color", "#ced4da");
                } else {
                    $("#file").css("border-color", "red");
                }

                checkForm(
                    $('#project_name').val(),
                    $('#project_location').val(),
                    $('#pic').val(),
                    $('#company_name').val(),
                    $('#file').val(),
                );
            });
        }

        function checkForm(
            $project_name = '',
            project_location = '',
            $pic = '',
            $company_name = '',
            $file = ''
        ) {
            if ($project_name == '' || project_location == '' || $pic == '' ||
                $company_name == '' || $file == '') {
                $("#submit").attr("disabled", true);
            } else {
                console.log('ready');
                $("#submit").attr("disabled", false);
            }
        }

        function submitForm() {
            $("#submit").click(function(e) {

                var form = new FormData();
                var file_data = $('#file').prop('files')[0];
                form.append("project_name", $("#project_name").val());
                form.append("project_location", $("#project_location").val());
                form.append("pic", $("#pic").val());
                form.append("company_name", $("#company_name").val());
                form.append("email", $("#email_project").val());
                form.append("phone", $("#phone").val());
                form.append("file", file_data);
                form.append("_token", '{{ csrf_token() }}');
                form.append("address", $("#address").val());

                $.ajax({
                    type: "POST",
                    url: "{{ route('order.addProject') }}",
                    data: form,
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function() {
                            swal.close();
                        }, 1500);
                        setTimeout(function() {
                            $(location).attr('href', '{{ route("user.pilihlab") }}');
                        }, 3000);
                    },
                    error: function(error) {
                        Swal.fire({
                            title: 'Error',
                            text: error,
                            icon: 'error',
                            confirmButtonText: 'Got it'
                        })
                    }
                });
            });
        }
    </script>
@endsection
