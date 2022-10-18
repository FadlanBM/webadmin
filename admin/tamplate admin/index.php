<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.104.2">
  <title>Signin Template · Bootstrap v5.2</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="assets/dist/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">

  <main class="form-signin w-100 m-auto">
    <form method="POST" action="cek_login.php">
      <img class="mb-4" src="assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
      <h1 class="h3 mb-3 fw-normal">sign in Admin</h1>

      <div class="form-floating mb-2">
        <input type="text" name="username" class="form-control" placeholder="Username">
        <label>Username</label>
      </div>
      <div class="form-floating mb-2">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <label>Password</label>
      </div>

      <label class="form-label">Masuk Sebagai</label>
              <select class="form-select " name="level">
                <option value="">--Pilih--</option>
                <option value="guru">Guru</option>
                <option value="admin">Admin</option>
              </select>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; Copyright By WebTKJ <?= date('Y')?></p>
    </form>
  </main>



</body>

</html>