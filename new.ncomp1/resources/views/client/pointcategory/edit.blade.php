<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Point Category</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

         body {
position:relative;
            background-color: #f7f8fa;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            min-height: 60vw;
        }

        .header {
            width: 100%;
            background-color: var(--secondary-color);
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .back-button {
            background: none;
            border: none;
            font-size: 24px;
            color: #fff;
            cursor: pointer;
        }

        .header h1 {
            font-size: 24px;
            color: #fff;
            font-weight: 500;
            text-align: center;
            flex: 1; /* Center the heading */
        }

        .button-group {
            display: flex;
            margin-top: 20px;
            gap: 20px;
            width: 100%;
            justify-content: center; /* Center buttons horizontally */
        }

        .button-group button {
            flex: 1;
            border-radius: 30px;
            padding: 10px;
            border: 2px solid var(--secondary-color);
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .active-button {
            background-color: var(--secondary-color);
            color: #ffffff;
        }

        .inactive-button {
            background-color: #ffffff;
            color: var(--secondary-color);
        }

        .main-content {
            flex-grow: 1; /* This makes the content area take up the remaining space */
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #e1e4e8;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container button {
            width: 100%;
            background-color: var(--secondary-color);
            color: #ffffff;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .footer-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 12px;
            color: #fff;
        }

        .footer-logo {
            height: 25px;
            width: 25px;
        }
    </style>
</head>
<body>

    <header class="header">
        <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
        <h1>Point Category Edit</h1>
    </header>

      <div class="container1">
  <div class="tabs">
    <button class="tab-btn "  onclick="window.location.href='{{ route('pointcategory.create') }}'">Create Point Category</button>
    <button class="tab-btn " onclick="window.location.href='{{ route('pointcategory.list') }}'">Point Category List</button>
  </div>
      </div>

    <div class="main-content">
        <div class="form-container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('pointcategory.update') }}">
                @csrf
                <div>
                    <label for="name">Point Category Name</label>
                    <input type="text" id="name" name="name" value="{{ $pointCategory->name }}" required>
                </div>
                <div>
                    <label for="total_points">Total Points</label>
                    <input type="number" id="total_points" name="total_points" value="{{ $pointCategory->total_points }}" required>
                </div>
                <div>
                    <label for="deduction_amount">Deduction Amount</label>
                    <input type="number" step="0.01" id="deduction_amount" name="deduction_amount" value="{{ $pointCategory->deduction_amount }}" required>
                </div>
                <button type="submit">Update</button>
            </form>
        </div>
    </div>

    @include('includes.footer')


</body>
</html>
