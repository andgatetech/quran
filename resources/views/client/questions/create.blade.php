@extends('layouts.app')
@section('content')
<header class="header">
    <a class="back-btn" href="{{ route('client.menu') }}"><i class="fas fa-home"></i></a>
    <h1>Create Questions</h1>
  </header>

<div class="tabs">

<button class="tab-btn active"  onclick="window.location.href='{{ route('questions.create') }}'">Create Question</button>
<button class="tab-btn " onclick="window.location.href='{{ route('questions.list') }}'">Question List</button>
</div>


<div class="container">
    @if ($errors->any())
        <!-- Error messages -->
    @endif

    <form id="manualForm" action="{{ route('questions.store') }}" method="POST">
        @csrf
        <!-- Competition, Age, Side, Read dropdowns -->

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
                                    <option value="1">Default</option>


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


            </select>
        </div>
        
        <!-- Curriculum Dropdown -->
        <div class="form-group mb-3">
            <select class="form-control" id="curriculum_id" name="curriculum_id">
                <option value="">Select Curriculum (Optional)</option>
                @foreach($curriculums as $curriculum)
                    <option value="{{ $curriculum->id }}">{{ $curriculum->title }}</option>
                @endforeach
            </select>
        </div>

        <!-- Manual Fields -->
        <div id="manual-fields">
            <div class="form-group">
                <select class="form-control" id="book_number" name="book_number" required>
                    <!-- Book options -->
                    <option value="">Select Book Number</option>
                    @foreach(range(1, 30) as $bookNumber)
                        <option value="{{ $bookNumber }}">Juz {{ $bookNumber }}</option>
                    @endforeach
                </select>
            </div>
            <!-- From and To Ayat dropdowns -->

            <div class="form-group">
                <select class="form-control" id="from_ayat_number" name="from_ayat_number" required>
                    <option value="">Select From Ayah</option>
                </select>
            </div>

            <div class="form-group">
                <select class="form-control" id="to_ayat_number" name="to_ayat_number" required>
                    <option value="">Select To Ayah</option>
                </select>
            </div>

        </div>

        <button type="submit" class="btn btn-save">Save</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const competition = document.getElementById('competition_id');
    const age = document.getElementById('age_category_id');
    const side = document.getElementById('side_category_id');
    const read = document.getElementById('read_category_id');
    const curriculum = document.getElementById('curriculum_id');
    const manualFields = document.getElementById('manual-fields');

    function checkMatchingCurriculum() {
        const competitionId = competition.value;
        const ageId = age.value;
        const sideId = side.value;
        const readId = read.value;

        if (competitionId && ageId && sideId && readId) {
            fetch(`/check-curriculum?competition_id=${competitionId}&age_category_id=${ageId}&side_category_id=${sideId}&read_category_id=${readId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        curriculum.value = data.curriculum.id;
                        updateCurriculumFields(data.curriculum);
                    } else {
                        curriculum.value = '';
                        showManualFields();
                    }
                });
        } else {
            showManualFields();
        }
    }

    function updateCurriculumFields(curriculumData) {
        document.getElementById('book_number').value = curriculumData.book_number;
        document.getElementById('from_ayat_number').value = curriculumData.from_ayat_number;
        document.getElementById('to_ayat_number').value = curriculumData.to_ayat_number;
        manualFields.style.display = 'none';
    }

    function showManualFields() {
        manualFields.style.display = 'block';
        document.getElementById('book_number').value = '';
        document.getElementById('from_ayat_number').value = '';
        document.getElementById('to_ayat_number').value = '';
    }

    [competition, age, side, read].forEach(el => el.addEventListener('change', checkMatchingCurriculum));

    curriculum.addEventListener('change', function() {
        const curriculumId = this.value;
        if (curriculumId) {
            fetch(`/get-curriculum/${curriculumId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.curriculum) {
                        updateCurriculumFields(data.curriculum);
                    }
                });
        } else {
            showManualFields();
        }
    });
});
</script>


@endsection
