@extends('layouts.app')

@section('content')
    <style>
        .container1 {
            margin: 2rem 0 !important;
        }
        .container {margin-bottom: 6rem}


        .button-group1 {
            display: block;
            gap: 10px;
            margin-bottom: 20px;
        }

        .button-group1 .btn {
            float: left;

            border-radius: 30px;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
            width: 45% !important;
            padding: .3rem 0;
            margin: .5rem .2rem;
        }
/* .{font-size: .9rem !important} */

.button-group1 .btn{color: var(--secondary-color) ;
    border:1px solid var(--secondary-color) ;
    }


.active-button{    background-color: var(--secondary-color) !important;
    color: #ffffff !important;

}
.button-group1 a:hover{background-color: var(--secondary-color) !important;
    color: #ffffff !important;}





    .question-header i {
            color: #888;
            transition: transform 0.3s;
        }

        .list-item.active .question-header i {
            transform: rotate(180deg);
        }

        .rankstatus{font-size: .8rem;}
        .rankstatus p {display: inline !important;}
        .rankstatus1{color: red}

        .list-container {
    max-height: 100% !important;
    overflow-y: auto;
    padding: 10px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) ;
    /* box-shadow: none !important;; */
    margin-bottom: 20px;

}




.btn-complete,
        .btn-result {
            border-radius: 5px;
            font-size: 14px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .btn-complete {
            background-color: var(--secondary-color);
            color: white;
        }

        .btn-result {
            background-color: #007bff;
            color: white;
        }

        .btn-result:hover {
            background-color: #0056b3;
        }

        .btn-complete:hover {
            background-color: #008f79;
        }


    </style>
    <header class="header">
        <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
         Announce Winners
    </header>
    <div class="button-group1">
        <a href="{{ route('host.create') }}" class="btn  ">Host Competition</a>
        <a href="{{ route('competitions.list') }}" class="btn  active-button">Competitions</a>
        <a href="{{ route('host.announce') }}" class="btn  ">Announce Winners</a>
    </div>
    <div class="container">
        <div class="list-container">
            @foreach($hosts as $host)
            <div class="list-item mb-3 p-3 border rounded" onclick="this.classList.toggle('active')">
                <div class="question-header">
                    <p><strong>Main Name:</strong> <span>{{ $host->main_name }}</span><i class="fas fa-chevron-down"></i></p>
                </div>
                <div class="details">
                    <p><strong>Competition Sub Name:</strong> {{ $host->sub_name }}</p>
                    <p><strong>Host ID:</strong> {{ $host->host_id }}</p>
                    <p><strong>Password:</strong> **********</p>
                    @if($host->status == 'active')
                    <p><strong>Host Date:</strong> {{ \Carbon\Carbon::parse($host->created_at)->format('d-m-Y') }}</p>
                    <div class="button-group-inline">
                        <form action="{{ route('host.continue', $host->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-complete">Continue</button>
                        </form>
                        <form action="" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-result">Result</button>
                        </form>
                    </div>
                    @elseif($host->status == 'done')
                    <p><strong>Host Date:</strong> {{ \Carbon\Carbon::parse($host->created_at)->format('d-m-Y') }}</p>
                    <p><strong>Completed Date:</strong> {{ \Carbon\Carbon::parse($host->updated_at)->format('d-m-Y') }}</p>
                    <form action="" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-result">Result</button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>


 
@endsection
