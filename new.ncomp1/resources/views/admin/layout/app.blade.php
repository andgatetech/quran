<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
    :root {
        --primary-color: #ffffff;
        --secondary-color: #1a1a2e;
        --accent-color: #e94560;
        --hover-color: #0f3460;
    }

body{width: 100% !important;}
        .navbar {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            width: 100% !important;
            padding: 1.3rem 0;
        }


.navbar-brand{color: var(--primary-color);}




        .content {
            flex-grow: 1;
            padding: 20px;
            margin-left: 0;
        }

        .content.full-width {
            margin-left: 250px;
        }

        .navbar-toggler {
            color: var(--primary-color);
            border: none;
            font-size: 1.5rem;
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            border: none;
        }

        .btn-secondary:hover {
            background-color: var(--accent-color);
        }


    </style>
</head>
<body>
@include('admin.layout.navbar')

    {{-- <div class="sidenav-overlay" id="sidenavOverlay"></div> --}}

    {{-- <div class="d-flex"> --}}
        @include('admin.layout.sidenav')


        <div class="content" id="mainContent">
            @yield('content')
        </div>
    {{-- </div> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
</body>
</html>
