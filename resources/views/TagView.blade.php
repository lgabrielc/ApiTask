<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Pruebita</title>
</head>

<body>
    <table class="table-auto">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <div class="bg-red-400 border border-rounded px-2 py-1" for="">{{ $user->name }}</div>
                    </td>
                    <td>
                        <div class="bg-red-400 border border-rounded px-2 py-1" for="">{{ $user->email }}</div>
                    </td>
                    <td>
                        <div>
                            <form action="{{ route('tags.edit', $user->id) }}" method="get">
                                <button>Edit</button>
                            </form>

                        </div>
                        <div>
                            <form action="{{ route('tags.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button>Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
