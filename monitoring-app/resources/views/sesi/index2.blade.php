<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shorcut icon" href="{{ url('/assets/images/logounsri.png') }}">
    <link href="https://fonts.cdnfonts.com/css/lemonmilk" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/assets/css/loginstyle.css') }}">
    <title>Smart Farming | LOGIN</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>
<body>
    <div class="login-form">
        <form action="{{ url('sesi/login') }}" method="POST">
            @csrf
            <div class="text-center">
                <h3 class="title-txt mb-3 fw-normal">Sistem Login</h3>
            </div>
            <div class="text-center mb-3">
                <img src="../assets/images/logounsri.png" class="img-fluid" alt="..." width="105" height="160">
            </div>

            <div class="form-input">
                <span><i class="fa fa-envelope-o" style="color: black"></i></span>
                <input type="email" name="email" placeholder="Email Address" tabindex="10" value="{{ Session::get('email') }}">
            </div>

            <div class="form-input">
                <span><i class="fa fa-key" style="color: black"></i></span>
                <input type="password" name="password" placeholder="Password">
            </div>

            <div class="mb-3">
                <button type="submit" class="w-100 btn btn-success btn-radius" id="login">Log-in</button>
            </div>
            <div class="text-end">
                <a href="#" class="forget-link">
                  Forget Password?
                </a>
            </div>
        </form>
    </div>
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>