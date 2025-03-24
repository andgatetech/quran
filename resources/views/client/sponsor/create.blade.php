@extends('layouts.app')

@section('content')




<header class="header">
    <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
    <h1> Create Sponsor</h1>
  </header>

<div class="tabs">

<button class="tab-btn active"  onclick="window.location.href='{{ route('sponsors.create') }}'">Create Sponsor</button>
<button class="tab-btn " onclick="window.location.href='{{ route('sponsors.index') }}'">Sponsor List</button>
</div>




    <div class="container">



        <!-- The Form -->
        <form action="{{ route('sponsors.store') }}" method="POST" enctype="multipart/form-data" class="form-container mt-4">
            @csrf
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="name" placeholder="Sponsor Name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="competition_id" class="form-label">Competition</label>
                <select class="form-control" id="competition_id" name="competition_id" required>
                    <option value="">Select Competition</option>
                    @foreach($competitions as $competition)
                        <option value="{{ $competition->id }}" {{ old('competition_id') == $competition->id ? 'selected' : '' }}>
                            {{ $competition->main_name }}
                        </option>
                    @endforeach
                </select>

            </div>
            <div class="form-group mb-3">
                <label for="logo" class="form-label">Sponsor Logo</label>
                <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
