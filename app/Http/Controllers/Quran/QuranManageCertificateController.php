<?php

namespace App\Http\Controllers\Quran;

use App\Models\AgeCategory;
use App\Models\CertificateTemplate;
use App\Models\Competition;
use App\Models\CompetitionType;
use App\Models\ReadCategory;
use App\Models\SideCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ManageCertificate;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Competitor;
use App\Models\GenerateCertificate;


class QuranManageCertificateController extends Controller
{
    private $module = "Quran";
    private $competitionType;

    public function __construct(){
        // find competition type;
        $this->competitionType = CompetitionType::where('name', 'Quran')->first();
    }

    public function create(){
        $competitions = Competition::where('user_id', Auth::guard('client')->id())->where('competition_type_id', $this->competitionType->id)->get();
        $certificateTemplates = CertificateTemplate::get();
        return view("client.managenertificate.create", compact("competitions", 'certificateTemplates'));
    }

    public function certificate_generate(Request $request)
    {
        $validated = $request->validate([
            'serial_number' => 'required|string',
            'logo' => 'required|url',
            'stamp' => 'required|url',
            'office_name' => 'required|string',
            'name' => 'required|string',
            'id_card_number' => 'required|string',
            'body_text' => 'required|string',
            'date' => 'required|date',
            'signature' => 'required|url',
            'authorize_person' => 'required|string',
            'designation' => 'required|string',
        ]);

        $pdf = PDF::loadView('client.managenertificate.template', $validated)
                  ->setPaper('a4', 'landscape');

        return $pdf->download('certificate.pdf');
    }

    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'competition_id'      => 'required|exists:competitions,id',
        'signature_count'     => 'required|integer',
        'option'              => 'required|integer',
        'template'            => 'required|integer',
        'award_date'          => 'required|date',
        'authorize_person_1'  => 'required|string|max:255',
        'signature_1'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'designation_1'       => 'required|string|max:255',
        'authorize_person_2'  => 'nullable|string|max:255',
        'signature_2'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'designation_2'       => 'nullable|string|max:255',
        'office_logo'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'office_stamp'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Upload Images
    $signature1Path = $request->file('signature_1')->store('uploads', 'public');
    $signature2Path = $request->hasFile('signature_2') ? $request->file('signature_2')->store('uploads', 'public') : null;
    $officeLogoPath = $request->file('office_logo')->store('uploads', 'public');
    $officeStampPath = $request->file('office_stamp')->store('uploads', 'public');

    // Save Data
    ManageCertificate::create([
        'competition_id'      => $request->competition_id,
        'signature_count'     => $request->signature_count,
        'option'              => $request->option,
        'template'            => $request->template,
        'award_date'          => $request->award_date,
        'authorize_person_1'  => $request->authorize_person_1,
        'signature_1'         => $signature1Path,
        'designation_1'       => $request->designation_1,
        'authorize_person_2'  => $request->authorize_person_2,
        'signature_2'         => $signature2Path,
        'designation_2'       => $request->designation_2,
        'office_logo'         => $officeLogoPath,
        'office_stamp'        => $officeStampPath,
    ]);

    return redirect()->back()->with('success', 'Certificate created successfully.');
}

public function index(Request $request)
{
    // $competitions = Competition::where('user_id', Auth::guard('client')->id())->get();
    $competitions = Competition::where('user_id', Auth::guard('client')->id())->where('competition_type_id', $this->competitionType->id)->get();

    $search_competition_id = isset($request->competition_id) ? $request->competition_id : null;


if($search_competition_id !== null){
        // Fetch all certificates for the authenticated user
        $certificates = ManageCertificate::with('competition')
        ->whereHas('competition', function ($query) use ($search_competition_id){
            $query->where('user_id', Auth::guard('client')->id())->where('id', $search_competition_id);
        })
        ->get();

}else{
    // Fetch all certificates for the authenticated user
    $certificates = ManageCertificate::with('competition')
        ->whereHas('competition', function ($query) {
            $query->where('user_id', Auth::guard('client')->id());
        })
        ->get();
}

   
    return view('client.managenertificate.list', compact('certificates', 'competitions', 'search_competition_id'));
}

public function destroy($id)
{
    // Find the certificate by ID
    $certificate = ManageCertificate::find($id);

    // Check if the certificate exists
    if (!$certificate) {
        return redirect()->back()->with('error', 'Certificate not found.');
    }

    // Delete associated files from storage
    Storage::disk('public')->delete([
        $certificate->signature_1,
        $certificate->signature_2,
        $certificate->office_logo,
        $certificate->office_stamp,
    ]);

    // Delete the certificate from the database
    $certificate->delete();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Certificate deleted successfully.');
}

