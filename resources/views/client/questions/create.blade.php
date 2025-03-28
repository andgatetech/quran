@extends('layouts.app')
@section('content')
<header class="header">
    <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
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

    <form id="manualForm" action="{{ route('questions.bulkUpload') }}" method="POST">
        @csrf
        <!-- Competition, Age, Side, Read dropdowns -->

        <div class="form-group" style="margin-top:15px;">
            <input type="text" name="question_name" class="form-control" placeholder="Question Name" required>
        </div>

        <div class="form-group mb-3">
            <select class="form-control" id="competition_id" name="competition_id" required>
                <option value="">Select Competition Name</option>
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
        
        <!-- Option Dropdown -->
        <div class="form-group mb-3">
            <select class="form-control" onchange="javascript:showBookOrCurriculum();" id="option_id" name="option_name">
                <option value="">Select Option by (#Book or Curriculum)</option>
                
                <option value="Book">Book</option>
                <option value="Curriculum">Curriculum</option>
                
            </select>
        </div>


        <!-- Curriculum Dropdown -->
        <div class="form-group mb-3" style="display:none;" id="curriculum_part">
            <select class="form-control" onchange="javascript:fetchCurriculumAyat();" id="curriculum_id" name="curriculum_id">
                <option value="">Select Curriculum</option>
                @foreach($curriculums as $curriculum)
                    <option value="{{ $curriculum->id }}">{{ $curriculum->title }}</option>
                @endforeach
            </select>
        </div>

        <!-- Manual Fields -->
        <div id="manual-fields">
            <div class="form-group" style="display:none;" id="book_part">
                <select class="form-control" onchange="javascript:fetchBookAyat();" id="book_number" name="book_number">
                    <!-- Book options -->
                    <option value="">Select Juz (Book)</option>
                    @foreach(range(1, 30) as $bookNumber)
                        <option value="{{ $bookNumber }}">Juz {{ $bookNumber }}</option>
                    @endforeach
                </select>
            </div>
            <!-- From and To Ayat dropdowns -->

            <div class="form-group">
                <select class="form-control" id="from_ayat_number" name="from_ayat_number" required>
                    <option value="">Select From (Verse) Ayat number</option>
                </select>
            </div>

            <div class="form-group">
                <select class="form-control" id="to_ayat_number" name="to_ayat_number" >
                    <option value="">Select To (Verse) Ayat number</option>
                </select>
            </div>

            <div class="form-group">
                <input type="text" name="hardness" class="form-control" placeholder="Hardness of this Question %" required>
            </div>

        </div>

        <button type="submit" class="btn btn-save">Save</button>
    </form>

            <br />

            <form  enctype='multipart/form-data' action="{{ route('questions.bulkUpload') }}" method="POST">
               @csrf
                <td>Bulk Upload:</td>
                <td><input type='file' name='file'/></td>
                <td><input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit"/>
            </form>


</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

function showBookOrCurriculum(){
    var check_option=$('#option_id').val();
    if(check_option=="Book"){
        $('#book_part').show();
        $('#curriculum_part').hide();
    }else if(check_option=="Curriculum"){
        $('#curriculum_part').show();
        $('#book_part').hide();
    }else{
        $('#book_part').hide();
        $('#curriculum_part').hide();
    }
}


    var $j = jQuery.noConflict();

    function fetchBookAyat() {
        
        const book_number = $('#book_number').val();
        $('#from_ayat_number').html('');
        $('#to_ayat_number').html('');
        $j.ajax({
            url: '{{ route('ajax.bookAyat') }}',
             method: 'GET',
            data: {
                book_number: book_number
            },
            success: function(book_ayat) {
                var str='<option value="">Select From (Verse) Ayat number</option>';
                $.each(book_ayat, function(key,val) {
                    str +='<option value="'+val.ayah_no_juzz+'">'+val.ayah_no_juzz+'</option>';
                    //$('#from_ayat_number').append(str);
                    //$('#to_ayat_number').append(str);
                });
                
                $('#from_ayat_number').html(str);
                $('#to_ayat_number').html(str);

            },
            error: function(xhr, status, error) {
                console.error('Error fetching winners:', error);
                //$('#slider').html('<p>Error loading winners. Please try again later.</p>');
            }
        });
 }
 



function fetchCurriculumAyat() {
        
        const curriculum_id = $('#curriculum_id').val();
        $('#to_ayat_number').html('');
        $j.ajax({
            url: '{{ route('ajax.curriculumAyat') }}',
            method: 'GET',
            data: {
                curriculum_number:curriculum_id
            },
            success: function(book_ayat) {
                var str='<option value="">Select From (Verse) Ayat number</option>';
                $.each(book_ayat, function(key,val) {
                    str +='<option value="'+val.id+'">'+val.total_ayah+'</option>';
                    //$('#from_ayat_number').append(str);
                    //$('#to_ayat_number').append(str);
                });
                
                $('#from_ayat_number').html(str);
                //$('#to_ayat_number').html(str);

            },
            error: function(xhr, status, error) {
                console.error('Error fetching winners:', error);
                //$('#slider').html('<p>Error loading winners. Please try again later.</p>');
            }
        });
}

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
