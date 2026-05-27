@section('page-js')
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="a5885500-81c4-441f-a3a0-6456d35497ee";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".linkbtn").click(function() {
                var form = new FormData();
                form.append("id_project", $(this).val());
                form.append("_token", '{{ csrf_token() }}');

                $.ajax({
                    type: "POST",
                    url: "{{ route('order.setProjectSession') }}",
                    data: form,
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        var url = '{{ route("user.pilihlab") }}';
                        url = url.replace('pilihlab', result.data.current_step);    
                        document.location.href=url;
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            })
        });
    </script>
@endsection
