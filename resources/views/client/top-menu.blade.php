<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Magey Competition - Menu</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  {{-- <link rel="stylesheet" href="css/menupage.css"> --}}
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
  }

  .container {
    min-width: 50%;
    max-width: 50rem;
    text-align: center;
    padding:1rem  !important;
  }



  /* Menu Buttons */
  .button-group {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }


  .btn {
    font-size: 18px;
    color: var(--secondary-color) !important;;
    background-color: var(--primary-color) !important;
    border: 2px solid var(--secondary-color) !important;;
    padding: 15px;
    border-radius: 1rem;
    cursor: pointer;
    transition: all 0.3s;
  }


  .btn:hover {
    background-color: var(--secondary-color) !important;;
    color: var(--primary-color) !important;
  }


</style>

<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .navbar {
            position: relative;
            display: flex;
            justify-content: flex-end;
            width: 100%;
            padding: 10px;
            
        }
        .profile {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #fff;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background: #fff;
            width: 150px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 5px;
            overflow: hidden;
        }
        .dropdown-menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            border-bottom: 1px solid #ddd;
        }
        .dropdown-menu a:last-child {
            border-bottom: none;
        }
        .dropdown-menu a:hover {
            background: #f4f4f4;
        }
        /*
        .profile:hover .dropdown-menu {
            display: block;
        }
        */
    </style>
<body>

<!-- top bar -->
    @include('client.layouts.top-bar')

  <div class="container">
    <!-- Menu Buttons -->
    <div class="button-group">
        <button class="btn" onclick="window.location.href='{{ route('client.menu.quran') }}'">Quran Competition</button>
        <button class="btn" onclick="window.location.href='{{ route('client.menu.poetry') }}'">Poetry Competition</button>
        <button class="btn btn-main" onclick="window.location.href='{{ route('client.menu.quiz') }}'">Quiz Competition</button>
        <button class="btn btn-main" onclick="window.location.href='{{ route('managecompitition.mageyPlan') }}'">How to Manage Competition</button>
    </div>
  </div>

  @include('includes.footer')
<script>
        function toggleDropdown() {
            var menu = document.getElementById("dropdownMenu");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }
        
        // Close dropdown when clicking outside
        document.addEventListener("click", function(event) {
            var profile = document.querySelector(".profile");
            var menu = document.getElementById("dropdownMenu");
            if (!profile.contains(event.target)) {
                menu.style.display = "none";
            }
        });
    </script>
</body>
</html>
