<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
$user = User::find(Auth::id());

?>



<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Competition</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="css/createcompetition.css">
  <style>



     .btn {
      font-size: .9rem !important;
      border-radius: .3rem !important;
      padding: .4rem 0 !important;
      border: 1px solid var(--secondary-color) !important;
      background-color: var(--secondary-color) !important;
      color: var(--primary-color) !important;
      cursor: pointer !important;
      text-align: center !important;
      margin: 5px !important;
    }


    .competition-form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .competition-form input {
      padding: 12px;
      font-size: 14px;
      border: 1px solid #ddd;
      border-radius: 10px;
      outline: none;
    }

    .competition-form .save-btn {
      background-color: var(--secondary-color);;
      color: var(--primary-color);
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .competition-form .save-btn:hover {
      background-color: var(--secondary-color);
    }



  </style>
</head>
<body>



    <header class="header">
        <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
        <h1>Add Competition</h1>
      </header>

      <div class="container1">
  <div class="tabs">

    <button class="tab-btn active "  onclick="window.location.href='{{ route('competition.create') }}'">Create Competition</button>
    <button class="tab-btn " onclick="window.location.href='{{ route('competition.list') }}'">Competition List</button>
  </div>
      </div>






  <div class="container">

    <!-- Form Section -->
    <div class="form-container">
        <form class="competition-form" method="POST" action="{{ route('competition.store') }}">
            @csrf
            @php

            @endphp
            <input type="text" name="main_name" placeholder="Competition Main Name" required>
            <input type="text" name="sub_name" placeholder="Competition Sub Name" required value="{{ $user->company_name }}" readonly>
            <button type="submit" class="btn btn-save">Save</button>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
  </div>


  @include('includes.footer')

</body>
</html>
