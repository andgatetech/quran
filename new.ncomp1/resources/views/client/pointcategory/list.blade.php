<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point Category List</title>
    <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {

            background-color: #f9f9f9;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            /* padding: 10px; */
        }


        .content {
            width: 90%;
            margin: 20px auto;
            /* padding: 20px; */
        }

        .list-container {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .list-title {
            background: var(--secondary-color);
            color: var(--primary-color);
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .category-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 15px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .card-header p {
            font-size: 16px;
            color: #333;
            margin: 0;
        }

        .card-header span {
            color: var(--secondary-color);
            font-weight: bold;
        }

        .details {
            display: none;
            margin-top: 10px;
            font-size: 14px;
        }

        .details p {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }

        .details p span {
            font-weight: bold;
            color: var(--secondary-color);
        }

        .card-actions {
            display: none;
            justify-content: space-around;
            margin-top: 15px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }

        .delete-btn {
            background: #e74c3c;
            color: #fff;
        }

        .delete-btn:hover {
            background: #c0392b;
        }

        .edit-btn {
            background: #2ecc71;
            color: #fff;
        }

        .edit-btn:hover {
            background: #27ae60;
        }

        .card-header i {
            color: #888;
            margin-left: 10px;
            transition: transform 0.3s;
        }

        .card-header.open i {
            transform: rotate(180deg);
        }
        .card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.card-header p {
  font-size: 14px;
  display: flex;
  justify-content: space-between;
  width: 100%; /* Ensures the text spans the width */
}

.card-header span {
  color: var(--secondary-color);
  font-weight: bold;
  margin-left: auto; /* Pushes span to the right */
}

.card-header i {
  color: #888;
  cursor: pointer;
  margin-left: 8px; /* Add some spacing between the text and the icon */
}





    </style>
</head>

<body>
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<header class="header">
    <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
    <h1>Point Category List</h1>
</header>
    <div class="tabs">
        <button class="tab-btn" onclick="window.location.href='{{ route('pointcategory.create') }}'">Create Point Category</button>
        <button class="tab-btn active" onclick="window.location.href='{{ route('pointcategory.list') }}'">Point Category List</button>
    </div>

    <div class="content">
        <div class="list-container">


            {{-- <h2 class="list-title">Point Category List</h2> --}}
            @foreach ($pointCategories as $pointCategory)
                <div class="category-card">
                    <div class="card-header" onclick="toggleDetails(this)">
                        <p>Point Category: <span>{{ $pointCategory->name }}                        <i class="fas fa-chevron-down"></i>
                        </span></p>
                    </div>
                    <div class="details">







                        <p>
                            Total Number of Points:
                            <span>{{ $pointCategory->total_points }}</span>
                        </p>
                        <p>
                            Deduction Amount per Click:
                            <span>{{ $pointCategory->deduction_amount }}</span>
                        </p>
                    </div>
                    <div class="card-actions">
                        <form action="{{ route('pointcategory.delete', $pointCategory->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn delete-btn">Delete</button>
                        </form>
                        <form action="{{ route('pointcategory.setSession') }}" method="POST">
                            @csrf
                            <input type="hidden" name="point_category_id" value="{{ $pointCategory->id }}">
                            <button type="submit" class="btn edit-btn">Edit</button>
                        </form>

                    </div>
                </div>
            @endforeach

            @if ($pointCategories->isEmpty())
                <p>No point categories found. Click "Create Point Category" to add one.</p>
            @endif
        </div>
    </div>

    <style>
/* Body Styling */

/* Main Content Styling */
.content {
  width: 90%;
  margin: 0 auto; /* Center content */
  flex-grow: 1; /* Allow content to grow and fill space */
  margin-bottom: 170px;
}

/* Footer Styling */
footer {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  background-color: #f1f1f1; /* Footer background color */
  padding: 10px;
  text-align: center;
 /* Ensure footer stays on top of content */
}



      </style>
      @include('includes.footer')
    <script>
        function toggleDetails(element) {
            const card = element.parentElement;
            const details = card.querySelector('.details');
            const actions = card.querySelector('.card-actions');
            const icon = element.querySelector('i');

            if (details.style.display === 'none' || !details.style.display) {
                details.style.display = 'block';
                actions.style.display = 'flex';
                icon.style.transform = 'rotate(180deg)';
            } else {
                details.style.display = 'none';
                actions.style.display = 'none';
                icon.style.transform = 'rotate(0deg)';
            }
        }

        window.onload = function () {
            const details = document.querySelectorAll('.details');
            const actions = document.querySelectorAll('.card-actions');

            details.forEach((detail) => (detail.style.display = 'none'));
            actions.forEach((action) => (action.style.display = 'none'));
        };
    </script>
</body>

</html>
