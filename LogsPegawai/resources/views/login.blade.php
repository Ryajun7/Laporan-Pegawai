<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5"> <div class="row justify-content-center">
      <div class="col-md-6">
        <h1 class="text-center mb-4">Login</h1>
        @if ($errors->has('login'))
          <div class="alert alert-danger">
            {{ $errors->first('login') }}
          </div>
        @endif
        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
        <form method="POST" action="/" class="card p-3">
          @csrf
          <div class="mb-3">
            <label for="nip_email" class="form-label">NIP/Email</label>
            <input type="text" name="NIP" id="nip_email" class="form-control" placeholder="Enter NIP or Email" required value="{{ old('NIP') }}">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">Remember Me</label>
          </div>
          <button type="submit" class="btn btn-success mt-3">Login</button>
        </form>
        <br>
        <p class="text-center">Belum punya akun? <a href="/register">Register</a></p>
      </div>
    </div>
  </div>
</body>
</html>
