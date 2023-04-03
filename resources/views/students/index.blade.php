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
    <h3>Xin chao {{ session()->get('name') }}</h3>
    {{-- @foreach ($value as $a)
        <h3>Test{{ $a }}</h3>
    @endforeach --}}

    <h3>Day la cua {{ session()->get('name') }}</h3>
    <h1>HOME</h1>
    <span style="color: #f44336">
        @if (Session::has('message'))
            {{ Session::get('message') }}
            <br>
        @endif
    </span>
    <span style="color: #f44336">
        @if (Session::has('message1'))
            {{ Session::get('message1') }}
            <br>
        @endif
    </span>
    @if (session()->get('level') === 0 || checkSuperAdmin())
        <form action="{{ route('students.create') }}"><Button type="submit">Add Student</Button></form>
    @endif
    @if (session()->get('level') === 1)
        <form action="{{ route('students.trashed') }}"><Button type="submit">Trash</Button></form>
    @endif
    <form action="{{ route('students.logout') }}"><Button>Dang xuat</Button></form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Birthdate</th>
                <th scope="col">Gender</th>
                <th scope="col">Status</th>
                <th scope="col">Course Name</th>
                <th scope="col">Avatar</th>
                <th scope="col">Created</th>
                <th scope="col">Detail</th>
                @if (checkAdmin() || checkSuperAdmin())
                    <th scope="col">Update</th>
                @endif
                @if (checkSuperAdmin())
                    <th scope="col">Delete</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->birthdate }}</td>
                    <td>{{ $item->gender($item->gender) }}</td>
                    <td>{{ $item->getStatus($item->status) }}</td>
                    <td>{{ $item->course->name }}</td>
                    <td><img src='{{ asset("avatars/$item->avatar") }}' alt="" width="100"></td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <form action="{{ route('students.show', ['id' => $item->id]) }}"><Button
                                type="submit">Detail</Button></form>
                    </td>
                    @if (checkAdmin() || checkSuperAdmin())
                        <td>
                            <form action="{{ route('students.edit', ['id' => $item->id]) }}"><Button
                                    type="submit">Update</Button></form>
                        </td>
                    @endif
                    @if (checkSuperAdmin())
                        <td>
                            <form action="{{ route('students.destroy', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <Button type="submit">Delete</Button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
