@section('page-js')
    <script src="{{ URL::asset('/dist/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        window.$crisp = [];
        window.CRISP_WEBSITE_ID = "a5885500-81c4-441f-a3a0-6456d35497ee";
        (function() {
            d = document;
            s = d.createElement("script");
            s.src = "https://client.crisp.chat/l.js";
            s.async = 1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();
    </script>
    <script>
        var arrayObject = [];
        $(document).ready(function() {
            checkBox();
            submitBtn();
        });

        function submitBtn() {
            $("#submit").click(function(e) {
                if (arrayObject.length == 0) {
                    Swal.fire({
                        title: 'Information',
                        text: 'Please order item to continue',
                        icon: 'info',
                        showConfirmButton: false,
                    })
                }
                else{
                    var form = new FormData();
                    var jsonObject = JSON.stringify(arrayObject);
                    form.append("json_object", jsonObject);
                    form.append("_token", '{{ csrf_token() }}');

                    $.ajax({
                        type: "POST",
                        url: "{{ route('order.addOrders') }}",
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
                                $(location).attr('href', '{{ route('user.quotation') }}');
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

        function checkBox() {
            $('.form-check-input').change(function() {
                if ($(this).is(":checked")) {
                    var id = $(this).attr("id");
                    arrayObject.push({
                        id_sample: $(this).attr("id"),
                        price_rates: $(this).val(),
                        qty: $("#qty-" + $(this).attr("id")).val()
                    });
                    totalProduk(sumQty(arrayObject), sumPriceRates(arrayObject));
                    $("#qty-" + id).removeAttr("readonly");
                    $("#qty-" + id).removeAttr("style");

                    //Qty change by event
                    $("#qty-" + id).change(function() {
                        qtyChange(id);
                    })
                    $("#btnqty-" + id).click(function() {
                        var currentVal = $("#qty-" + id).val();
                        if (currentVal > 0) {
                            currentVal = parseInt(currentVal) - 1;
                            $("#qty-" + id).val(currentVal)
                        }
                        qtyChange(id);
                    });
                    $("#btnqty2-" + id).click(function() {
                        var currentVal = $("#qty-" + id).val();
                        currentVal = parseInt(currentVal) + 1;
                        $("#qty-" + id).val(currentVal)
                        qtyChange(id);
                    });
                } else {
                    let find = arrayObject.filter(data => data.id_sample == $(this).attr("id"));
                    if (find.length > 0) {
                        let index = arrayObject.indexOf(find[0]);
                        index > -1 ? arrayObject.splice(index, 1) : null;
                    }
                    totalProduk(sumQty(arrayObject), sumPriceRates(arrayObject));
                    $("#qty-" + $(this).attr("id")).attr("readonly", "readonly");
                    $("#qty-" + $(this).attr("id")).css("background-color", "rgb(230, 230, 230)");
                }
            });
        }

        function qtyChange(id) {
            var qty = $("#qty-" + id).val();
            arrayObject.forEach((data) => {
                if (id == data.id_sample) {
                    data.qty = qty;
                }
            });
            $("#selfprice-" + id).html(formatRupiah(subTotal(id), 'Rp. '));
            totalProduk(sumQty(arrayObject), sumPriceRates(arrayObject));
        }

        //Helpers
        function sumQty(arrayObject) {
            var total = 0;
            arrayObject.forEach((data) => {
                total = total + parseInt(data.qty);
            });
            return total;
        }

        function sumPriceRates(arrayObject) {
            var total = 0;
            arrayObject.forEach((data) => {
                total += parseInt(data.price_rates) * parseInt(data.qty);
            });
            return total;
        }

        function subTotal(id) {
            let subtotal = 0;
            let find = arrayObject.filter(data => data.id_sample == id);

            if (find.length > 0) {
                subtotal = find[0].price_rates * find[0].qty;
            }
            return subtotal;
        }

        function totalProduk(total_produk, total_price) {
            $("#total_produk").first().text(`Total (${total_produk} Produk) `);
            $("#total_produk").append(`<strong>${formatRupiah(total_price, 'Rp. ')}</strong>`);
        }

        function formatRupiah(angka, prefix) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
        //End Helpers

        var input = document.querySelector("#qty");
        var btnminus = document.querySelector(".qtyminus");
        var btnplus = document.querySelector(".qtyplus");

        if (
            input !== undefined &&
            btnminus !== undefined &&
            btnplus !== undefined &&
            input !== null &&
            btnminus !== null &&
            btnplus !== null
        ) {
            var min = Number(input.getAttribute("min"));
            var max = Number(input.getAttribute("max"));
            var step = Number(input.getAttribute("step"));

            function qtyminus(e) {
                var current = Number(input.value);
                var newval = current - step;
                if (newval < min) {
                    newval = min;
                } else if (newval > max) {
                    newval = max;
                }
                input.value = Number(newval);
                e.preventDefault();
            }

            function qtyplus(e) {
                var current = Number(input.value);
                var newval = current + step;
                if (newval > max) newval = max;
                input.value = Number(newval);
                e.preventDefault();
            }

            btnminus.addEventListener("click", qtyminus);
            btnplus.addEventListener("click", qtyplus);
        }
    </script>
@endsection
