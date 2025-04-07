@extends('layouts.app')

@section('content')




<header class="header">
    <a class="back-btn" href="{{ route('client.menu.poetry') }}"><i class="fas fa-home"></i></a>
    <h1>Create Poetry(Poetry)</h1>
  </header>

  <div class="container1">
<div class="tabs">

<button class="tab-btn active"  onclick="window.location.href='{{ route('poetry.poetry.create') }}'">Create Poetry</button>
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
        <form action="{{ route('poetry.poetry.store') }}" method="POST" class="form-container" style="margin: 0 !important;">
            @csrf
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="poetry_name" placeholder="Poetry Name" value="{{ old('poetry_name') }}" required>
                
            </div>

            
            
            <div class="form-group mb-3">
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
                <select class="form-control" id="age_category_id" name="age_category_id" required>
                    <option value="">Select Age Category</option>
                    @foreach($ageCategories as $ageCategory)
                        <option value="{{ $ageCategory->id }}" {{ old('age_category_id') == $ageCategory->id ? 'selected' : '' }}>
                            {{ $ageCategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <select class="form-control" id="side_category_id" name="side_category_id" required>
                    <option value="">Perform Option</option>
                    @foreach($sideCategories as $sideCategory)
                        <option value="{{ $sideCategory->id }}" {{ old('side_category_id') == $sideCategory->id ? 'selected' : '' }}>
                            {{ $sideCategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <select class="form-control" id="read_category_id" name="read_category_id" required>
                    <option value="">Method of Perform</option>
                    @foreach($readCategories as $readCategory)
                        <option value="{{ $readCategory->id }}" {{ old('read_category_id') == $readCategory->id ? 'selected' : '' }}>
                            {{ $readCategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            
            <button type="submit" class="btn btn-primary">Save</button>
        </form>


        <hr>

        <!-- Bulk Upload Form -->
        <h3 class="mt-5">Bulk Upload</h3>
        <form action="{{ route('poetry.poetry.bulkStore') }}" method="POST" enctype="multipart/form-data" class="form-container mt-4">
            @csrf
            <div class="form-group mb-3">
                <input type="file" class="form-control" id="competitors_csv" name="competitors_csv" accept=".csv" required>
            </div>
            <button type="submit" class="btn btn-success" style="background-color: #016da8  ">Upload</button>
        </form>


    </div>
    </div>
@endsection
