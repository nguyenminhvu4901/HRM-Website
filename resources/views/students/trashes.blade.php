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
    <h1>HOME</h1>
    <form action="{{ route('students.index') }}">
        <button type="submit">cut ra ngoai</button>
    </form>
    <form action="{{ route('students.restore') }}" method="GET">
        <Button type="submit">Restore All</Button>
    </form>
    <form action="{{ route('students.forceall') }}" method="POST">
        @csrf
        @method('DELETE')
        <Button type="submit">Delete All</Button>
    </form>
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
                <th scope="col">Delete</th>
                <th scope="col">Restore</th>
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
                        <form action="{{ route('students.force', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <Button type="submit">Delete</Button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('students.restore.one', ['id' => $item->id]) }}" method="GET">
                            <Button type="submit">Restore</Button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
