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
<body>
  <div class="container">
quran menu

    <!-- Menu Buttons -->
    <div class="button-group">
    <button class="btn" onclick="window.location.href='{{ route('competition.announce') }}'">To announce a
        competition</button>
      <button class="btn" onclick="window.location.href='{{ route('registrations.index') }}'">Applicants who applied to
        participate</button>
      <button class="btn btn-main"
        onclick="window.location.href='{{ route('competition.create') }}'">Competition</button>

      <button class="btn" onclick="window.location.href='{{ route('sidecategory.create') }}'">Recitation piece</button>

      <button class="btn" onclick="window.location.href='{{ route('readcategory.create') }}'">Method of
        recitation</button>

      <button class="btn" onclick="window.location.href='{{ route('agecategory.create') }}'">Age Category</button>

      <button class="btn" onclick="window.location.href='{{ route('pointcategory.create') }}'">Scoring method</button>
      <button class="btn" onclick="window.location.href='{{ route('judges.create') }}'">Judge</button>
      <button class="btn" onclick="window.location.href='{{ route('questions.create') }}'">Questions</button>
      <button class="btn" onclick="window.location.href='{{ route('competitors.create') }}'">Participants</button>
      <button class="btn" onclick="window.location.href='{{ route('sponsors.create') }}'">Sponsors</button>
      <button class="btn" onclick="window.location.href='{{ route('host.create') }}'">To start the competition </button>

      <!-- new buttons -->
      <button class="btn" onclick="window.location.href='{{ route('managenertificate.create') }}'">To award
        certificates</button>
      <button class="btn" onclick="window.location.href='{{ url('') }}'">To create the curriculum</button>
      <button class="btn" onclick="window.location.href='{{ route('report.index') }}'">Report</button>
      <button class="btn" onclick="window.location.href='{{ route('curriculum.create') }}'">Curriculum</button>



    </div>
  </div>

  @include('includes.footer')

</body>
</html>
