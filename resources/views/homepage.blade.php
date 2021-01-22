<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>📖 Knižnica</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="text-center header__title">Knižnica</h1>
                </div>
            </div>
        </div>
    </header>
    <section class="section section--form">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-center section__title">Nová kniha</h2>
                </div>
            </div>
            <form class="row gy-4 gx-2" id="book-form" method="post" action="{{ route('book-store') }}">
                @csrf
                <div class="col-12">
                    <label for="title" class="form-label mt-3">Názov knihy</label>
                    <input type="text" class="form-control form-control-lg" name="title" id="title" placeholder="Vlastnou hlavou" required>
                </div>
                <div class="col-md-6">
                    <label for="isbn" class="form-label mt-3">ISBN</label>
                    <input type="text" class="form-control form-control-lg" name="isbn" id="isbn" validIsbn="true" placeholder="9788081594410" required>
                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label mt-3">Cena</label>
                    <input type=number class="form-control form-control-lg" name="price" id="price" step="0.01" min=0 placeholder="11,05" required>
                </div>
                <div class="col-md-6">
                    <label for="category_id" class="form-label mt-3">Kategória</label>
                    <select class="form-select form-control form-control-lg" name="category_id" required>
                        <option disabled selected value>Vyberte kategóriu</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="author" class="form-label mt-3">Autor</label>
                    <input type="text" class="form-control form-control-lg" name="author" id="author" data-autocomplete="{{ route('author-autocomplete') }}" autocomplete="off" placeholder="Marek Vagovič" required>
                </div>

                <div class="col-sm-6 offset-sm-6">
                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-4 button-accent">Pridať knihu do knižnice</button>
                </div>
            </form>
        </div>
    </section>
    <section class="section section--table">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-center section__title">Knihy v knižnici</h2>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-wrapper">
                        <table class="table" id="table">
                            <thead class="table__head">
                                <tr>
                                    <th class="no-sort" scope="col">Názov knihy</th>
                                    <th class="no-sort" scope="col">ISBN</th>
                                    <th scope="col">Cena</th>
                                    <th class="no-sort" scope="col">Kategória</th>
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
        </div>
    </section>

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>