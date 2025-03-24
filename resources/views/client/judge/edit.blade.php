@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2>Edit Judge</h2>

        <!-- Button Group -->
        <div class="button-group mb-4">
            <a href="{{ route('judges.create') }}" class="btn btn-outline-success">Create Judge</a>
            <a href="{{ route('judges.index') }}" class="btn btn-outline-success active-button">Judge List</a>
        </div>




        <!-- The Form -->
        <form action="{{ route('judges.update', $judge->id) }}" method="POST" class="form-container mt-4">
            @csrf
            @method('PUT')

            <!-- Full Name -->
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="full_name" placeholder="Name of the Judge"
                    value="{{ old('full_name', $judge->full_name) }}" required>
            </div>

            <!-- ID Card Number -->
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="id_card_number" placeholder="ID Card Number"
                    value="{{ old('id_card_number', $judge->id_card_number) }}" required>
            </div>

            <!-- Address -->
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="address" placeholder="Address"
                    value="{{ old('address', $judge->address) }}" required>
            </div>

            <!-- Island / City -->
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="island_city" placeholder="Island / City"
                    value="{{ old('island_city', $judge->island_city) }}" required>
            </div>

            <!-- Work Office -->
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="work_office" placeholder="Work Office"
                    value="{{ old('work_office', $judge->work_office) }}" required>
            </div>

            <!-- Phone Number -->
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="phone_number" placeholder="Phone Number"
                    value="{{ old('phone_number', $judge->phone_number) }}" required>
            </div>

            <!-- Competition -->
            <div class="form-group mb-3">
                <label for="competition_id" class="form-label">Competition</label>
                <select class="form-control" id="competition_id" name="competition_id" required>
                    <option value="">Select Competition</option>
                    @foreach ($competitions as $competition)
                        <option value="{{ $competition->id }}"
                            {{ old('competition_id', $judge->competition_id) == $competition->id ? 'selected' : '' }}>
                            {{ $competition->main_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Point Category with Multiple Selection -->
            <div class="form-group mb-3">
                <label for="point_category_id" class="form-label">Point Category</label>
                <select class="form-control select2" id="point_category_id" name="point_category_id[]" multiple required>
                    @foreach ($pointCategories as $pointCategory)
                        <option value="{{ $pointCategory->id }}"
                            {{ in_array($pointCategory->id, old('point_category_id', json_decode($judge->point_category_id, true) ?? [])) ? 'selected' : '' }}>
                            {{ $pointCategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Bell Option -->
            <div class="form-group mb-3">
                <label for="bell_option" class="form-label">Bell Option</label>
                <select class="form-control" id="bell_option" name="bell_option" required>
                    <option value="">Select Bell Option</option>
                    <option value="Enable" {{ old('bell_option', $judge->bell_option) == 'Enable' ? 'selected' : '' }}>Enable</option>
                    <option value="Disable" {{ old('bell_option', $judge->bell_option) == 'Disable' ? 'selected' : '' }}>Disable</option>
                </select>
            </div>

            <!-- Email -->
            <div class="form-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email Address"
                    value="{{ old('email', $judge->email) }}" required>
            </div>

            <!-- Password -->
            <div class="form-group mb-4">
                <input type="password" class="form-control" name="password"
                    placeholder="Password (leave blank to keep current password)">
            </div>

            <!-- Include Select2 JS -->
            <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('.select2').select2({
                        placeholder: "Choose Point Categories",
                        allowClear: true,
                        width: '100%'
                    });
                });
            </script>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>


    </div>
@endsection
