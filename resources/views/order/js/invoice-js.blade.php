@section('page-js')
    <script src="{{ URL::asset('/dist/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#file").change(function() {
                var image = $(this)[0].files[0];
                var id_project = "{{ Session::get('id_project') }}";

                var form = new FormData();
                var url = '{{ route('project.uploadBukti') }}';
                form.append("id_project", id_project);
                form.append("file", image);
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
            submitBtn();
            deleteBukti();
        });

        function deleteBukti() {
            $(".closed").click(function() {
                Swal.fire({
                    title: 'Proof Of Payment',
                    text: 'Are you sure want to delete this proof ?',
                    icon: 'info',
                    showConfirmButton: true,
                    confirmButtonText: 'Yes i`m sure',
                    showCancelButton: true,
                    cancelButtonText: 'Nope',
                    showCloseButton: true,
                }).then((result) => {
                    if (result.value) {
                        var id_project = "{{ Session::get('id_project') }}";
                        var form = new FormData();
                        form.append("id_project", id_project);
                        form.append("_token", '{{ csrf_token() }}');
                        $.ajax({
                            type: "POST",
                            url: "{{ route('project.deleteBukti') }}",
                            data: form,
                            dataType: "json",
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(result) {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Bukti has been deleted',
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
                                    text: 'Action cannot be done',
                                    icon: 'error',
                                    confirmButtonText: 'Got it'
                                })
                            }
                        });
                    }
                })

            })
        }

        function submitBtn() {
            $("#submit").click(function(e) {
                var status = "{{ $project->status }}";

                if (status != "completed") {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Information',
                        text: `Can't proceed to the next step, wait for the admin to confirm your payment`,
                        icon: 'warning',
                        confirmButtonText: 'Got it'
                    })
                } else {
                    var form = new FormData();
                    form.append("_token", '{{ csrf_token() }}');

                    $.ajax({
                        type: "POST",
                        url: "{{ route('order.invoiceConfirm') }}",
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
                            setTimeout(function() {
                                $(location).attr('href', '{{ route('user.download') }}');
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
                }
            });
        }
    </script>
@endsection
