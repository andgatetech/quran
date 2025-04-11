<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <title>Create Questions</title>
@include('includes.head')
@yield('styles')

</head>

<body>



            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success alert-custom animate__animated animate__fadeInDown" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Message -->
            @if (session('error'))
                <div class="alert alert-danger alert-custom animate__animated animate__fadeInDown" role="alert">
                    {{ session('error') }}
                </div>
            @endif

   @yield('content')




    @include('includes.footer')
@include('includes.scripts')
@yield('scripts')

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</html>
