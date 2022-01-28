
    $(document).ready(function(){

        // Navbar animation
        $("#open-nav").click(function(){
            $(".admin-nav").toggleClass('animate');
        });

        // datatable JS
        $(".table-col-bar").DataTable();



        //Parmanate Delete Ajax Request
        $('body').on("click", ".deleteCardInDataBase", function(e){
            e.preventDefault();
            per_del_id = $(this).attr('id');

            Swal.fire({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText:'Yes, delete it!'
            }).then((result) => {
                if(result.value){
                    $.ajax({
                        url: 'assets/php/admin-action.php',
                        method: 'post',
                        data: {per_del_id: per_del_id},
                        success:function(response){
                            Swal.fire(
                                'Delete!',
                                'delete Successfully!',
                                'success'
                            )
                            
                            fetchAll();
                        }
                    });
                }
            });
        });
            

        // function validation(){
        //     var departmentsname = document.getElementByID('departmentsname').value;

        //     var departmentsnameChake = /[A-Za-z. ]{3,30}$/;

        //     if(departmentsnameChake.test(departmentsname)){
        //         document.getElementByID('departmentsnameError').innerHTML = " ";
        //     }
        //     else{
        //         document.getElementByID('departmentsnameError').innerHTML = " Ont Currect";
        //         return false;
        //     }
        // }



        // Allow Later And Space
        // jQuery.validator.addMethod("letterSpace", function(value, element) {
        //     return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
        // }, "Letters & Space only please");

        // // Allow Spical
        // jQuery.validator.addMethod("specialCharacters", function(value, element) {
        //     return this.optional(element) || /^[.!@#$%&'*+()\/=?^_`{|}~-]+$/.test(value);
        // }, "Letters only please");




        // $('#departments').keypress(function (e) {
        //     var regex = new RegExp("^[a-zA-Z-. ]+$");
        //     var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        //     if (regex.test(str)) {
        //         return true;
        //         alert('Please enter a valid phone number');
        //     }

        //     e.preventDefault();
        //     return false;
        // });



        // $('#patient').keypress(function (e) {
        //     var regex = new RegExp("^[0-9]+$");
        //     var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        //     if (regex.test(str)) {
        //         alert('Please enter a valid phone number');
        //         return true;
        //     }

        //     e.preventDefault();
        //     return false;
        // });


        // $("#formValidation").validate({
        //     rules: {
        //         departmentsname: {
        //             required: true,
        //             minlength: 3,
        //         },
        //         name: {
        //             required: true,
        //             minlength: 3,
        //             lettersonly: true,
        //         },
        //         email: {
        //             required: true,
        //             email: true,
        //         },
        //     },
        //     messages: {
        //         departmentsname: {
        //             required: "please enter Your Depertment Name",
        //             minlength: "Your user name 3 caracter",
        //             lettersonly:"letters only mate",
        //         },
        //         name: {
        //             required: "please enter a username",
        //             minlength: "Your user name 2 caracter",
        //         },
        //         email: {
        //             required: "please enter a email",
        //             email: "email is not ok",
        //         },
        //     },
        // });

    });

