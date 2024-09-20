<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('tags.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="">usuario</label>
        <input name="name" type="text" value="{{ $user->name }}">
        <label for="">email</label>
        <input  name="email" type="email" value="{{ $user->email }}">
        <button type="submit">Actualizar</button>
    </form>
</body>

</html>
