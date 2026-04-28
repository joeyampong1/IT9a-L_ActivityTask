<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container">
    <h1>Books</h1>

    <form action="{{ route('books.store') }}" method="POST" class="product-form">
        @csrf

        <div class="form-group">
            <label for="book_name">Book Name:</label>
            <input type="text" name="book_name" id="book_name" required>
        </div>

        <div class="form-group">
            <label for="book_author">Author Name:</label>
            <input type="text" name="book_author" id="book_author" required>
        </div>

        <div class="form-group">
            <label for="book_stock">Book Stock:</label>
            <input type="number" name="book_stock" id="book_stock" required>
        </div>

        <div class="form-group">
            <label for="book_date">Date:</label>
            <input type="date" name="book_date" id="book_date" required>
        </div>

        <button type="submit" class="btn-submit">Save</button>
    </form>

    <hr>

    <table class="product-table">
        <thead>
             <tr>
                <th>ID</th>
                <th>Book Name</th>
                <th>Author Name</th>
                <th>Book Stock</th>
                <th>Book Date</th>
                <th>Action</th>
              </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->book_name }}</td>
                <td>{{ $book->book_author }}</td>
                <td>{{ $book->book_stock }}</td>
                <td>{{ $book->book_date }}</td>
                <td>
                    <a href="{{ route('books.edit', $book->id) }}">
                        <button type="button">Edit</button>
                    </a>

                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>