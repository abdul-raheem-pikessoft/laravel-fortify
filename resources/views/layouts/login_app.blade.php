<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('page')
    </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    @vite(['resources/sass/app.scss'])
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#">
            <b>
                @yield('page')
            </b>
            </b>
        </a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            @yield('content')
        </div>
    </div>
</div>
@vite(['resources/js/app.js'])
</body>
</html>
