<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">


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

</html>
