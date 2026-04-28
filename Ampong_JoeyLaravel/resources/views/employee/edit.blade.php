<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Employee</h1>

        <form action="/employees/{{ $employee->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>First Name:</label>
                <input type="text" name="FirstName" value="{{ $employee->FirstName }}">
            </div>

            <div class="form-group">
                <label>Last Name:</label>
                <input type="text" name="LastName" value="{{ $employee->LastName }}">
            </div>

            <div class="form-group">
                <label>Job:</label>
                <input type="text" name="Job" value="{{ $employee->Job }}">
            </div>

            <div class="form-group">
                <label>Salary:</label>
                <input type="text" name="Salary" value="{{ $employee->Salary }}">
            </div>

            <button type="submit" class="btn-submit">Update</button>
        </form>

        <br>
        <a href="/employees">Back</a>
    </div>
</body>
</html>