<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Age Category</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
      min-height: 60vw;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }


    /* Main Content Styling */
    .container {
      width: 100%;
      max-width: 1000px;
      margin: 70px auto 0;
      padding: 20px;
      box-sizing: border-box;
    }


    .age-category-form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .age-category-form label {
      font-size: 16px;
      font-weight: bold;
      color: #333;
    }

    .age-category-form input {
      width: 100%;
      padding: 12px;
      font-size: 14px;
      border: 1px solid #ddd;
      border-radius: 10px;
      outline: none;
      transition: border-color 0.3s ease-in-out;
      background-color: #f9f9f9;
    }

    .age-category-form input:focus {
      border-color: var(--secondary-color);;
      background-color: var(--primary-color);
    }

    .age-category-form .save-btn {
      background-color: var(--secondary-color);;
      color: var(--primary-color);
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
      margin-top: 10px;
    }

    .age-category-form .save-btn:hover {
      background-color: #008f79;
    }


  </style>
</head>
<body>
  <!-- Header -->
  <header class="header">
    <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
    <h1>Create Age Category</h1>
  </header>

    <div class="tabs">
    <button class="tab-btn active"  onclick="window.location.href='{{ route('agecategory.create') }}'">Create Age Category</button>
    <button class="tab-btn " onclick="window.location.href='{{ route('agecategory.index') }}'">Age Category List</button>
    </div>


  <!-- Main Content -->
  <div class="container">


    <!-- Form Section -->
    <div class="form-container">

      <!-- Success Message -->
      @if (session('success'))
        <div>{{ session('success') }}</div>
      @endif

      <!-- Age Category Form -->
      <form method="POST" action="{{ route('agecategory.store') }}" class="age-category-form">
        @csrf
        {{-- <label for="name">Age Category</label> --}}
        <input type="text" id="name" name="name" placeholder="Age Category" required>

        <button type="submit" class="save-btn">Save</button>
      </form>
    </div>
  </div>



  @include('includes.footer')

</body>
</html>
