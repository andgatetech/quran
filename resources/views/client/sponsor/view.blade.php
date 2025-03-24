@extends('layouts.app')

@section('content')


<header class="header">
    <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
    <h1> View Sponsor</h1>
  </header>

  <div class="container1">
<div class="tabs">
<button class="tab-btn "  onclick="window.location.href='{{ route('sponsors.create') }}'">Create Sponsor</button>
<button class="tab-btn " onclick="window.location.href='{{ route('sponsors.index') }}'">Sponsor List</button>
</div>
  </div>


    <div class="container my-5" style="margin-bottom:6rem !important;">


        <!-- Sponsor Details -->
        <div class="card">
            <div class="card-header">
                {{ $sponsor->name }}
            </div>
            <div class="card-body">
                <p><strong>Competition:</strong> {{ $sponsor->competition->name }}</p>
                @if($sponsor->logo)
                    <p><strong>Logo:</strong></p>
                    <img src="{{ asset('public/'.$sponsor->logo) }}" alt="Sponsor Logo" width="150">
                @else
                    <p><strong>Logo:</strong> Not Uploaded</p>
                @endif
                <p><strong>Created At:</strong> {{ $sponsor->created_at->format('Y-m-d') }}</p>
                <p><strong>Updated At:</strong> {{ $sponsor->updated_at->format('Y-m-d') }}</p>
            </div>
        </div>
    </div>
@endsection
