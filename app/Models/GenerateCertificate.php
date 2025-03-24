<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GenerateCertificate extends Model
{
    use HasFactory;
    protected $table = 'generate_certificate';

    protected $fillable = [
        'competition_name',
        'sponsor_name',
        'id_card_number',
        'certificate_type',
        'body_content',
        'status',
        'pdf',
        'competitor_id',
    ];

    // Relationship with Competitor
    public function competitor()
    {
        return $this->belongsTo(Competitor::class);
    }
}
