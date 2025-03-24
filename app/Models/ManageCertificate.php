<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageCertificate extends Model
{
    use HasFactory;

    protected $table = 'manage_certificates';

    protected $fillable = [
        'competition_id',
        'signature_count',
        'option',
        'template',
        'award_date',
        'authorize_person_1',
        'signature_1',
        'designation_1',
        'authorize_person_2',
        'signature_2',
        'designation_2',
        'office_logo',
        'office_stamp',
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    } 
}