public function update(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'competition_id'      => 'required|exists:competitions,id',
        'signature_count'     => 'required|integer',
        'option'              => 'required|integer',
        'template'            => 'required|integer',
        'award_date'          => 'required|date',
        'authorize_person_1'  => 'nullable|string|max:255',
        'signature_1'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'designation_1'       => 'nullable|string|max:255',
        'authorize_person_2'  => 'nullable|string|max:255',
        'signature_2'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'designation_2'       => 'nullable|string|max:255',
        'office_logo'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'office_stamp'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Find the certificate by ID
    $certificate = ManageCertificate::find($id);

    // Check if the certificate exists
    if (!$certificate) {
        return redirect()->back()->with('error', 'Certificate not found.');
    }

    // Update the certificate data
    $certificate->update([
        'competition_id'      => $request->competition_id,
        'signature_count'     => $request->signature_count,
        'option'              => $request->option,
        'template'            => $request->template,
        'award_date'          => $request->award_date,
        'authorize_person_1'  => $request->authorize_person_1,
        'designation_1'       => $request->designation_1,
        'authorize_person_2'  => $request->authorize_person_2,
        'designation_2'       => $request->designation_2,
    ]);

    // Update files if new ones are uploaded
    if ($request->hasFile('signature_1')) {
        Storage::disk('public')->delete($certificate->signature_1);
        $certificate->signature_1 = $request->file('signature_1')->store('uploads', 'public');
    }
    if ($request->hasFile('signature_2')) {
        Storage::disk('public')->delete($certificate->signature_2);
        $certificate->signature_2 = $request->file('signature_2')->store('uploads', 'public');
    }
    if ($request->hasFile('office_logo')) {
        Storage::disk('public')->delete($certificate->office_logo);
        $certificate->office_logo = $request->file('office_logo')->store('uploads', 'public');
    }
    if ($request->hasFile('office_stamp')) {
        Storage::disk('public')->delete($certificate->office_stamp);
        $certificate->office_stamp = $request->file('office_stamp')->store('uploads', 'public');
    }

    // Save the updated certificate
    $certificate->save();

    // Redirect back with a success message
    return redirect()->route('managenertificate.index')->with('success', 'Certificate updated successfully.');
}

public function edit($id)
{
    // Find the certificate by ID
    $certificate = ManageCertificate::find($id);

    // Check if the certificate exists
    if (!$certificate) {
        return redirect()->back()->with('error', 'Certificate not found.');
    }

    // Fetch competitions for the dropdown
    $competitions = Competition::where('user_id', Auth::guard('client')->id())->where('competition_type_id', $this->competitionType->id)->get();

    // Return the edit view with the certificate and competitions data
    return view('client.managenertificate.edit', compact('certificate', 'competitions'));
}

    public function generateView(Request $request)
    {

        //$competitions = Competition::where('user_id', Auth::guard('client')->id())->get(); // Fetch competitions
        $competitions = Competition::where('user_id', Auth::guard('client')->id())->where('competition_type_id', $this->competitionType->id)->get();
        $competitors = Competitor::with(['competition', 'sideCategory', 'readCategory', 'ageCategory'])
            // ->whereHas('competition', function ($query) {
            //     $query->where('user_id', Auth::guard('client')->id());
            // })
            ->when(request('competition_filter'), function ($query, $competitionFilter) {
                return $query->whereHas('competition', function ($q) use ($competitionFilter) {
                    $q->where('id', $competitionFilter);
                });
            })
            ->when(request('age_category_filter'), function ($query, $ageCategoryFilter) {
                return $query->where('age_category_id', $ageCategoryFilter);
            })
            ->when(request('side_category_filter'), function ($query, $sideCategoryFilter) {
                return $query->where('side_category_id', $sideCategoryFilter);
            })
            ->when(request('read_category_filter'), function ($query, $readCategoryFilter) {
                return $query->where('read_category_id', $readCategoryFilter);
            })
            ->get();


            


        $manageCertificates = ManageCertificate::all();

        // $sideCategories = SideCategory::where('user_id', Auth::guard('client')->id())->get();
        // $readCategories = ReadCategory::where('user_id', Auth::guard('client')->id())->get();
        // $ageCategories = AgeCategory::where('user_id', Auth::guard('client')->id())->get();

        $sideCategories = SideCategory::get();
        $readCategories = ReadCategory::get();
        $ageCategories = AgeCategory::get();


        return view('client.managenertificate.generateview', compact(
            'competitions',
            'sideCategories',
            'readCategories',
            'ageCategories',
            'competitors',
            'manageCertificates'
        ));
    }

