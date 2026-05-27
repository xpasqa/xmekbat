@section('globalscript')
    <!-- script  -->
    <script src="{{ URL::asset('/dist/js/custom.js') }}"></script>
    <script src="{{ URL::asset('/helpers/generalhelper.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".more").click(function() {
                var id_sample = $(this).attr("id");
                var form = new FormData();
                form.append("id_sample", id_sample);
                form.append("_token", '{{ csrf_token() }}');

                $.ajax({
                    type: "POST",
                    url: "{{ route('sample.ajax-selectone') }}",
                    data: form,
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        $("#title").text(result.name);
                        $("#standard_method_description").html(result
                            .standard_method_description);
                        $("#output").html(result.output_description);
                        result.images.forEach(function(item, index) {
                            var content = `<div class="col-4">
                                                <img src="{{ url('storage/testinfo') }}/${item.image}" width="100%" height="140px"
                                                    class="imgthumbnail" alt="">
                                            </div>`;
                            $("#images").append(content);
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
                $('#exampleModalCenter').modal('show');
            });
            $(".close").click(function() {
                $("#images").children().remove();
                $('#exampleModalCenter').modal('hide');
                $('#exampleModalCenter2').modal('hide');
            });
            $("#pricelist").click(function() {
                $('#exampleModalCenter2').modal('show');
            });

            submitLogin();
            changeEvent();
            showModalReset();
            submitReset();
            showModalRegister();
            $(".btn-close").click(function() {
                $('#modal_reset').modal('hide');
                $('#statickBackdrop').modal('hide');
                $('#modal_reset').modal('hide');
                $('.modal-backdrop').remove();
                setTimeout(function() {
                    $('body').removeAttr("style");
                }, 1000);
            });
            registerChangeEvent();
            submitRegister();
            $('#email_msg').hide();
            $('#password_msg').hide();

            $(".img").click(function() {
                var url = $(this).attr("alt");
                if (url != null && url != "") {
                    window.open(url, '_blank');
                }
            });
            $(".people-img").click(function() {
                var url = $(this).attr("alt");
                if (url != null && url != "") {
                    window.open(url, '_blank');
                }
            });
            $(".imgpost").click(function() {
                var url = $(this).attr("alt");
                if (url != null && url != "") {
                    window.open(url, '_blank');
                }
            });
            $(".news-button").click(function() {
                var url = $(this).attr("alt");
                if (url != null && url != "") {
                    window.open(url, '_blank');
                }
            });
            searchNews();
        });

        function searchNews() {
            $("#search").change(function() {
                var search = $(this).val();
                var form = new FormData();
                form.append("search", search);
                form.append("_token", '{{ csrf_token() }}');

                $.ajax({
                    type: "POST",
                    url: "{{ route('news.searchNews') }}",
                    data: form,
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        $("#list").children().remove();
                        result.data.forEach(function(item) {
                            var content = `<div class="col-md-4 mt-4">
                            <div class="blog-item position-relative overflow-hidden">
                                <img class="imgpost" src="{{ url('storage/news/cover') }}/${item.cover}" alt="{{ url('news/detail') }}/${item.slug}">
                                <div class="row my-3">
                                    <div class="col">`;
                            item.tags.forEach(function(tag) {
                                content +=
                                    `<span class="btn btn-sm button-dark-outline">${tag.name}</span>`;
                            });
                            content += `</div>
                                </div>
                                <a class="text-decoration-none" href="{{ url('news/detail') }}/${item.slug}">
                                    <h5 class="color-black title">${item.title}
                                    </h5>
                                    <span class="color-black">${convertIndonesianDate(item.created_at)}</span>
                                </a>
                            </div>
                        </div>`;
                            $("#list").append(content);
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        }

        function submitLogin() {
            $("#submit_login").click(function(e) {
                const isValid = checkForm($("#email").val(), $("#password").val());

                if (isValid) {
                    var form = new FormData();
                    form.append("email", $("#email").val());
                    form.append("password", $("#password").val());
                    form.append("_token", '{{ csrf_token() }}');

                    $.ajax({
                        type: "POST",
                        url: "{{ route('auth.login') }}",
                        data: form,
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(result) {
                            if (result.role == 'user') {
                                Swal.fire({
                                    title: 'Success!',
                                    icon: 'success',
                                    showConfirmButton: false,
                                })
                                setTimeout(function() {
                                    swal.close();
                                }, 1500);
                                setTimeout(function() {
                                    $(location).attr('href', '{{ route('user.index') }}');
                                }, 3000);
                            } else {
                                Swal.fire({
                                    title: 'Success!',
                                    icon: 'success',
                                    showConfirmButton: false,
                                })
                                setTimeout(function() {
                                    swal.close();
                                }, 1500);
                                setTimeout(function() {
                                    $(location).attr('href', '{{ route('admin.index') }}');
                                }, 3000);
                            }
                        },
                        error: function(error) {
                            Swal.fire({
                                title: 'Unauthorized',
                                text: 'Username & Password Not Match',
                                icon: 'error',
                                confirmButtonText: 'Got it'
                            })
                        }
                    });
                } else {
                    e.preventDefault();
                }
            });
        }

        function delay(callback, ms) {
            var timer = 0;
            return function() {
                var context = this,
                    args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function() {
                    callback.apply(context, args);
                }, ms || 0);
            };
        }

        //Submit Register
        function submitRegister() {
            $("#submit_register").click(function(e) {
                const isValid = checkFormRegister($("#name_register").val(), $("#email_register").val(), $(
                    "#password_register").val(), $("#confirm_password").val());

                if (isValid) {
                    var form = new FormData();
                    form.append("name", $("#name_register").val());
                    form.append("email", $("#email_register").val());
                    form.append("password", $("#password_register").val());
                    form.append("_token", '{{ csrf_token() }}');

                    $.ajax({
                        type: "POST",
                        url: "{{ route('auth.createAccount') }}",
                        data: form,
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(result) {
                            Swal.fire({
                                title: 'Success !',
                                text: 'Your account successfully created',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                        },
                        error: function(error) {
                            Swal.fire({
                                title: 'Unauthorized',
                                text: 'Username & Password Not Match',
                                icon: 'error',
                                confirmButtonText: 'Got it'
                            })
                        }
                    });
                } else {
                    e.preventDefault();
                }
            });
        }

        function checkFormRegister(name = '', email = '', password = '', password_confirm = '') {
            if (name == "" || email == "" || password == "" || password_confirm == "") {
                Swal.fire({
                    title: 'Opps!',
                    text: 'Make sure your form filled correctly',
                    icon: 'info',
                    confirmButtonText: 'Got it'
                })
                return false;
            } else {
                return true;
            }
        }

        function registerChangeEvent() {
            $('#email_register').keyup(delay(function(e) {
                verifyEmail();
            }, 1000));

            $("#name_register").on("keyup change", function() {
                if ($("#name_register").val() != '') {
                    $("#name_register").css("border-color", "black");
                } else {
                    $("#name_register").css("border-color", "red");
                }
            })
            $("#password_register").on("keyup change", function() {
                if ($("#password_register").val() != '') {
                    $("#password_register").css("border-color", "black");
                } else {
                    $("#password_register").css("border-color", "red");
                }
            })
            $("#confirm_password").on("keyup change", function() {
                if ($("#confirm_password").val() != $("#password_register").val()) {
                    $('#password_msg').show();
                    $('#password_msg').text('Password Not Match');
                    $("#confirm_password").css("border-color", "red");
                } else {
                    $('#password_msg').hide();
                    $("#confirm_password").css("border-color", "green");
                }
            })
        }

        function verifyEmail() {
            var form = new FormData();
            form.append("email", $("#email_register").val());
            form.append("_token", "{{ csrf_token() }}");

            $.ajax({
                type: "POST",
                url: "{{ route('auth.verifyEmail') }}",
                data: form,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    if (result.status == true) {
                        $('#email_msg').show();
                        $('#email_msg').text('Email can be used');
                        $("#email_register").css("border-color", "green");
                    } else {
                        $('#email_msg').show();
                        $('#email_msg').text('Email already used');
                        $("#email_register").css("border-color", "red");
                    }
                },
                error: function(error) {
                    $("#email_register").css("border-color", "red");
                }
            });
        }

        function checkForm(email = '', password = '') {
            if (email == "") {
                $("#email").css("border-color", "red");
                Swal.fire({
                    title: 'Opps!',
                    text: 'Make sure your email filled correctly',
                    icon: 'info',
                    confirmButtonText: 'Got it'
                })
                return false;
            } else if (password == "") {
                $("#password").css("border-color", "red");
                Swal.fire({
                    title: 'Opps!',
                    text: 'Make sure your password filled correctly',
                    icon: 'info',
                    confirmButtonText: 'Got it'
                })
                return false;
            } else {
                return true;
            }
        }

        function changeEvent() {
            $("#email").on("keyup change", function() {
                if ($("#email").val() != '') {
                    $("#email").css("border-color", "black");
                }
            })
            $("#password").on("keyup change", function() {
                if ($("#password").val() != '') {
                    $("#password").css("border-color", "black");
                }
            })
        }

        //RESET
        function showModalReset() {
            $("#forgot_link").click(function(e) {
                e.preventDefault();
                $('#staticBackdrop').modal('hide');
                $("#modal_register").modal("hide");
                //Show
                setTimeout(function() {
                    $('#modal_reset').modal('show');
                }, 1000);
            });
        }

        //Register
        function showModalRegister() {
            $("#register_link").click(function(e) {
                e.preventDefault();
                $('#modal_reset').modal('hide');
                $('#staticBackdrop').modal('hide');

                //Show
                setTimeout(function() {
                    $('#modal_register').modal('show');
                }, 1000);
            });
        }

        function submitReset() {
            $("#submit_reset").click(function(e) {
                const isValid = checkFormReset($("#email_reset").val());

                if (isValid) {
                    var form = new FormData();
                    form.append("email", $("#email_reset").val());
                    form.append("_token", '{{ csrf_token() }}');

                    $.ajax({
                        type: "POST",
                        url: "{{ route('auth.forgot') }}",
                        data: form,
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(result) {
                            Swal.fire({
                                title: 'Success',
                                text: 'Please check your email to reset your password',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            setTimeout(function() {
                                swal.close();
                            }, 2500);
                            setTimeout(function() {
                                $("#modal_reset").modal("hide");
                            }, 3000);
                        },
                        error: function(error) {
                            Swal.fire({
                                title: 'Opps!',
                                text: 'Email not found',
                                icon: 'error',
                                confirmButtonText: 'Got it'
                            })
                        }
                    });
                } else {
                    e.preventDefault();
                }
            });
        }

        function checkFormReset(email = '') {
            if (email == "") {
                $("#email_reset").css("border-color", "red");
                Swal.fire({
                    title: 'Opps!',
                    text: 'Make sure your email filled correctly',
                    icon: 'info',
                    confirmButtonText: 'Got it'
                })
                return false;
            } else {
                return true;
            }
        }

        // home slider
        const slides = document.querySelectorAll('.slide');
        const nextSlider = document.querySelector('.next');
        const prevSlider = document.querySelector('.prev');
        const auto = false; // Auto scroll
        const intervalTime = 5000;
        let slideInterval;

        const nextSlide = () => {
            // Get current class
            const current = document.querySelector('.current');
            // Remove current class
            current.classList.remove('current');
            // Check for next slide
            if (current.nextElementSibling) {
                // Add current to next sibling
                current.nextElementSibling.classList.add('current');
            } else {
                // Add current to start
                slides[0].classList.add('current');
            }
            setTimeout(() => current.classList.remove('current'));
        };

        const prevSlide = () => {
            // Get current class
            const current = document.querySelector('.current');
            // Remove current class
            current.classList.remove('current');
            // Check for prev slide
            if (current.previousElementSibling) {
                // Add current to prev sibling
                current.previousElementSibling.classList.add('current');
            } else {
                // Add current to last
                slides[slides.length - 1].classList.add('current');
            }
            setTimeout(() => current.classList.remove('current'));
        };

        // Button events
        nextSlider.addEventListener('click', e => {
            nextSlide();
            if (auto) {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, intervalTime);
            }
        });

        prevSlider.addEventListener('click', e => {
            prevSlide();
            if (auto) {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, intervalTime);
            }
        });

        // Auto slide
        if (auto) {
            // Run next slide at interval time
            slideInterval = setInterval(nextSlide, intervalTime);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        //Hover Profile
        $(".user-profile").on({
            mouseenter: function() {
                $(this).css('cursor', 'pointer');
            },
            mouseleave: function() {
                $(this).css('cursor', 'auto');
            }
        });
    </script>
@endsection
