@section('globaluser-js')
    <script>
        //Hover Profile
        $('body').on({
            mouseenter: function() {
                var sample = $(this).attr('href');
                if(sample == 'javascript:void(0)')
                {
                    $(this).css('cursor', 'auto');
                }
                else {
                    $(this).css('cursor', 'pointer');
                }
            },
            mouseleave: function() {
                $(this).css('cursor', 'auto');
            }
        }, '.nav-link');
    </script>
@endsection
