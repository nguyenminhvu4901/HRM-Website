<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <H1>Quên mật khẩu</H1>
    <form action="{{ route('processForgetPassword') }}" method="POST">
        @csrf
        <span style="color: #f44336">
            @if (Session::has('message'))
                {{ Session::get('message') }}
            @endif
        </span>
        <h3>Nhập lại Email</h3>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
        <br>
        <button type="submit">Submit</button>
    </form>
    <form action="{{ route('login') }}">
        <button>Thoat</button>
    </form>
</body>

</html>
