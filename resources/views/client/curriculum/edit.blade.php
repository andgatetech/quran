@extends('layouts.app')

@section('content')
<header class="header">
    <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
    <h1>Edit Curriculum</h1>
</header>

<div class="container1">
    <div class="tabs">
        <button class="tab-btn" onclick="window.location.href='{{ route('curriculum.create') }}'">Create Curriculum</button>
        <button class="tab-btn active" onclick="window.location.href='{{ route('curriculum.index') }}'">Curriculum List</button>
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

    <!-- Curriculum Update Form -->
    <form action="{{ route('curriculum.update', $curriculum->id) }}" method="POST" class="form-container mt-4">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title', $curriculum->title) }}" required>
        </div>

        <!--
        <div class="form-group mb-3">
            <input type="number" class="form-control" name="number_of_questions" placeholder="Number of Questions" value="{{ old('number_of_questions', $curriculum->number_of_questions) }}">
        </div>
        -->

        <div class="form-group mb-4">
               <?php  
                 $total_book=unserialize($curriculum->book_id);
               ?> 
                <select multiple class="form-control" id="number_of_questions" name="book[]" required>
                    <option value="">Select Quran Option by Book</option>
                    <?php foreach($books as $book){ ?>
                        <option <?php if(in_array($book->id,$total_book)) echo 'selected'; ?> value="{{ $book->id}}">{{ $book->book_name }}</option>
                    <?php } ?>
                    
                </select>
        </div>

        <div class="form-group mb-3">
            <input type="number" class="form-control" name="total_ayah" placeholder="Total # of Ayah" value="{{ old('total_ayah', $curriculum->total_ayah) }}">
        </div>

        <div class="form-group mb-3">
            <label for="competition_id">Competition</label>
            <select class="form-control" name="competition_id" required>
                <option value="">Select Competition</option>
                @foreach($competitions as $competition)
                    <option value="{{ $competition->id }}" 
                        {{ old('competition_id', $curriculum->competition_id) == $competition->id ? 'selected' : '' }}>
                        {{ $competition->main_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="side_category_id">Side Category</label>
            <select class="form-control" name="side_category_id" required>
                <option value="">Select Side Category</option>
                @foreach($sideCategories as $sideCategory)
                    <option value="{{ $sideCategory->id }}" 
                        {{ old('side_category_id', $curriculum->side_category_id) == $sideCategory->id ? 'selected' : '' }}>
                        {{ $sideCategory->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="read_category_id">Read Category</label>
            <select class="form-control" name="read_category_id" required>
                <option value="">Select Read Category</option>
                @foreach($readCategories as $readCategory)
                    <option value="{{ $readCategory->id }}" 
                        {{ old('read_category_id', $curriculum->read_category_id) == $readCategory->id ? 'selected' : '' }}>
                        {{ $readCategory->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="age_category_id">Age Category</label>
            <select class="form-control" name="age_category_id" required>
                <option value="">Select Age Category</option>
                @foreach($ageCategories as $ageCategory)
                    <option value="{{ $ageCategory->id }}" 
                        {{ old('age_category_id', $curriculum->age_category_id) == $ageCategory->id ? 'selected' : '' }}>
                        {{ $ageCategory->name }}
                    </option>
                @endforeach
            </select>
        </div>
        

        <div class="form-group mb-4">
            <textarea class="form-control" name="remarks" placeholder="Enter remarks here...">{{ old('remarks', $curriculum->remarks) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Curriculum</button>
    </form>
</div>
@endsection
