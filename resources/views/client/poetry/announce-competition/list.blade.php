<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Competition List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="css/CompetitionList.css">
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
       .btn:hover {

        border: 1px solid var(--secondary-color) !important;
      background-color: var(--primary-color) !important;
      color: var(--secondary-color) !important;

    }


    .competition-list {

      border-radius: 10px;
    }

    .list-heading {
      background-color: var(--secondary-color);
      color: var(--primary-color);
      padding: 10px;
      text-align: center;
      border-radius: 10px;
      font-size: 14px;
    }

    .competitions-container {
      margin-top: 20px;
      max-height: 60rem;
      min-height: 10rem;
      overflow-y: auto; /* Enable vertical scrollbar when content overflows */
    }

    /* Competition Cards */
    .competition-card {
      background: white;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 10px 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .competition-main-name p,
    .competition-sub-name p {
      font-size: 16px;
      margin-bottom: 5px;
      text-align: left;
      cursor: pointer; /* Add cursor pointer to indicate it is clickable */
    }

    .competition-main-name span,
    .competition-sub-name span {
      color: var(--secondary-color);
      float: right;
    }
    .competition-sub-name span a {
      color: var(--secondary-color);
      float: right;
      text-decoration: none;
    }

    .competition-main-name i {
      float: right;
      color: #888;
    }
    p{
        font-size: 16px;
    }
    .heading{
        background: #016da8;
        border-radius: 15px;
        color: white;
    }

    .delete-btn, .edit-btn {
        padding: 10px 50px !important;
        border-radius: 15px !important;
    }
    @media (max-width: 435px) {
        .competition-main-name p,
    .competition-sub-name p {
            font-size: 13px;
        }
    }




  </style>
</head>
<body>

  <header class="header">
    <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
    <h1>Announce List</h1>
  </header>

  <div class="container1">
    <div class="tabs">

      <button class="tab-btn" onclick="window.location.href='{{ route('competition.announce') }}'">Announce</button>
      <button class="tab-btn active" onclick="window.location.href='{{ route('announce-list.index') }}'">Announce List</button>
    </div>
  </div>

  <div class="container">
    <div class="row mb-4">
        <div class="col-md-6 col-sm-12 offset-md-3">
            <h6 class="heading col-12 py-3 my-3">Announce List</h6>
            @foreach($competitions as $competition)
                <div class="competition-card">
                    <!-- Main Name with Dropdown Toggle -->
                    <div class="competition-main-name" onclick="toggleDropdown(this)">
                        <p>Competition Name : <span>{{ $competition->main_name }}</span></p>
                    </div>
                    <!-- curriculam and rules -->
                    @if($competition->curriculum)
                    <div class="competition-sub-name">
                        <p>Curriculum : 
                          <span>
                        <a href="public/{{ $competition->curriculum }}" target="_blank" class="btn">View</a>
                        <a href="public/{{ $competition->curriculum }}" target="_blank" class="btn">Download</a>
                        </span></p>
                    </div>
                    @endif

                    @if($competition->rules)
                    <div class="competition-sub-name">
                        <p>Rules : <span>
                        <a href="public/{{ $competition->rules }}" target="_blank" class="btn">View</a>
                        <a href="public/{{ $competition->rules }}" target="_blank" class="btn">Download</a>
                        </span></p>
                    </div>
                    @endif

                    <!-- Sub Name, initially hidden -->
                    <div class="competition-sub-name">
                        <p>From Date : <span>{{ Carbon\Carbon::parse($competition->start_date)->format('d-m-Y') }}</span></p>
                    </div>
                    
                    <div class="competition-sub-name">
                        <p>To Date : <span>{{ Carbon\Carbon::parse($competition->end_date)->format('d-m-Y') }}</span></p>
                    </div>
                    <div class="competition-sub-name">
                        <p>Number Of Days : <span>{{ $competition->no_of_days }}</span></p>
                    </div>
                    <div class="competition-sub-name">
                        <p>URL : <span><a href="{{ $competition->url }}" target="_blank">{{ $competition->url }}</a></span></p>
                    </div>
                    <div class="competition-sub-name">
                        <p>Status:
                            @if(Carbon\Carbon::now()->greaterThan(Carbon\Carbon::parse($competition->end_date)))
                                <span class="text-danger">Time Limit Expire</span>
                            @else
                                <span>{{ str_replace('-', ' ', $competition->status) }}</span>
                            @endif
                        </p>
                    </div>
                    <!-- Buttons -->
                    <div class="d-flex justify-content-center align-items-center mt-3">
                    <a href="{{ route('announce-list.edit', $competition->id) }}" class="btn edit-btn">Edit</a>
                        <a href="{{ route('delete-announce-competition', $competition->id) }}" class="btn delete-btn">Delete</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if($competitions->isEmpty())
        <p>No competitions Announced. Click "Announce" to add one.</p>
    @endif
</div>

  @include('includes.footer')


</body>
</html>
