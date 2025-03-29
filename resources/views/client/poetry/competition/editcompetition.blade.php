
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
      background-color:var(--secondary-color);;
    }



  </style>
</head>
<body>




  <div class="container">
    <!-- Header -->
    <header class="header">
        <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
        <h1>Create Competition</h1>
      </header>


    <!-- Tabs -->
    <div class="tabs">
      <button class="tab-btn">Create Competition</button>
      <button class="tab-btn" onclick="window.location.href='{{ route('competition.list') }}'">Competition List</button>
    </div>

    <!-- Form Section -->
    <div class="form-container">
        <form class="competition-form" method="POST" action="{{ route('competition.update') }}">
            @csrf
            <input type="text" name="main_name" placeholder="Competition Main Name" required value="{{ $competition->main_name }}">
            <input type="hidden" name="sub_name" placeholder="Competition Sub Name" required value="{{ $competition->sub_name }}">
            <button type="submit" class="btn save-btn">Save</button>
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
