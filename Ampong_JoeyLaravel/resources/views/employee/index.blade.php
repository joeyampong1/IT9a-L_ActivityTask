<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employees</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

<div class="container">
  <h1>Employees</h1>

  <form action="/employees" method="POST" class="product-form">
    @csrf
    
    <div class="form-group">
      <label for="FirstName">First Name:</label>
      <input type="text" name="FirstName">
    </div>

    <div class="form-group">
      <label for="LastName">Last Name:</label>
      <input type="text" name="LastName">
    </div>

    <div class="form-group">
      <label for="Job">Job:</label>
      <input type="text" name="Job">
    </div>

    <div class="form-group">
      <label for="Salary">Salary:</label>
      <input type="text" name="Salary">
    </div>

    <button type="submit" class="btn-submit">Save</button>
  </form>

  <hr>

  <table class="product-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Job</th>
        <th>Salary</th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody>
      @foreach($items as $item)
      <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->FirstName }}</td>
        <td>{{ $item->LastName }}</td>
        <td>{{ $item->Job }}</td>
        <td>{{ $item->Salary }}</td>
        <td>
            <a href="{{ route('employees.edit', $item->id) }}">
            <button type="button">Edit</button>
            </a>

            <form action="/employees/{{ $item->id }}" method="POST" style="display:inline;">
                 @csrf
                 @method('DELETE')
                 <button type="submit">Delete</button>
            </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

</div>

</body>
</html>