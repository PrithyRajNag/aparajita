<!-- Footer Area -->
</div>
</div>
</div>

<!-- Java Script Link -->
<script type="text/javascript" src="{{ asset('/js/jquery-3.5.1.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('/js/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('/js/jquery-ui.min.js')}}"></script>
<!-- <script type="text/javascript" src="assets/js/bootstrap.min.js')}}"></script> -->
<!-- <script type="text/javascript" src="assets/js/popper.min.js')}}"></script> -->
<script type="text/javascript" src="{{ asset('/js/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('/js/sweetalert2@8.js')}}"></script>
<script type="text/javascript" src="{{ asset('/js/all.min.js')}}"></script>
<!-- <script type="text/javascript" src="assets/js/jquery.validate.js"></script> -->
<!-- <script type="text/javascript" src="assets/js/jquery.validate.min.js"></script> -->
<!-- <script type="text/javascript" src="assets/js/additional-methods.min.js"></script> -->
<script type="text/javascript" src="{{ asset('/js/main.js')}}"></script>
<script type="text/javascript" src="{{ asset('/js/custom.js')}}"></script>
<!-- <script type="text/javascript" src="assets/js/bootstrap-validate.js"></script> -->

<!-- Select2 -->
<script type="text/javascript" src="{{ asset('/js/select2.full.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>
    $(function () {


        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        // Validation For Restrict Taking Date
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var prepareDate = year + '-' + month + '-' + day;

        // Validation For Restrict Taking Past Date Only Take Future Date
        $('.take_future_date').attr('min', prepareDate);
        // Validation For Restrict Taking Past Date Only Take Future Date Ends

        // Validation For Restrict Taking Future Date Only Take Past Date
        $('.take_past_date').attr('max', prepareDate);
        // Validation For Restrict Taking Future Date Only Take Past Date Ends


        //Browser Validation For Create
        $("input[name*='first_name']").keyup(function () {
            let value_input = $("input[name*='first_name']").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("input[name*='first_name']").val(value_input.replace(regexp, ''))
            }
        });

        $("input[name*='last_name']").keyup(function () {
            let value_input = $("input[name*='last_name']").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("input[name*='last_name']").val(value_input.replace(regexp, ''))
            }
        });

        $("input[name*='phone_number']").keyup(function () {
            let value_input = $("input[name*='phone_number']").val();
            let regexp = /[^0-9+]/g;
            if (value_input.match(regexp)) {
                $("input[name*='phone_number']").val(value_input.replace(regexp, ''))
            }
        });

        $("input[name*='nid']").keyup(function () {
            let value_input = $("input[name*='nid']").val();
            let regexp = /[^0-9+]/g;
            if (value_input.match(regexp)) {
                $("input[name*='nid']").val(value_input.replace(regexp, ''))
            }
        });

        // $("input[name*='name']").keyup(function () {
        //     let value_input = $("input[name*='name']").val();
        //
        //     let regexp = /[^a-zA-Z. ]/g;
        //     if (value_input.match(regexp)) {
        //         $("input[name*='name']").val(value_input.replace(regexp, ''))
        //     }
        //     if (value_input.length > 30) {
        //         $("#name_error").text("Name Should Be Less Than 30 Character");
        //         return;
        //     }
        //     $("#name_error").text('');
        // });

        // Browser Validation For Edit

        $("#first_name").keyup(function () {
            let value_input = $("#first_name").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("#first_name").val(value_input.replace(regexp, ''))
            }
        });

        $("#last_name").keyup(function () {
            let value_input = $("#last_name").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("#last_name").val(value_input.replace(regexp, ''))
            }
        });

        $("#phone_number").keyup(function () {
            let value_input = $("#phone_number").val();
            let regexp = /[^0-9+]/g;
            if (value_input.match(regexp)) {
                $("#phone_number").val(value_input.replace(regexp, ''))
            }
        });
        $("#nid").keyup(function () {
            let value_input = $("#nid").val();
            let regexp = /[^0-9+]/g;
            if (value_input.match(regexp)) {
                $("#nid").val(value_input.replace(regexp, ''))
            }
        });
        // $("#name").keyup(function () {
        //     let value_input = $("#name").val();
        //
        //     let regexp = /[^a-zA-Z. ]/g;
        //     if (value_input.match(regexp)) {
        //         $("#name").val(value_input.replace(regexp, ''))
        //     }
        //
        //     if (value_input.length > 30) {
        //         $("#update_name_error").text("Name Should Be Less Than 30 Character");
        //         return;
        //     }
        //     $("#update_name_error").text('');
        // });


        //For Image Preview
        $("#image").on('change', function () {
            var imgPath = $(this)[0].value;
            var extension = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (extension === "gif" || extension === "png" || extension === "jpg" || extension === "jpeg"){
                if (typeof (FileReader) != "undefined") {

                    var image_holder = $("#image-holder");
                    image_holder.empty();

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "img-thumbnail"
                        }).appendTo(image_holder);
                    };
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            }else {
                alert("Please Select Image Only !");
            }
        });

    });

</script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>--}}

@stack('customScripts')

</body>
</html>
