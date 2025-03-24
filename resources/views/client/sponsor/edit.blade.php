@extends('layouts.app')

@section('content')


<header class="header">
    <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
    <h1> Edit Sponsor</h1>
  </header>

  <div class="container1">
<div class="tabs">
    <style>
              .tab-btn {
   float: left;

    border-radius: 30px;
    font-size: 16px;
    transition: background-color 0.3s, color 0.3s;
    width: 45% !important;
    padding: .3rem 0;
    margin: .5rem .2rem;
}
    </style>
<button class="tab-btn "  onclick="window.location.href='{{ route('sponsors.create') }}'">Create Sponsor</button>
<button class="tab-btn " onclick="window.location.href='{{ route('sponsors.index') }}'">Sponsor List</button>
</div>
  </div>

    <div class="container my-5">

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-custom animate__animated animate__fadeInDown" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
            <div class="alert alert-danger alert-custom animate__animated animate__fadeInDown" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- The Form -->
        <form action="{{ route('sponsors.update', $sponsor->id) }}" method="POST" enctype="multipart/form-data" class="form-container mt-4">
            @csrf
            @method('PUT')

            <!-- Sponsor Name -->
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="name" placeholder="Sponsor Name"
                       value="{{ old('name', $sponsor->name) }}" required>
            </div>

            <!-- Competition Dropdown -->
            <div class="form-group mb-3">
                <label for="competition_id" class="form-label">Competition</label>
                <select class="form-control" id="competition_id" name="competition_id" required>
                    <option value="">Select Competition</option>
                    @foreach($competitions as $competition)
                        <option value="{{ $competition->id }}"
                            {{ old('competition_id', $sponsor->competition_id) == $competition->id ? 'selected' : '' }}>
                            {{ $competition->main_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sponsor Logo -->
            <div class="form-group mb-3">
                <label for="logo" class="form-label">Sponsor Logo</label>
                @if($sponsor->logo)
                    <p>Current Logo:</p>
                    <img src="{{ asset('public/'.$sponsor->logo) }}" alt="Sponsor Logo" width="150">
                @endif
                <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </div>
@endsection
