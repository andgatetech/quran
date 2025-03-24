<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Magey Competition</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="css/login.css">
</head>
<style>
    /* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  /* Body Styling */
   body {
position:relative;

    background-color: #f9f9f9;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 60vw;
    padding: 10px; /* For proper spacing on smaller devices */
  }

  /* Container */
  .container {
    width: 100%;
    max-width: 400px; /* Responsive max width */
    text-align: center;
    padding: 20px;
  }

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
    background-color: var(--secondary-color);;
    color: var(--primary-color);
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



</style>
<body>
  <div class="container">
    <!-- Logo -->
    @include('includes.auth-header')



    <form class="login-form" method="POST" action="{{ route('winning.login.submit') }}">
        @csrf
        <input type="text" name="host_id" placeholder="Enter Host ID" required>
        <input type="password" name="password" placeholder="Password" required>
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
  <style>
    /* Body Styling */
body {

  background-color: #f9f9f9;
  display: flex;
  flex-direction: column;
  min-height: 100vh; /* Ensure body takes full height of the screen */
  padding: 0; /* Remove default padding */
}

/* Container Styling */
.container {
  flex-grow: 1; /* Allow the content to expand and fill available space */
  padding-bottom: 100px; /* Add space at the bottom for footer */
}

/* Footer Styling */
footer {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  /* background-color: #f1f1f1; Footer background color */
  padding: 10px;
  text-align: center;
  margin-bottom: 10px; /* Margin above the footer */
}

  </style>
  @include('includes.footer')

</body>
</html>
