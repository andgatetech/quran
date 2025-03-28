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
            <div class="alert alert-danger alert-custom animate__animated animate__fadeInDown" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="manualForm" action="{{ route('questions.store') }}" method="POST" class="d-block">
            @csrf
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

            <!-- Additional Curriculum Dropdown -->
            <div class="form-group mb-3">
                <select class="form-control" id="curriculum_id" name="curriculum_id">
                    <option value="">Select Curriculum (Optional)</option>
                    @foreach($curriculums as $curriculum)
                        <option value="{{ $curriculum->id }}" {{ old('curriculum_id') == $curriculum->id ? 'selected' : '' }}>
                            {{ $curriculum->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" id="question_name" name="question_name" placeholder="Enter Question Name" required />
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
            
            {{-- <div class="form-group">
                <select class="form-control" id="book_number" name="book_number" required>
                    <option value="">Select Book Number</option>
                    <option value="1">آلم (Alif Lam Meem)</option>
                    <option value="2">سَيَقُولُ (Sayakool)</option>
                    <option value="3">تِلْكَ رُسُلُ (Tilka Rusulu)</option>
                    <option value="4">لَن تَنَالُوا (Lan Tana Loo)</option>
                    <option value="5">وَقَالَ الَّذِينَ (Wa Qala Al-Ladhina)</option>
                    <option value="6">يُؤْمِنُونَ بِمَا (Yu'minuna Bima)</option>
                    <option value="7">إِنَّا فَتَحْنَا لَكَ (Inna Fatahna Laka)</option>
                    <option value="8">قُلْ هُوَ اللَّذِي (Qul Huwa Al-Ladhi)</option>
                    <option value="9">لَا يَكُونُ (La Yakunu)</option>
                    <option value="10">فَذُوقُوا بِمَا (Fadhuku Bima)</option>
                    <option value="11">وَفِي رِسَالَتِهِ (Wa Fi Risalati)</option>
                    <option value="12">فَاعْتَبِرُوا يَا أُوْلِي (Fa'tabiru Ya Auli)</option>
                    <option value="13">أَصَابَتْهُمْ (Asabat-hum)</option>
                    <option value="14">وَإِنَّا فَتَحْنَا (Wa Inna Fatahna)</option>
                    <option value="15">تُدْنِي إِلَى (Tudni Ila)</option>
                    <option value="16">يَعْمَلُونَ مَعَكُمْ (Ya'maluna Ma'akum)</option>
                    <option value="17">وَلَا تَحْزَنُوا (Wa La Tahzanoo)</option>
                    <option value="18">إِنَّكُمْ أَفْضَلُ (Innakum Afzaloo)</option>
                    <option value="19">وَقَدْ تَجَدَّدَ (Wa Qad Tajaddada)</option>
                    <option value="20">وَفِي ذَارِهِمْ (Wa Fi Dharihim)</option>
                    <option value="21">إِذَا سَمِعُوا (Iza Sami'u)</option>
                    <option value="22">وَعِدْنَاهُمْ (Wa 'Idnahum)</option>
                    <option value="23">وَالَّذِينَ يَجْحَدُونَ (Waladhina Yajhaduna)</option>
                    <option value="24">وَقَالُوا لِمَن (Wa Qalu Liman)</option>
                    <option value="25">فِي كِتَابِهِمْ (Fi Kitabihim)</option>
                    <option value="26">مُدْنِيَنْ (Mudninan)</option>
                    <option value="27">الَّذِينَ يُؤْمِنُونَ (Alladhina Yu'minuna)</option>
                    <option value="28">وَمَنْ يُؤْمِنْ (Wa Man Yu'min)</option>
                    <option value="29">وَسَمِعَ قَوْمُ (Wa Sami'a Qawmu)</option>
                    <option value="30">أَمَّا يَتَسَاءَلُونَ (Amma Yatasa’aloon)</option>
                </select>
            </div> --}}




            <div class="form-group">
                <select class="form-control" id="book_number" name="book_number" required>
                    <option value="">Select Book Number</option>
                    @foreach(range(1, 30) as $bookNumber)
                        <option value="{{ $bookNumber }}">Juz {{ $bookNumber }}</option>
                    @endforeach
                </select>
            </div>

            <!-- From Ayat Number -->
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




            <div class="form-group">
                <input type="number" class="form-control" id="hardness" name="hardness" placeholder="Hardness of this Question %" min="0" max="100" required />
            </div>

            <button type="submit" class="btn btn-save">Save</button>
        </form>
        <script>
          document.addEventListener('DOMContentLoaded', function () {
    const bookNumberSelect = document.getElementById('book_number');
    const fromAyatSelect = document.getElementById('from_ayat_number');
    const toAyatSelect = document.getElementById('to_ayat_number');

    bookNumberSelect.addEventListener('change', async function () {
        const bookNumber = this.value;

        // Reset dropdowns
        fromAyatSelect.innerHTML = '<option value="">Select From Ayah</option>';
        toAyatSelect.innerHTML = '<option value="">Select To Ayah</option>';

        if (bookNumber) {
            try {
                const response = await fetch(`/api/get-ayahs/${bookNumber}`);
                const data = await response.json();

                if (data.success) {
                    const ayahs = data.ayahs;

                    ayahs.forEach(ayah => {
                        const option = `<option value="${ayah.ayah_no_juzz}">${ayah.ayah_no_juzz}</option>`;
                        fromAyatSelect.innerHTML += option;
                        toAyatSelect.innerHTML += option;
                    });
                } else {
                    alert(data.message || 'Unable to fetch Ayah data.');
                }
            } catch (error) {
                console.error('Error fetching Ayah data:', error);
            }
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const fromAyatSelect = document.getElementById('from_ayat_number');
    const toAyatSelect = document.getElementById('to_ayat_number');

    // Function to validate the Ayah range
    function validateAyahRange() {
        const fromAyah = parseInt(fromAyatSelect.value, 10);
        const toAyah = parseInt(toAyatSelect.value, 10);

        if (fromAyah && toAyah) {
            if (toAyah <= fromAyah) {
                alert('The "To Ayah" must be greater than the "From Ayah".');
                toAyatSelect.value = ''; // Reset the "To Ayah" dropdown
            }
        }
    }

    // Add event listeners to both dropdowns
    fromAyatSelect.addEventListener('change', validateAyahRange);
    toAyatSelect.addEventListener('change', validateAyahRange);
});

        </script>















        <hr>









        <h3 class="mt-5">Bulk Upload Questions</h3>

        <form id="bulkForm" action="{{ route('questions.bulkUpload') }}" method="POST" enctype="multipart/form-data" class="form-container mt-4">
            @csrf
            <div class="form-group mb-3">
                <input type="file" class="form-control" id="bulkFile" name="file" required />
            </div>
            <button type="submit" class="btn btn-save">Upload</button>
        </form>
</div>

<script>

</script>
@endsection
