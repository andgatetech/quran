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
    /* padding: 0.75rem; */
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    /* margin-bottom: 1rem; */
    background-color: white;
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
}

.upload-btn i {
    color: #016DA8;
}

.btn-view {
    background-color: #3b82f6;
    color: white;
    border: none;
    padding: 0.40rem 1.5rem;
    border-radius: 0.5rem;
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
    <a href="{{ url('') }}" class="back-btn">
        <i class="fas fa-chevron-left"></i>
    </a>
    <h1>Manage Certificate</h1>
</header>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="nav-buttons">
    <button class="nav-btn active">Certificate Settings</button>
    <button class="nav-btn" onclick="window.location.href='{{ route('managenertificate.index') }}'">Settings List</button>
    <button class="nav-btn" onclick="window.location.href='{{ route('managenertificate.generate.view') }}'">Generate</button>
    <button class="nav-btn" onclick="window.location.href=''">Generated List</button>
</div>

<div class="container">
    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form style="padding: 10px;" action="{{ route('managenertificate.store') }}" method="POST" enctype="multipart/form-data" class="d-block">
        @csrf
        
        <!-- Competition Dropdown -->
        <select name="competition_id" class="form-control" required>
            <option value="">Select Competition</option>
            @foreach($competitions as $competition)
                <option value="{{ $competition->id }}" {{ old('competition_id') == $competition->id ? 'selected' : '' }}>
                    {{ $competition->main_name }}
                </option>
            @endforeach
        </select>

        <!-- Signature Count Dropdown -->
        <select name="signature_count" class="form-control" required>
            <option value="">Select number of signatures</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>

        <!-- Option and Template Dropdowns -->
        <div class="input-group">
            <select name="option" class="form-control" required>
                <option value="">Option</option>
                <option value="1">Public</option>
                <option value="2">My Garden</option>
            </select>
            <select name="template" class="form-control" required>
                <option value="">Template</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
            <button type="button" class="btn-view">View</button>
        </div>

        <!-- Award Date -->
        <input type="date" name="award_date" class="form-control" placeholder="Select Award Date" required>

        <!-- Authorize Person 1 -->
        <div class="input-group">
            <input type="text" name="authorize_person_1" class="form-control" placeholder="Authorize person 1" required>
            <label class="upload-btn">
                <i class="fas fa-upload"></i>
                Signature
                <input type="file" name="signature_1" hidden accept="image/*" required onchange="displayFileName(this, 'signature1-name')">
            </label>
            <span id="signature1-name" class="file-name"></span>
        </div>

        <!-- Designation of Person 1 -->
        <input type="text" name="designation_1" class="form-control" placeholder="Designation of the person 1" >

        <!-- Authorize Person 2 -->
        <div class="input-group">
            <input type="text" name="authorize_person_2" class="form-control" placeholder="Authorize person 2">
            <label class="upload-btn">
                <i class="fas fa-upload"></i>
                Signature
                <input type="file" name="signature_2" hidden accept="image/*" onchange="displayFileName(this, 'signature2-name')">
            </label>
            <span id="signature2-name" class="file-name"></span>
        </div>

        <!-- Designation of Person 2 -->
        <input type="text" name="designation_2" class="form-control" placeholder="Designation of the person 2">

        <!-- Office Logo and Stamp -->
        <div class="input-group">
            <label class="upload-btn" style="flex: 1">
                <i class="fas fa-image"></i>
                Office Logo
                <input type="file" name="office_logo" hidden accept="image/*" required onchange="displayFileName(this, 'office-logo-name')">
            </label>
            <span id="office-logo-name" class="file-name"></span>

            <label class="upload-btn" style="flex: 1">
                <i class="fas fa-stamp"></i>
                Office Stamp
                <input type="file" name="office_stamp" hidden accept="image/*" required onchange="displayFileName(this, 'office-stamp-name')">
            </label>
            <span id="office-stamp-name" class="file-name"></span>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-save">Save</button>
    </form>
</div>

<!-- JavaScript to Display Uploaded File Name -->
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