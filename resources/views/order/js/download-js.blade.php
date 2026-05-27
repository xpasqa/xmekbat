@section('page-js')
    <script src="{{ URL::asset('/dist/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script>
        var canConfirm = false;
        $(document).ready(function() {
            $(".btn_download").hide();
            submitBtn();
            isChecked();
        });

        function submitBtn() {
            $("#submit").click(function(e) {
                if(canConfirm == true){
                    var postUrl;
                    var ketepatan_waktu = $('input[type=radio][name=ketepatan_waktu]:checked').val();
                    var komunikasi = $('input[type=radio][name=komunikasi]:checked').val();
                    var kejelasan = $('input[type=radio][name=kejelasan]:checked').val();
                    var informasi = $('input[type=radio][name=informasi]:checked').val();
                    var saran = $("#saran").val();
                    var id_survey = $("#id_survey").val();

                    if(id_survey == null || id_survey == ""){
                        postUrl = "{{ route('survey.addSurvey') }}";
                    }
                    else{
                        postUrl = "{{ route('survey.editSurvey') }}";
                    }

                    var form = new FormData();
                    form.append("id_survey", id_survey);
                    form.append("ketepatan_waktu", ketepatan_waktu);
                    form.append("komunikasi", komunikasi);
                    form.append("kejelasan", kejelasan);
                    form.append("informasi", informasi);
                    form.append("saran", saran);
                    form.append("_token", '{{ csrf_token() }}');

                    $.ajax({
                        type: "POST",
                        url: postUrl,
                        data: form,
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(result) {
                            showSuccessCheck();
                            setTimeout(function() {
                                swal.close();
                            }, 1500);
                            setTimeout(function() {
                                $(location).attr('href', '{{ route('user.index') }}');
                            }, 3000);
                        },
                        error: function(error) {
                            Swal.fire({
                                title: 'Error',
                                text: "Form can't be stored",
                                icon: 'error',
                                showConfirmButton: false,
                            })
                        }
                    });
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: "Make sure that all data has been filled",
                        icon: 'error',
                        showConfirmButton: false,
                    })
                }
            });
        }

        function isChecked(){
            $('#menyetujui').click(function(){
            if($(this).is(":checked")){
                $(".btn_download").show();
                canConfirm = true;
            }
            else if($(this).is(":not(:checked)")){
                $(".btn_download").hide();
                canConfirm = false;
            }
        });
        }
    </script>
@endsection
