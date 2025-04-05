@extends('layouts.app')

@section('content')
<header class="header">
    <a class="back-btn" href="{{ route('client.menu.poetry') }}"><i class="fas fa-home"></i></a>
    <h1>Edit Competitor(Poetry)</h1>
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
<button class="tab-btn "  onclick="window.location.href='{{ route('poetry.poetry.create') }}'">Create Poetry</button>
<button class="tab-btn " onclick="window.location.href='{{ route('poetry.poetry.index') }}'">Poetry List</button>
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

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger alert-custom animate__animated animate__fadeInDown" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- The Form -->
        <form action="{{ route('poetry.poetry.update', $competitor->id) }}" method="POST" class="form-container mt-4">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="poetry_name" placeholder="Poetry Name" value="{{ old('poetry_name', $competitor->poetry_name) }}" required>
            </div>
            
            
            <div class="form-group mb-3">
                <label for="competition_id" class="form-label">Competition</label>
                <select class="form-control" id="competition_id" name="competition_id" required>
                    <option value="">Select Competition</option>
                    @foreach($competitions as $competition)
                        <option value="{{ $competition->id }}" {{ old('competition_id', $competitor->competition_id) == $competition->id ? 'selected' : '' }}>
                            {{ $competition->main_name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group mb-4">
                <label for="age_category_id" class="form-label">Age Category</label>
                <select class="form-control" id="age_category_id" name="age_category_id" required>
                    <option value="">Select Age Category</option>
                    @foreach($ageCategories as $ageCategory)
                        <option value="{{ $ageCategory->id }}" {{ old('age_category_id', $competitor->age_category_id) == $ageCategory->id ? 'selected' : '' }}>
                            {{ $ageCategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group mb-3">
                <label for="side_category_id" class="form-label">Side Category</label>
                <select class="form-control" id="side_category_id" name="side_category_id" required>
                    <option value="">Perform Option</option>
                    @foreach($sideCategories as $sideCategory)
                        <option value="{{ $sideCategory->id }}" {{ old('side_category_id', $competitor->side_category_id) == $sideCategory->id ? 'selected' : '' }}>
                            {{ $sideCategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="read_category_id" class="form-label">Read Category</label>
                <select class="form-control" id="read_category_id" name="read_category_id" required>
                    <option value="">Method of Perform</option>
                    @foreach($readCategories as $readCategory)
                        <option value="{{ $readCategory->id }}" {{ old('read_category_id', $competitor->read_category_id) == $readCategory->id ? 'selected' : '' }}>
                            {{ $readCategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
