<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Product</h1>

        <form action="/products/{{ $product->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name123" value="{{ $product->name }}">
            </div>

            <div class="form-group">
                <label>Price:</label>
                <input type="text" name="price123" value="{{ $product->price }}">
            </div>

            <button type="submit" class="btn-submit">Update</button>
        </form>

        <br>
        <a href="/products">Back</a>
    </div>
</body>
</html> 