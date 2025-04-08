@extends('layouts.app')

@section('content')
<!-- top bar -->
@include('client.layouts.top-bar')

  <div class="container1">
        <div class="tabs">
            <button class="tab-btn" onclick="window.location.href='{{ route('quran.competitor.create') }}'">Create
                Competitor</button>
            <button class="tab-btn active" onclick="window.location.href='{{ route('quran.competitor.list') }}'">Competitor
                List</button>
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
        <form action="{{ route('quran.competitor.update', $competitor->id) }}" method="POST" class="form-container mt-4">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="{{ old('full_name', $competitor->full_name) }}" required>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="full_name_dhivehi" placeholder="Full Name (Dhivehi)" value="{{ old('full_name_dhivehi', $competitor->full_name_dhivehi) }}">
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="id_card_number" placeholder="ID Card Number" value="{{ old('id_card_number', $competitor->id_card_number) }}" required>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="address" placeholder="Address" value="{{ old('address', $competitor->address) }}" required>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="island_city" placeholder="Island / City" value="{{ old('island_city', $competitor->island_city) }}" required>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="school_name" placeholder="If Student, Please Name the School" value="{{ old('school_name', $competitor->school_name) }}">
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="parent_name" placeholder="Parent Name" value="{{ old('parent_name', $competitor->parent_name) }}" required>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number', $competitor->phone_number) }}" required>
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
            <div class="form-group mb-3">
                <label for="side_category_id" class="form-label">Recitation Piece</label>
                <select class="form-control" id="side_category_id" name="side_category_id" required>
                    <option value="">Select Recitation Piece</option>
                    @foreach($sideCategories as $sideCategory)
                        <option value="{{ $sideCategory->id }}" {{ old('side_category_id', $competitor->side_category_id) == $sideCategory->id ? 'selected' : '' }}>
                            {{ $sideCategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="read_category_id" class="form-label">Recitation Method</label>
                <select class="form-control" id="read_category_id" name="read_category_id" required>
                    <option value="">Select Recitation Method</option>
                    @foreach($readCategories as $readCategory)
                        <option value="{{ $readCategory->id }}" {{ old('read_category_id', $competitor->read_category_id) == $readCategory->id ? 'selected' : '' }}>
                            {{ $readCategory->name }}
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
            <div class="form-group mb-4">
                <label for="number_of_questions" class="form-label">Number of Questions</label>
                <select class="form-control" id="number_of_questions" name="number_of_questions" required>
                    <option value="">Select Number of Questions</option>
                    @for($i = 1; $i <= 100; $i++)
                        <option value="{{ $i }}" {{ old('number_of_questions', $competitor->number_of_questions) == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
