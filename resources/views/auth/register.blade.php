<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <style>
    .register-form {
      margin: 0 auto;
      margin-top: 200px;
      max-width: 400px;
      padding: 20px;
      background-color: #f7f7f7;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <form class="register-form" action="/register" method="POST">
    @csrf
    <h2 class="text-center">Register</h2>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ old('name') }}">
      @error('name')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('email') }}">
      @error('email')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
      @error('password')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary btn-block">Register</button>
  </form>
  <script src="assets/css/bootstrap.min.js"></script>
</body>

</html>