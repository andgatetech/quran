<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announce Competition</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/createrecotationpiece.css">
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


        .recitation-piece-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .recitation-piece-form input {
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 10px;
            outline: none;
        }

        .recitation-piece-form .save-btn {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .recitation-piece-form .save-btn:hover {
            background-color: var(--secondary-color);
        }
    </style>


<body>

<!-- top bar -->
@include('client.layouts.top-bar')

    <div class="container1">
        <div class="tabs">
        <button class="tab-btn active" onclick="window.location.href='{{ route('quran.recitation.piece.create') }}'">Create Recitation Piece</button>
        <button class="tab-btn" onclick="window.location.href='{{ route('quran.recitation.piece.list') }}'">Recitation Piece List</button>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 offset-md-3">
        <!-- Form Section -->
        <div class="form-container">
          @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
        
          <form class="recitation-piece-form" method="POST" action="{{ route('quran.recitation.piece.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Recitation Piece" required>
            <button type="submit" class="btn save-btn">Save</button>
          </form>
        </div>
            </div>
        </div>
        <!-- Form Section -->
    </div>

    @include('includes.footer')

</body>
</html>
