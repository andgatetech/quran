@extends('layouts.app')

@section('content')

<style>
    .book-holder{
        display: inline-block;
    }
</style>


<!-- top bar -->
@include('client.layouts.top-bar')

  <div class="container1">
    <div class="tabs">
    <button class="tab-btn active"  onclick="window.location.href='{{ route('quran.curriculum.create') }}'">Create curriculum</button>
    <button class="tab-btn " onclick="window.location.href='{{ route('quran.curriculum.list') }}'">Curriculum List</button>
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
        <form action="{{ route('quran.curriculum.store') }}" method="POST" class="form-container" style="margin: 0 !important;">
            @csrf
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title') }}" required>
                
            </div>

            <div class="form-group mb-4">
                <select multiple class="form-control" id="bookSelect" name="book[]" required>
                    <option value="">Select Quran Option by Book</option>
                    <?php foreach($books as $book){ ?>
                        <option value="{{ $book->id}}" data-id="{{ $book->id }}" data-name="{{ $book->book_name }}" data-ayah="{{ $book->total_ayah }}">{{ $book->book_name }}</option>
                    <?php } ?>
                    
                </select>
            </div>
        <!-- Placeholder to show selected items -->
        <div id="bookPlaceholder" class="mt-2 p-3 border rounded bg-light text-dark">
            Selected Books Will Appear Here
        </div>            
            
            
            <div class="form-group mb-3">
                <label for="total_ayah">Total # of Ayah : </label>
                <input type="text" class="form-control" name="total_ayah" id="total_ayah" value="0" readonly>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select books",
            allowClear: false
        });
    });
</script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectBox = document.getElementById('bookSelect');
        const placeholder = document.getElementById('bookPlaceholder');
        const totalAyahHolder = document.getElementById('total_ayah');
        


        selectBox.addEventListener('change', function () {
            var totalAyah = 0;
            const selected = Array.from(selectBox.selectedOptions);
            if (selected.length === 0) {
                placeholder.innerHTML = "Selected books will appear here";
                return;
            }

            const output = selected.map(option => {
                const id = option.dataset.id;
                const name = option.dataset.name;
                const ayah = option.dataset.ayah;
                totalAyah += parseInt(ayah);
                return `<div class="book-holder">📘 (${id}) <strong>${name}</strong>, </div> &nbsp`;
            }).join('');

            placeholder.innerHTML = output;
            totalAyahHolder.value = totalAyah;
            
        });
    });
</script>
@endsection
