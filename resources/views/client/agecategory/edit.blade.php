<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Age Category</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="css/EditAgeCategory.css">
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
  padding: 10px;
  text-align: center;
}

/* Header Styling (Full Width) */
.header {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: var(--secondary-color);;
  color: var(--primary-color);
  padding: 15px 20px;
  border-radius: 10px;
  margin-bottom: 20px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  width: 100%; /* Full width */
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1000;
}

/* Header Title */
.header h1 {
  font-size: 18px;
  text-align: center;
}

/* Back Button */
.back-btn {
  background: none;
  border: none;
  color: var(--primary-color);
  font-size: 18px;
  cursor: pointer;
  position: absolute;
  left: 15px;
  top: 50%;
  transform: translateY(-50%);
}

/* Tabs Styling */
.tabs {
  display: flex;
  justify-content: space-around;
  margin-top: 80px; /* Account for fixed header */
  margin-bottom: 20px;
}

.tab-btn {
  font-size: 14px;
  padding: 10px 15px;
  border-radius: 20px;
  border: 2px solid var(--secondary-color);;
  background-color: var(--primary-color);
  color: var(--secondary-color);;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
}

.tab-btn.active {
  background-color: var(--secondary-color);;
  color: var(--primary-color);
}

.tab-btn:hover {
  background-color: #008f79;
  color: var(--primary-color);
}

/* Content Container */
.container {
  width: 100%; /* Full width for container */
  max-width: 1000px; /* Retain max-width for content area */
  margin: 0 auto;
  flex-grow: 1;
  padding: 20px;
}

/* Form Container */
.form-container {
  background-color: var(--primary-color);
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin-bottom: 30px;
}

/* Form Styling */
.age-category-form {
  display: flex;
  flex-direction: column;
  gap: 15px;
  align-items: center;
}

.age-category-form input {
  width: 100%;
  padding: 12px;
  font-size: 14px;
  border: 1px solid #ddd;
  border-radius: 10px;
  outline: none;
  transition: border-color 0.3s ease-in-out;
}

.age-category-form input:focus {
  border-color: var(--secondary-color);;
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
}

.age-category-form .save-btn:hover {
  background-color: #008f79;
}



  </style>
</head>
<body>
  <!-- Header -->
  <header class="header">
    <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
    <h1>Edit Age Category</h1>
  </header>

  <!-- Container -->
  <div class="container">
    <!-- Tabs -->
    <div class="tabs">
      <button class="tab-btn" onclick="window.location.href='{{ route('agecategory.create') }}'">Create Age Category</button>
      <button class="tab-btn active">Edit Age Category</button>
    </div>

    <!-- Form Section -->
    <div class="form-container">
      @if (session('success'))
        <div>{{ session('success') }}</div>
      @endif

      <form method="POST" action="{{ route('agecategory.update') }}" class="age-category-form">
        @csrf
        <label for="name">Age Category</label>
        <input type="text" id="name" name="name" value="{{ $ageCategory->name }}" placeholder="Age Category" required>
        <button type="submit" class="save-btn">Save</button>
      </form>
    </div>
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
  margin-bottom: 90px; /* Add space at the bottom for footer */
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
