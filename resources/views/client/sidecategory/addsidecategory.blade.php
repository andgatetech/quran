<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Side Category</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="css/CreateSideCategory.css">
</head>
<style>

.form-container {
box-shadow: none !important;
padding-bottom: 0 !important;
}
/* Side Category Form */
.side-category-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    width: 100%; /* Full width */
}

.side-category-form input {
    padding: 12px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 10px;
    outline: none;
    transition: border-color 0.3s ease-in-out;
    width: 100%; /* Full width */
}

.side-category-form input:focus {
    border-color: var(--secondary-color);; /* Highlight input on focus */
}

.side-category-form .save-btn {
    background-color: var(--secondary-color);;
    color: var(--primary-color);
    padding: 12px;
    font-size: 16px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
    width: 100%; /* Full width */
}

.side-category-form .save-btn:hover {
    background-color: #008f79;
}



</style>
<body>

    <header class="header">
        <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
        <h1>Create Side Category</h1>
      </header>

      {{-- <div class="container1"> --}}
  <div class="tabs">
    <button class="tab-btn active" onclick="window.location.href='{{ route('sidecategory.create') }}'">Create Side Category</button>
    <button class="tab-btn" onclick="window.location.href='{{ route('sidecategory.list') }}'">Side Category List</button>
  </div>
      {{-- </div> --}}

  <!-- Content Section -->
  <div class="container">


    <!-- Form Section -->
    <div class="form-container">
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form class="side-category-form" method="POST" action="{{ route('sidecategory.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Side Category Name" required>
        <button type="submit" class="btn save-btn">Save</button>
      </form>
    </div>
  </div>

  @include('includes.footer')


</body>
</html>
