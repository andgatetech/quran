@extends('layouts.app')

@section('content')




<header class="header">
    <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
    <h1>Create Curriculum</h1>
  </header>

  <div class="container1">
<div class="tabs">

<button class="tab-btn active"  onclick="window.location.href='{{ route('curriculum.create') }}'">Create curriculum</button>
<button class="tab-btn " onclick="window.location.href='{{ route('curriculum.index') }}'">curriculum List</button>
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
        <form action="{{ route('curriculum.store') }}" method="POST" class="form-container" style="margin: 0 !important;">
            @csrf
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title') }}" required>
                
            </div>

            <div class="form-group mb-4">
                <select multiple class="form-control" id="number_of_questions" name="book[]" required>
                    <option value="">Select Quran Option by Book</option>
                    <?php foreach($books as $book){ ?>
                        <option value="{{ $book->id}}">{{ $book->book_name }}</option>
                    <?php } ?>
                    
                </select>
            </div>
            
            {{-- <div class="form-group mb-4">
                <select class="form-control" id="number_of_questions" name="number_of_questions" required>
                    <option value="">Select Multiple number of book or Surah</option>
                    <option value="1" {{ old('quran_option') == 1 ? 'selected' : '' }}>Alif Lam Meem</option>
                    <option value="2" {{ old('quran_option') == 2 ? 'selected' : '' }}>Sayaqool</option>
                    <option value="3" {{ old('quran_option') == 3 ? 'selected' : '' }}>Alif Lam</option>
                    <option value="4" {{ old('quran_option') == 4 ? 'selected' : '' }}>Meem</option>
                </select>
            </div> --}}
            
            <div class="form-group mb-3">
                <label for="total_ayah">Total # of Ayah : </label>
                <input type="text" class="form-control" name="total_ayah" value="1235" readonly>
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
                <select class="form-control" id="side_category_id" name="side_category_id" required>
                    <option value="">Select Side Category</option>
                    @foreach($sideCategories as $sideCategory)
                        <option value="{{ $sideCategory->id }}" {{ old('side_category_id') == $sideCategory->id ? 'selected' : '' }}>
                            {{ $sideCategory->name }}
                        </option>
                    @endforeach
                                        <option value="1">Default</option>


                </select>
            </div>
            <div class="form-group mb-3">
                <select class="form-control" id="read_category_id" name="read_category_id" required>
                    <option value="">Select Read Category</option>
                    @foreach($readCategories as $readCategory)
                        <option value="{{ $readCategory->id }}" {{ old('read_category_id') == $readCategory->id ? 'selected' : '' }}>
                            {{ $readCategory->name }}
                        </option>
                    @endforeach
                                        <option value="1">Default</option>


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
                                        <option value="1">Default</option>


                </select>
            </div>
            

            <div class="form-group mb-3">
                <label for="remarks">Remarks (optional):</label>
                <textarea class="form-control" name="remarks" id="remarks" rows="4" placeholder="Enter your remarks here..."></textarea>
            </div>
            

            <button type="submit" class="btn btn-primary">Save</button>
        </form>


        <hr>


    </div>
    </div>
@endsection
