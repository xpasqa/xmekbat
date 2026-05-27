@section('page-js')
    <script src="{{ URL::asset('/dist/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            submitBtn();
        });

        function submitBtn() {
            $("#submit").click(function(e) {
                if($("#dates").text() == '-' || $("#dates").text() == '')
                {
                    Swal.fire({
                        title: 'Sorry !',
                        text: 'This order is not accepted yet',
                        icon: 'warning',
                        confirmButtonText: 'Got it'
                    })
                }
                else{
                    var form = new FormData();
                    form.append("_token", '{{ csrf_token() }}');

                    $.ajax({
                        type: "POST",
                        url: "{{ route('order.pengirimanConfirm') }}",
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
                                $(location).attr('href', '{{ route('user.preparasi') }}');
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
