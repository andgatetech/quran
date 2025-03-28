@extends('layouts.app')

@section('content')
<style>
    .select2-container--default .select2-selection--multiple {
        border: 2px solid #007bff;
        /* Border color */
        border-radius: 5px;
        /* Rounded corners */
        padding: 5px;
        font-size: 1rem;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff;
        /* Selected item background color */
        color: var(--primary-color);
        /* Text color */
        border-radius: 5px;
        /* Rounded corners for choices */
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: var(--primary-color);
        /* Remove button color */
        font-size: 14px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        background-color: red;
        /* Hover color for remove button */
        color: var(--primary-color);
        /* Text color on hover */
    }

    .form-group label {
        font-weight: 600;
        /* Bold label text */
        color: #333;
        /* Darker label text color */
    }

    .form-group small {
        font-size: 0.9rem;
        color: #6c757d;
        /* Muted text for help text */
    }
</style>
    <header class="header">
        <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
        <h1>Competition List</h1>
    </header>

        <div class="tabs">

            <button class="tab-btn active" onclick="window.location.href='{{ route('judges.create') }}'">Create Judge</button>
            <button class="tab-btn " onclick="window.location.href='{{ route('judges.index') }}'">Judge List</button>
        </div>







    <div class="container my-10">

        <!-- Button Group -->


        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-custom animate__animated animate__fadeInDown" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if (session('error'))
            <div class="alert alert-danger alert-custom animate__animated animate__fadeInDown" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- The Form -->
        <form action="{{ route('judges.store') }}" method="POST" class="form-container mt-4">
            @csrf
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="full_name" placeholder="Name of the Judge"
                    value="{{ old('full_name') }}" required>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="id_card_number" placeholder="ID Card Number"
                    value="{{ old('id_card_number') }}" required>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="address" placeholder="Address" value="{{ old('address') }}"
                    required>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="island_city" placeholder="Island / City"
                    value="{{ old('island_city') }}" required>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="work_office" placeholder="Work Office"
                    value="{{ old('work_office') }}" required>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="phone_number" placeholder="Phone Number"
                    value="{{ old('phone_number') }}" required>
            </div>
            <div class="form-group mb-3">
                {{-- <label for="competition_id" class="form-label">Competition</label> --}}
                <select class="form-control" id="competition_id" name="competition_id" required>
                    <option value="">Select Competition</option>
                    @foreach ($competitions as $competition)
                        <option value="{{ $competition->id }}"
                            {{ old('competition_id') == $competition->id ? 'selected' : '' }}>
                            {{ $competition->main_name }}
                        </option>
                    @endforeach
                </select>

            </div>



            <!-- Include Select2 CSS -->
            <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

            <div class="form-group mb-3">
                {{-- <label for="point_category_id" class="form-label">Point Category</label> --}}
                <select class="form-control select2" id="point_category_id" name="point_category_id[]" multiple required>
                    <option value="" disabled>Select Point Category</option>
                    @foreach ($pointCategories as $pointCategory)
                        <option value="{{ $pointCategory->id }}"
                            {{ in_array($pointCategory->id, old('point_category_id', [])) ? 'selected' : '' }}>
                            {{ $pointCategory->name }}
                        </option>
                    @endforeach
                </select>
                <small id="pointCategoryHelp" class="form-text text-muted">Select one or more categories</small>
            </div>

            <div class="form-group mb-3">
                {{-- <label for="bell_option" class="form-label">Bell Option</label> --}}
                <select class="form-control" id="bell_option" name="bell_option" required>
                    <option value="">Select Bell Option</option>
                    <option value="Enable" {{ old('bell_option') == 'Enable' ? 'selected' : '' }}>Enable</option>
                    <option value="Disable" {{ old('bell_option') == 'Disable' ? 'selected' : '' }}>Disable</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email Address"
                    value="{{ old('email') }}" required>
            </div>
            <div class="form-group mb-4">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-save">Save</button>
        </form>
    </div>


              <!-- Include Select2 JS and jQuery -->
              <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
              <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

              <script>
                  // Initialize Select2 on the select element
                  $(document).ready(function() {
                      $('.select2').select2({
                          placeholder: "Choose Point Categories", // Placeholder text
                          allowClear: true, // Option to clear selection
                          width: '100%' // Ensure it spans the full width
                      });
                  });
              </script>

              <!-- Optional: Customize the form container -->


@endsection
