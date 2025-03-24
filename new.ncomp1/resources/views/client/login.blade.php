<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Magey Competition</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="css/login.css">
</head>
<style>

  /* Logo */
  .logo img {
    width: 80px;
    height: 80px;
    margin-bottom: 20px;
  }

  @media (min-width: 768px) {
    .logo img {
      width: 100px;
      height: 100px;
    }
  }


  /* Login Form */
  .login-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  .login-form input {
    width: 100%;
    padding: 12px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 10px;
    outline: none;
  }

  @media (min-width: 768px) {
    .login-form input {
      font-size: 16px;
      padding: 15px;
    }
  }

  .login-form .btn {
    background-color: #00bfa6;
    color: white;
    padding: 12px;
    font-size: 16px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .login-form .btn:hover {
    background-color: #008f79;
  }

  @media (min-width: 768px) {
    .login-form .btn {
      padding: 15px;
      font-size: 18px;
    }
  }


  .footer-content {
    font-size: 14px;
    color: #00bfa6;
  }

  @media (min-width: 768px) {
    .footer-content {
      font-size: 16px;
    }
  }


.container{height: fit-content !important;}
</style>
<body>
    
  <div class="container">
    <!-- Logo -->
    @include('includes.auth-header')



    <!-- Login Form -->
    <form class="login-form" method="POST" action="{{ route('client.login.submit') }}">
      @csrf
      <input type="email" name="email" placeholder="Email" required >
      <input type="password" name="password" placeholder="Password" required >
      <button type="submit" class="btn">Login</button>
    </form>

    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
  </div>

  @include('includes.footer')

</body>
</html>
