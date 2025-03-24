<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Magey Competition</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="icon" href="{{ asset('public/assets/img/logo.png') }}">
</head>
<style>
    /* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }


  /* Container */
  .container {
    min-width: 50%;
    max-width: 50rem;
    text-align: center;
    padding:1rem  !important;
  }


  /* Button Group */
  .button-group {
    display: flex;
    flex-direction: column;
    gap: 15px; /* Increased gap between buttons */
  }

  .btn {
    font-size: 18px;
    color: var(--secondary-color);;
    background-color: var(--primary-color);
    border: 2px solid var(--secondary-color);;
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
<body>
  <div class="container">
    <!-- Header -->
   {{-- @include('includes.welcome-head') --}}

    <div class="button-group">

      <button class="btn active" onclick="window.location.href='{{ route('client.login') }}'">Client Panel</button>
      <button class="btn"  onclick="window.location.href='{{ route('calling.login') }}'">Calling Screen</button>
      <button class="btn"  onclick="window.location.href='{{ route('announcement.login') }}'">Announcement Screen</button>
      <button class="btn" onclick="window.location.href='{{ route('number.login') }}'">Number Screen</button>
      <button class="btn" onclick="window.location.href='{{ route('judges.login') }}'">Judge Panel</button>
      <button class="btn" onclick="window.location.href='{{ route('showquestion.login') }}'">Competitor Screen for Host</button>
      <button class="btn" onclick="window.location.href='{{ route('showquestion.user.login') }}'">Competitor Screen for Competitor</button>
      <button class="btn" onclick="window.location.href='{{ route('winning.login') }}'" >Winner Announce Confirmation</button>
    </div>
  </div>

@include('includes.footer')
</body>
</html>
