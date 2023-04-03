<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
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
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Gender</label>
                <br>
                Male<input type="radio" id="description" name='gender' value="0"
                    {{ $item->gender == 0 ? 'checked' : '' }}>
                Female<input type="radio" id="description" name='gender' value="1"
                    {{ $item->gender == 1 ? 'checked' : '' }}>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Status</label>
                <br>
                @foreach ($arrStudentStatus as $key => $value)
                    <input type="radio" id="status" name='status' value="{{ $value }}"
                        {{ $item->status == $value ? 'checked' : '' }}>{{ $key }}
                @endforeach
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Course Name</label>
                <br>
                <select name="course_id">
                    @foreach ($courses as $c)
                        <option value="{{ $c->id }}" @if ($item->course_id === $c->id) selected @endif>
                            {{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Old Avatar</label>
                <img src='{{ asset("avatars/$item->avatar") }}' alt="" width="100">
                <input type="hidden" value="{{ $item->avatar }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Avatar</label>
                <input type="file" class="form-control" id="new_avatar" name="avatar">
            </div>
            <button type="submit">Edit</button>
    </form>
    <form action="{{ route('students.index') }}"><Button type="submit">Home</Button></form>
    </div>
</body>

</html>
