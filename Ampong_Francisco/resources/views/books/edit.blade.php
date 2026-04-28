<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{  asset('css/style.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
</head>
<body>

<div class="container">
    <h1>Edit Book</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST" class="product-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="book_name">Book Name:</label>
            <input type="text" name="book_name" id="book_name" value="{{ old('book_name', $book->book_name) }}" required>
        </div>

        <div class="form-group">
            <label for="book_author">Author Name:</label>
            <input type="text" name="book_author" id="book_author" value="{{ old('book_author', $book->book_author) }}" required>
        </div>

        <div class="form-group">
            <label for="book_stock">Book Stock:</label>
            <input type="number" name="book_stock" id="book_stock" value="{{ old('book_stock', $book->book_stock) }}" required>
        </div>

        <div class="form-group">
            <label for="book_date">Date:</label>
            <input type="date" name="book_date" id="book_date" value="{{ old('book_date', $book->book_date) }}" required>
        </div>

        <button type="submit" class="btn-submit">Update</button>
        <a href="{{ route('books.index') }}" class="btn-cancel">Cancel</a>
    </form>
</div>

</body>
</html>