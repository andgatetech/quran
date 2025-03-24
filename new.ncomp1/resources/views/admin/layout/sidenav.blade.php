<style>
    *{box-sizing: border-box}


    .sidenav {
        background: linear-gradient(180deg, var(--secondary-color), #16213e);
        color: var(--primary-color);
        height: 100vh;
        position: fixed;
        width: 22rem;
        top: 0;
        left: 0;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.4);
        transform: translateX(-100%);
        transition: transform 0.4s ease-in-out;
        z-index: 1050;
        font-family: 'Poppins', sans-serif;
    }

    .sidenav.open {
        transform: translateX(0);
    }

    .sidenav h4 {
        text-align: center;
        font-size: 1.8rem;
        font-weight: 700;
        padding: 1.5rem 0;
        margin: 0;
        color: var(--accent-color);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .sidenav ul {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .sidenav ul li {
        margin: 1rem 0;
    }

    .sidenav ul li a {
        display: block;
        padding: 0.8rem 2rem;
        color: var(--primary-color);
        text-decoration: none;
        font-size: 1.2rem;
        font-weight: 500;
        border-radius: 8px;
        transition: background 0.3s, color 0.3s, transform 0.3s;
    }
    .sidenav ul li {padding:0 2rem;}

    .sidenav ul li a:hover {
        background: var(--hover-color);
        color: var(--accent-color);
        transform: translateX(10px);
    }

    .sidenav ul li a.active {
        background: var(--accent-color);
        color: var(--primary-color);
    }

    .sidenav-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 1049;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out;
    }

    .sidenav-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .sidenav-toggler {
        position: fixed;
        top: 1rem;
        left: 1rem;
        background: var(--accent-color);
        color: var(--primary-color);
        border: none;
        border-radius: 50%;
        width: 3rem;
        height: 3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 1060;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .sidenav-toggler:hover {
        background: #ff3366;
    }

    form {
        margin-top: auto;
        padding: 1.5rem 2rem;
    }

    .sidenav button {
        background: var(--accent-color);
        border: none;
        color: var(--primary-color);
        padding: 0.8rem 1.5rem;
        font-size: 1.1rem;
        font-weight: bold;
        border-radius: 6px;
        width: 100%;
        cursor: pointer;
        transition: background 0.3s;
    }

    .sidenav button:hover {
        background: #ff3366;
    }

    @media (min-width: 768px) {
        .sidenav {
            transform: translateX(0);
            width: 250px;
        }

        .content {
            margin-left: 250px;
        }

        .sidenav-overlay {
            display: none;
        }

        .sidenav-toggler {
            display: none;
        }
    }
</style>

<div class="sidenav-toggler" id="sidenavToggle">
    &#9776;
</div>

<div class="sidenav" id="sidenav">
    <h4>Menu</h4>
    <ul>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('users.create') }}" class="{{ request()->routeIs('users.create') ? 'active' : '' }}">
                Create User
            </a>
        </li>
        <li>
            <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                User List
            </a>
        </li>
    </ul>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>

<div class="sidenav-overlay" id="sidenavOverlay"></div>

<script>
    const sidenavToggle = document.getElementById('sidenavToggle');
    const sidenav = document.getElementById('sidenav');
    const sidenavOverlay = document.getElementById('sidenavOverlay');

    sidenavToggle.addEventListener('click', () => {
        sidenav.classList.toggle('open');
        sidenavOverlay.classList.toggle('show');
    });

    sidenavOverlay.addEventListener('click', () => {
        sidenav.classList.remove('open');
        sidenavOverlay.classList.remove('show');
    });
</script>
