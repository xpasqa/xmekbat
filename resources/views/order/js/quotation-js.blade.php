@section('page-js')
    <script src="{{ URL::asset('/dist/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="a5885500-81c4-441f-a3a0-6456d35497ee";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    <script>
        $(document).ready(function() {
            submitBtn();
        });

        function submitBtn() {
            $("#submit").click(function(e) {
                var form = new FormData();
                form.append("_token", '{{ csrf_token() }}');

                $.ajax({
                    type: "POST",
                    url: "{{ route('order.confirmQuotation') }}",
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
                            $(location).attr('href', '{{ route("user.pengiriman") }}');
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
