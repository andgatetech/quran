@extends('layouts.app')

@section('styles')
<style>
:root {
    --primary-green: #10b981;
    --border-color: #e2e8f0;
    --background-gray: #f8fafc;
}

.header {
    background-color: var(--primary-green);
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    color: white;
    border-bottom-left-radius: 1rem;
    border-bottom-right-radius: 1rem;
}

.back-btn {
    color: white;
    font-size: 1.25rem;
}

.header h1 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 500;
}

.nav-buttons {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
    padding: 1rem;
}

@media (min-width: 768px) {
    .nav-buttons {
        grid-template-columns: repeat(4, 1fr);
    }
}

.nav-btn {
    padding: 0.75rem;
    border: 2px solid #016DA8;
    border-radius: 0.5rem;
    background: none;
    color: #016DA8;
    font-weight: 500;
    transition: all 0.2s;
}

.nav-btn.active {
    background-color: #016DA8;
    color: white;
}

.form-container {
    background: white;
    margin: 1rem;
    padding: 1.5rem;
    border-radius: 1rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.form-control {
    width: 100%;
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    background-color: white;
    /* padding: 0.75rem; */
}

.input-group {
    display: flex;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.upload-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.40rem 1.5rem;
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    background: white;
    color: #64748b;
    cursor: pointer;
}

.upload-btn i {
    color: #016DA8;
}

.btn-save {
    background-color: var(--primary-green);
    color: white;
    border: none;
    padding: 1rem;
    border-radius: 0.5rem;
    width: 100%;
    font-weight: 500;
    margin-top: 1rem;
}
</style>
@endsection

@section('content')
<header class="header">
    <a class="back-btn" href="{{ route('managenertificate.index') }}"><i class="fas fa-home"></i></a>
    <h1>Edit Certificate</h1>
</header>

<div class="container">
    <form action="{{ route('managenertificate.update', $certificate->id) }}" method="POST" enctype="multipart/form-data" class="form-container">
        @csrf
        @method('PUT')

        <!-- Competition Dropdown -->
        <select name="competition_id" class="form-control" required>
            <option value="">Select Competition</option>
            @foreach($competitions as $competition)
                <option value="{{ $competition->id }}" {{ $certificate->competition_id == $competition->id ? 'selected' : '' }}>
                    {{ $competition->main_name }}
                </option>
            @endforeach
        </select>

        <!-- Signature Count Dropdown -->
        <select name="signature_count" class="form-control" required>
            <option value="">Select number of signatures</option>
            <option value="1" {{ $certificate->signature_count == 1 ? 'selected' : '' }}>1</option>
            <option value="2" {{ $certificate->signature_count == 2 ? 'selected' : '' }}>2</option>
        </select>

        <!-- Option and Template Dropdowns -->
        <div class="input-group">
            <select name="option" class="form-control" required>
                <option value="">Option</option>
                <option value="1" {{ $certificate->option == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $certificate->option == 2 ? 'selected' : '' }}>2</option>
            </select>
            <select name="template" class="form-control" required>
                <option value="">Template</option>
                <option value="1" {{ $certificate->template == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $certificate->template == 2 ? 'selected' : '' }}>2</option>
            </select>
        </div>

        <!-- Award Date -->
        <input type="date" name="award_date" class="form-control" value="{{ $certificate->award_date }}" required>

        <!-- Authorize Person 1 -->
        <div class="input-group">
            <input type="text" name="authorize_person_1" class="form-control" value="{{ $certificate->authorize_person_1 }}" placeholder="Authorize person 1" required>
            <label class="upload-btn">
                <i class="fas fa-upload"></i>
                Signature
                <input type="file" name="signature_1" hidden accept="image/*">
            </label>
        </div>

        <!-- Designation of Person 1 -->
        <input type="text" name="designation_1" class="form-control" value="{{ $certificate->designation_1 }}" placeholder="Designation of the person 1" required>

        <!-- Authorize Person 2 -->
        <div class="input-group">
            <input type="text" name="authorize_person_2" class="form-control" value="{{ $certificate->authorize_person_2 }}" placeholder="Authorize person 2">
            <label class="upload-btn">
                <i class="fas fa-upload"></i>
                Signature
                <input type="file" name="signature_2" hidden accept="image/*">
            </label>
        </div>

        <!-- Designation of Person 2 -->
        <input type="text" name="designation_2" class="form-control" value="{{ $certificate->designation_2 }}" placeholder="Designation of the person 2">

        <!-- Office Logo and Stamp -->
        <div class="input-group">
            <label class="upload-btn" style="flex: 1">
                <i class="fas fa-image"></i>
                Office Logo
                <input type="file" name="office_logo" hidden accept="image/*">
            </label>
            <label class="upload-btn" style="flex: 1">
                <i class="fas fa-stamp"></i>
                Office Stamp
                <input type="file" name="office_stamp" hidden accept="image/*">
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-save">Update</button>
    </form>
</div>

<script>
    function displayFileName(input, spanId) {
        const fileName = input.files[0].name;
        document.getElementById(spanId).textContent = fileName;
    }
</script>

<style>
    .file-name {
        margin-left: 10px;
        color: #555;
    }
    .upload-btn {
        cursor: pointer;
    }
</style>

@endsection
