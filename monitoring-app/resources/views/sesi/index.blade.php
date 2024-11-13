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
            <div class="text-center mb-4">
                <h3 class="title-txt">SMART FARMING</h3>
            </div>

            <div class="form-floating mb-4">
                <input type="text" name="email" class="form-control f-i-class" id="floatingInput" placeholder="example@gmail.com" value="{{ Session::get('email') }}">
                <label for="floatingInput" style="color: white">Email Address / Username</label>
            </div>

            <div class="form-floating mb-4">
                <input type="password" name="password" class="form-control f-i-class" id="floatingInput" placeholder="password">
                <label for="floatingInput" style="color: white">Password</label>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success w-50 shadow btn-radius">Log-in</button>
            </div>
        </form>
        
    </div>
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>