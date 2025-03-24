<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Point Category</title>
    <style>


        .main-content {
            flex-grow: 1;
            padding: 1rem;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            max-height: 20rem;
        }

        .button-group {
            display: flex;
            margin-bottom: 20px;
        }

        .button-group button {
            flex: 1;
            border-radius: 30px;
            padding: 10px;
            border: 2px solid var(--secondary-color);
            font-size: 16px;
            cursor: pointer;
        }

        .active-button {
            background-color: var(--secondary-color);
            color: #ffffff;
        }

        .inactive-button {
            background-color: #ffffff;
            color: var(--secondary-color);
        }

        .form-container {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #e1e4e8;
            border-radius: 5px;
            font-size: 16px;
        }

        .save-btn {
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


    </style>
</head>
<body>




    <header class="header">
        <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
        <h1>Create Point Category</h1>
    </header>

      <div class="container1">
  <div class="tabs">
    <button class="tab-btn active"  onclick="window.location.href='{{ route('pointcategory.create') }}'">Create Point Category</button>
    <button class="tab-btn " onclick="window.location.href='{{ route('pointcategory.list') }}'">Point Category List</button>
  </div>
      </div>











    <div class="wrapper">

        <div class="main-content">

            <div class="form-container">
                <form method="POST" action="{{ route('pointcategory.store') }}">
                    @csrf
                    <input type="text" name="name" placeholder="Point Category Name" required>
                    <input type="number" name="total_points" placeholder="Total Points" required>
                    <input type="number" step="0.01" name="deduction_amount" placeholder="Deduction Amount Per Click" required>
                    <button type="submit" class="btn save-btn">Save</button>
                </form>
            </div>
        </div>

    </div>
    @include('includes.footer')

</body>
</html>
