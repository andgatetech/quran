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
            /* Main Content */
    .main-content {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      padding: 20px;
    }

    /* Container */
    .container {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
    }

        .list-container {
            background-color: var(--primary-color);
            border-radius: 10px;
            /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); */
            padding: 1rem .5rem;
            max-height: 50rem;
            overflow-y: auto;
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
      background: white;
      margin: 10px auto;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      width: 40rem;
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
  display: none; /* Hide by default */
  justify-content: center;
  margin-top: 10px;
  text-align: center;
  align-items: center;
}

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
       .btn:hover {

        border: 1px solid var(--secondary-color) !important;
      background-color: var(--primary-color) !important;
      color: var(--secondary-color) !important;

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
<!-- top bar -->
@include('client.layouts.top-bar')

    <div class="tabs">
        <button class="tab-btn" onclick="window.location.href='{{ route('quran.pointcategory.create') }}'">Create Point Category</button>
        <button class="tab-btn active" onclick="window.location.href='{{ route('quran.pointcategory.list') }}'">Point Category List</button>
    </div>

    <div class="container">

        <div class="row">
        <div class="col-md-6 col-sm-12 offset-md-3">
        <div class="list-container">
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

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
                        <form action="{{ route('quran.pointcategory.delete', $pointCategory->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn delete-btn">Delete</button>
                        </form>
                        <a href="{{ route('quran.pointcategory.edit', $pointCategory->id) }}" class="btn edit-btn">Edit</a>

                    </div>
                </div>
            @endforeach

            @if ($pointCategories->isEmpty())
                <p>No point categories found. Click "Create Point Category" to add one.</p>
            @endif
        </div>
        </div>
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