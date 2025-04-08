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
        .header h1 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 500;
        }
        /*
        .profile:hover .dropdown-menu {
            display: block;
        }
        */
    </style>
<header class="header">
    @if(isset($moduleName))
    @switch($moduleName)
        @case('Quran')
            <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
            @break
        @case('Poetry')
            <a class="back-btn" href="{{ route('client.menu.poetry') }}"><i class="fas fa-home"></i></a>
            @break    
    
        @default
            <a class="back-btn" href="{{ url()->previous() }}"><i class="fas fa-home"></i></a>
            @break
            
    @endswitch
    @else
    <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
    @endif
       
        <div class="navbar">
        <h1>{{ isset($moduleName) ? $moduleName : 'Menu' }}  {{ isset($actionName) ? ' : '.$actionName : ''}}</h1>
          <div class="profile" onclick="toggleDropdown()">
          <i class="fa fa-user-circle"></i>
              <!-- <img src="https://via.placeholder.com/40" alt="Profile"> -->
              <div class="dropdown-menu" id="dropdownMenu">
                  <a href="#">Profile</a>
                  <a href="{{ route('client.logout') }}">Logout</a>
              </div>
          </div>
      </div>
    
  </header>
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





  