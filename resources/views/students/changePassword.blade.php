<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('students.update', ['id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="container">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value='{{ $item->name }}'>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value='{{ $item->email }}'>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">BirthDay</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate"
                    value='{{ $item->birthdate }}'>
            </div>
        </div>
    </form>
</body>

</html>
