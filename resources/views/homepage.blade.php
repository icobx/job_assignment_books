<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="text-center">Kniznica</h1>
                </div>
            </div>
        </div>
    </header>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-center">formular</h2>
                </div>
            </div>
            <form class="row gy-4 gx-2" id="book-form" method="post" action="{{ route('book-store') }}">
                @csrf
                <div class="col-12">
                    <div class="test">
                        <label for="title" class="form-label mt-3">Názov knihy</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Vlastnou hlavou" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="test">
                        <label for="isbn" class="form-label mt-3">ISBN</label>
                        <input type="text" class="form-control" name="isbn" id="isbn" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label mt-3">Cena</label>
                    <input type="text" class="form-control" name="price" id="price" required>
                </div>
                <div class="col-md-6">
                    <label for="category_id" class="form-label mt-3">Kategória</label>
                    <select class="form-select form-control" name="category_id" aria-label="Default select example" required>
                        <option selected>Vyberte kategóriu</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="author" class="form-label mt-3">Autor</label>
                    <input type="text" class="form-control" name="author" id="author" data-autocomplete="{{ route('author-autocomplete') }}" autocomplete="off" required>
                </div>

                <div class="col-sm-6 offset-sm-6">
                    <button type="submit" class="btn btn-primary btn-block mt-4">Pridať knihu do knižnice</button>
                </div>
            </form>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-center">Knihy v kniznici</h2>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table" id="table">
                        <!-- data-toggle="table" data-sortable="true" data-detail-view-icon="false" -->
                        <thead>
                            <tr>
                                <th class="no-sort" scope="col">Nazov knihy</th>
                                <th class="no-sort" scope="col">ISBN</th>
                                <th scope="col">Cena</th>
                                <th class="no-sort" scope="col">Kategoria</th>
                                <th class="no-sort" scope="col">Autor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->isbn }}</td>
                                <td>{{ $book->price }} €</td>
                                <td>{{ $book->category->name }}</td>
                                <td>{{ $book->author->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/app.js') }}"></script>

</body>


<!-- <div class="row">
                <div class="col">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown button
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
            </div> -->

</html>