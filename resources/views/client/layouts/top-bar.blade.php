<header class="header">
       <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
       <h1>{{ isset($moduleName) ? $moduleName : '' }}</h1>
        <div class="navbar">
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


  