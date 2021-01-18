<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>ahoj</h3>
    <ul>
        @foreach($books as $book)
        <li>{{ $book->title }}</li>
        @endforeach
    </ul>
</body>

</html>