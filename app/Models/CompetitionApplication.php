<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionApplication extends Model
{
    protected $fillable =[
        'competition_id',
            'name',
            'name_dhivehi',
            'id_card',
            'permanent_address',
            'current_address',
            'city',
            'dob',
            'age',
            'organization',
            'parent_name',
            'number',
            'age_category',
            'side_category',
            'read_category',
            'photo',
            'id_card_photo',
            'status',
    ];
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
    public function ageCategory()
    {
        return $this->belongsTo(AgeCategory::class,'age_category','id');
    }


    public function sideCategory()
    {
        return $this->belongsTo(SideCategory::class,'side_category','id');
    }
    public function readCategory()
    {
        return $this->belongsTo(ReadCategory::class,'read_category','id');
    }
}
