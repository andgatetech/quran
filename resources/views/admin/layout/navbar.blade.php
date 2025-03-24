<nav class="navbar navbar-expand-lg navbar-light" style="background-color: var(--secondary-color);">
    <div class="container-fluid">
    <div></div>
        <a class="navbar-brand" href="#">Admin Panel</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger nav-link text-white" style="border: none; background-color: transparent; font-weight: bold;">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