public function generatedList(){
   //$competitions = Competition::where('user_id', Auth::guard('client')->id())->get(); // Fetch competitions
   $competitions = Competition::where('user_id', Auth::guard('client')->id())->where('competition_type_id', $this->competitionType->id)->get();
   $competitors = Competitor::with(['competition', 'sideCategory', 'readCategory', 'ageCategory'])
       // ->whereHas('competition', function ($query) {
       //     $query->where('user_id', Auth::guard('client')->id());
       // })
       ->when(request('competition_filter'), function ($query, $competitionFilter) {
           return $query->whereHas('competition', function ($q) use ($competitionFilter) {
               $q->where('id', $competitionFilter);
           });
       })
       ->when(request('age_category_filter'), function ($query, $ageCategoryFilter) {
           return $query->where('age_category_id', $ageCategoryFilter);
       })
       ->when(request('side_category_filter'), function ($query, $sideCategoryFilter) {
           return $query->where('side_category_id', $sideCategoryFilter);
       })
       ->when(request('read_category_filter'), function ($query, $readCategoryFilter) {
           return $query->where('read_category_id', $readCategoryFilter);
       })
       ->get();


   $generatedCertificates = GenerateCertificate::all();

   // $sideCategories = SideCategory::where('user_id', Auth::guard('client')->id())->get();
   // $readCategories = ReadCategory::where('user_id', Auth::guard('client')->id())->get();
   // $ageCategories = AgeCategory::where('user_id', Auth::guard('client')->id())->get();

   $sideCategories = SideCategory::get();
   $readCategories = ReadCategory::get();
   $ageCategories = AgeCategory::get();


   return view('client.managenertificate.generatedList', compact(
       'competitions',
       'sideCategories',
       'readCategories',
       'ageCategories',
       'competitors',
       'generatedCertificates'
   ));
}    

public function generatePDF(Request $request)
{
    // dd($request);

    // Validate the request
    $request->validate([
        'competitor_id' => 'required|exists:competitors,id',
        // 'certificate_type' => 'required|string',
        'body_content' => 'required|string',
        'certificate_settings' => 'required|exists:manage_certificates,id', // Validate settings ID
    ]);

    // Fetch competitor details
    $competitor = Competitor::findOrFail($request->competitor_id);

    $settings = null;
    if ($request->certificate_settings) {
        $settings = ManageCertificate::find($request->certificate_settings);
    }

    // Static data (can be moved to config or database)
    $logoUrl = Storage::url('uploads/logo.png'); // Static logo
    $stampUrl = Storage::url('uploads/stamp.png'); // Static stamp
    $signatureUrl = Storage::url('uploads/signature.png'); // Static signature
    $authorizePerson = 'IBRAHIM HUSSAIN HASSAN'; // Static
    $designation = 'PRINCIPAL'; // Static

    // Prepare data for the view
    $data = [
        'serial_number' => 'SN-' . uniqid(), // Generate a unique serial number
        'logo' => $settings->office_logo ?? 'N/A', // Institute name
        'stamp' => $settings ? $settings->office_stamp : asset('defaults/stamp.png'), // Use settings stamp or default
        'office_name' => $competitor->school_name ?? 'N/A', // Institute name
        'name' => $competitor->full_name,
        'id_card_number' => $competitor->id_card_number,
        'center' => 'Dhaka',
        'body_text' => $request->body_content,
        'date' => now()->format('d F Y'), // Current date
        'signature' => $settings ? $settings->signature_1 : asset('defaults/signature.png'), // Use settings signature or default
        'authorize_person' => $settings->authorize_person_1 ?? 'IBRAHIM HUSSAIN HASSAN', // Use settings or default
        'designation' => $settings->designation_1 ?? 'PRINCIPAL', // Use settings or default
        'signature2' => $settings ? $settings->signature_2: asset('defaults/signature.png'), // Use settings signature or default
        'authorize_person2' => $settings->authorize_person_2 ?? 'IBRAHIM HUSSAIN HASSAN', // Use settings or default
        'designation2' => $settings->designation_2 ?? 'PRINCIPAL', // Use settings or default
    ];


    // Generate the PDF
    $pdf = Pdf::loadView('client.managenertificate.certificateTemplate', $data)
              ->setPaper('a4', 'landscape');

    // Save the PDF to storage
    $pdfPath = 'certificates/' . uniqid() . '.pdf';
    Storage::put($pdfPath, $pdf->output());

    // Store certificate details in the database
    GenerateCertificate::create([
        'competition_name' => $competitor->competition->main_name ?? null,
        'sponsor_name' => null, // Add sponsor name if available
        'id_card_number' => $competitor->id_card_number,
        'certificate_type' => $request->certificate_type,
        'body_content' => $request->body_content,
        'status' => 'generated',
        'pdf' => $pdfPath,
        'competitor_id' => $competitor->id,
    ]);

    // Stream the PDF to the browser
    return $pdf->stream();
}


}