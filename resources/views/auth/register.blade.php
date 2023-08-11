<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <form action="/register" class="register-form" method="post">
          @csrf
          <h2 class="text-center" style="margin-bottom: 30px;">Register</h2>
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
            <label for="password">Password</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" required placeholder="Masukan Password">
              <span class="input-group-addon">
                <i class="bi bi-eye show_password"></i>
              </span>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Register</button>
          <a href="/login" type="submit" class="btn btn-info btn-block">Ke Menu Login</a>
        </form>
      </div>
    </div>
  </div>
  <script src="assets/css/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      // Show/hide password functionality
      $(".show_password").click(function() {
        var passwordField = $("#password");
        if (passwordField.attr("type") === "password") {
          passwordField.attr("type", "text");
        } else {
          passwordField.attr("type", "password");
        }
      });
    });
  </script>
</body>

</html>