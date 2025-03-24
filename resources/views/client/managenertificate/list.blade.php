@extends('layouts.app')

@section('content')
<header class="header">
    <a class="back-btn" href="{{ route('managenertificate.create') }}"><i class="fas fa-home"></i></a>
    <h1>Certificate List</h1>
</header>

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
    </style>
    <div class="nav-buttons">
        <button class="nav-btn" onclick="window.location.href='{{ route('managenertificate.create') }}'">Certificate Settings</button>
        <button class="nav-btn active">Certificate List</button>
        <button class="nav-btn" onclick="window.location.href='{{ route('managenertificate.generate.view') }}'">Generate</button>
        <button class="nav-btn" onclick="window.location.href=''">Generated List</button>
    </div>
</div>

<style>
    .container {
        width: 100%;
        max-width: 100%;
        text-align: center;
        margin: 0 auto;
    }
    .list-container {
        display: inline-block;
        width: 100%;
        max-width: 100%;
        text-align: center;
        margin: 0 auto;
        min-height: 20rem !important;
        max-height: 60rem !important;
        margin: 0 0 6vw 0;
    }
    .list-item.active .question-header i {
        transform: rotate(180deg);
        transition: transform 0.3s ease-in-out;
    }
    .details strong { color: black; }
    .details p { color: var(--secondary-color) !important; margin: 0; }
    .list-item { padding: .4rem !important; }
    .view-btn {
        background-color: #016DA8;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

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

    
    <div class="list-container">
        @forelse($certificates as $certificate)
            <div class="list-item mb-3 p-3 border rounded" onclick="this.classList.toggle('active')">
                <div class="question-header">
                    <span><strong>Competition Name:</strong> {{ $certificate->competition->main_name }}</span>
                    <i class="fas fa-chevron-down"></i>
                </div>

                <div class="details mt-2" style="display: none;">
                    <p><strong>Number of Signature:</strong> {{ $certificate->signature_count }}</p>
                    <p><strong>Option:</strong> {{ $certificate->option }}</p>
                    <p><strong>Template:</strong> <button class="view-btn">View</button></p>
                    <p><strong>Date of Award:</strong> {{ $certificate->award_date }}</p>
                    <p><strong>Authorized by:</strong> {{ $certificate->authorize_person_1 }}</p>
                    <p><strong>Designation:</strong> {{ $certificate->designation_1 }}</p>
                    <p><strong>Signature 1:</strong> <button style="margin-top: 10px;" class="view-btn" onclick="window.open('{{ asset('storage/app/public/' . $certificate->signature_1) }}', '_blank')">View</button></p>
                    @if($certificate->signature_2)
                        <p><strong>Signature 2:</strong> <button style="margin-top: 10px;" class="view-btn" onclick="window.open('{{ asset('storage/app/public/' . $certificate->signature_2) }}', '_blank')">View</button></p>
                    @endif
                    <p><strong>Office Logo:</strong> <button style="margin-top: 10px;" class="view-btn" onclick="window.open('{{ asset('storage/app/public/' . $certificate->office_logo) }}', '_blank')">View</button></p>
                    <p><strong>Office Stamp:</strong> <button style="margin-top: 10px;" class="view-btn" onclick="window.open('{{ asset('storage/app/public/' . $certificate->office_stamp) }}', '_blank')">View</button></p>
                    <!-- Edit and Delete Buttons -->{{ asset('storage/app/public/' . $certificate->office_logo) }}
                        <a href="{{ route('managenertificate.edit', $certificate->id) }}" class="btn btn-edit btn-warning">Edit</a>
                        <form action="{{ route('managenertificate.destroy', $certificate->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete btn-danger" onclick="return confirm('Are you sure you want to delete this certificate?')">Delete</button>
                        </form>
                </div>
            </div>
        @empty
            <p>No certificates found.</p>
        @endforelse
    </div>
</div>

<!-- JavaScript to toggle details -->
<script>
    document.querySelectorAll('.list-item').forEach(item => {
        item.addEventListener('click', function(e) {
            // Prevent toggling when clicking on buttons
            if (e.target.tagName.toLowerCase() !== 'button' && e.target.tagName.toLowerCase() !== 'a') {
                this.querySelector('.details').style.display = this.classList.contains('active') ? 'block' : 'none';
            }
        });
    });
</script>

<!-- Add this in your Blade template -->
<form action="{{ route('certificate.generate') }}" method="POST" target="_blank">
    @csrf
    <input type="hidden" name="serial_number" value="SN-2023-001">
    <input type="hidden" name="logo" value="{{ asset('path/to/your/logo.png') }}">
    <input type="hidden" name="stamp" value="{{ asset('path/to/your/stamp.png') }}">
    <input type="hidden" name="office_name" value="SECRETARIAT OF NORTH KAAPU">
    <input type="hidden" name="name" value="John Doe">
    <input type="hidden" name="id_card_number" value="A202020">
    <input type="hidden" name="body_text" value="For exceptional contributions...">
    <input type="hidden" name="date" value="{{ now()->format('Y-m-d') }}">
    <input type="hidden" name="signature" value="{{ asset('path/to/signature.png') }}">
    <input type="hidden" name="authorize_person" value="Sarah Johnson">
    <input type="hidden" name="designation" value="Chief Executive Officer">

    <button type="submit" class="btn btn-primary generate-certificate-btn">
        <i class="fas fa-certificate mr-2"></i> Generate Certificate
    </button>
</form>

<style>
    .generate-certificate-btn {
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #2b6cb0, #2c5282);
        border: none;
    }
    
    .generate-certificate-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(43, 108, 176, 0.3);
    }
</style>

@endsection