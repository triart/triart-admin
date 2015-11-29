<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
</head>

<body style="background:#F7F7F7;">

<div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
        <div id="login" class="animate form">
            <section class="login_content">
            <!-- resources/views/auth/login.blade.php -->

            <form method="POST" action="/auth/login">
                <h1>Login</h1>
                {!! csrf_field() !!}

                <div>
                    Email
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>

                <div>
                    Password
                    <input type="password" name="password" id="password">
                </div>

                <div>
                    <input type="checkbox" name="remember"> Remember Me
                </div>

                <div>
                    <button type="submit">Login</button>
                </div>

                <div class="clearfix"></div>
                <div class="separator">
                    <div class="clearfix"></div>
                    <br />
                    <div>
                        <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Triartspace</h1>
                        <p>©2015 All Rights Reserved. Triartspace.com</p>
                    </div>
                </div>

            </form>
            </section>
        </div>
    </div>
</body>
</html>