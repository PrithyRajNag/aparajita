<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Rony Kumar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=on">
    <title>Login | Admin</title>

    <!--CSS LINK -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css')}}">
    <style type="text/css">
        html, body {
            height: 100%;
        }
    </style>


<body class="login-body">
<div class="container">
    <!-- Login Form Start -->
    <div class="row justify-content-center wrapper" id="login-box">
        <div class="col-lg-10 my-auto myShadow">
            <div class="row">
                <div class="col-lg-7 bg-white p-4">
{{--                    <h1 class="text-center font-weight-bold text-primary">Sign in to Account</h1>--}}
                    <h1 class="text-center font-weight-bold text-primary">Admin Sign In</h1>
                    <hr class="my-3"/>
                    @if($errors->any())
                        {{ implode('', $errors->all('<div>:message</div>')) }}
                    @endif
                    <form action="{{ route('com-login-validation') }}" method="post" class="px-3" id="login-form">
                        @csrf
{{--                    <form action="#" method="post" class="px-3" id="login-form">--}}
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0"><i
                                        class="far fa-envelope fa-lg fa-fw"></i></span>
                            </div>
                            <input type="email" id="email" name="email" class="form-control rounded-0"
                                   placeholder="E-Mail" required/>
                        </div>
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0"><i class="fas fa-key fa-lg fa-fw"></i></span>
                            </div>
                            <input type="password" id="password" name="password" class="form-control rounded-0"
                                   minlength="5" placeholder="Password" required autocomplete="off"/>
                        </div>
                        <div class="form-group clearfix">
                            <div class="custom-control custom-checkbox float-left">
                                <input type="checkbox" class="custom-control-input" id="customCheck" name="rem"/>
                                <label class="custom-control-label" for="customCheck">Remember me</label>
                            </div>
                            <div class="forgot float-right">
                                <a href="#" id="forgot-link">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" id="login-btn" value="Sign In"
                                   class="btn btn-primary btn-lg btn-block myBtn"/>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 d-flex flex-column justify-content-center myColor p-4">
                    <h1 class="text-center font-weight-bold text-white">Hello Friends!</h1>
                    <hr class="my-3 bg-light myHr"/>
                    <p class="text-center font-weight-bolder text-light lead">Enter your personal details and start your
                        journey with us!</p>
                    <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn"
                            id="password-link">Forgot Password
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Form End -->

    <!-- Forgot Password Form Start -->
    <div class="row justify-content-center wrapper" id="forgot-box" style="display: none;">
        <div class="col-lg-10 my-auto myShadow">
            <div class="row">
                <div class="col-lg-7 bg-white p-4">
                    <h1 class="text-center font-weight-bold text-primary">Forgot Your Password?</h1>
                    <hr class="my-3"/>
                    <p class="lead text-center text-secondary">To reset your password, enter the registered e-mail
                        adddress and we will send you password reset instructions on your e-mail!</p>
                    <form action="#" method="post" class="px-3" id="forgot-form">
                        <div id="forgotAlert"></div>
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0"><i class="far fa-envelope fa-lg"></i></span>
                            </div>
                            <input type="email" id="femail" name="email" class="form-control rounded-0"
                                   placeholder="E-Mail" required/>
                        </div>
                        <div class="form-group">
                            <input type="submit" id="forgot-btn" value="Reset Password"
                                   class="btn btn-primary btn-lg btn-block myBtn"/>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 d-flex flex-column justify-content-center myColor p-4">
                    <h1 class="text-center font-weight-bold text-white">Reset Password!</h1>
                    <hr class="my-4 bg-light myHr"/>
                    <button class="btn btn-outline-light btn-lg font-weight-bolder myLinkBtn align-self-center"
                            id="back-link">Back
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Forgot Password Form End -->
</div>

<!-- Java Script Link -->
{{--    {{ URL::asset('js/jquery.js') }}--}}
<script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/all.min.js') }}"></script>


<script type="text/javascript">
    $(function () {
        $("#password-link").click(function () {
            $("#login-box").hide();
            $("#forgot-box").show();
        });

        $("#forgot-link").click(function () {
            $("#login-box").hide();
            $("#forgot-box").show();
        });
        $("#back-link").click(function () {
            $("#login-box").show();
            $("#forgot-box").hide();
        });
    });
</script>

</body>
</html>
