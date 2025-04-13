<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'report_type',
        'competition_id',
        'age_category_id',
        'side_category_id', 
        'read_category_id',
        'anouncement_date',
        'date_of_close',
        'status',
        'path', 
        'date_of_report',
        'user_id'
    ];

    public function competition(){
        return $this->belongsTo(Competition::class, 'competition_id');
    }
    public function ageCategory(){
        return $this->belongsTo(AgeCategory::class, 'age_category_id');
    }
    public function sideCategory(){
        return $this->belongsTo(SideCategory::class, 'side_category_id');
    }
    public function readCategory(){
        return $this->belongsTo(ReadCategory::class, 'read_category_id');
    }
}
