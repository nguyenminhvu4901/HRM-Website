<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <H1>Đăng ký</H1>
    <form action="{{ route('process_register') }}" method="POST">
        @csrf
        <span style="color: #f44336">
            @if (Session::has('message'))
                {{ Session::get('message') }}
            @endif
        </span>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
        <br>
        Name
        <input type="text" name="name" value="{{ old('name') }}">
        <br>
        Password
        <input type="password" name="password">
        <br>
        <button type="submit">Register</button>
    </form>
    <form action="{{ route('login') }}">
        <button>Thoat</button>
    </form>
</body>

</html>
