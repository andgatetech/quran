<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'sponsors';

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = ['id'];

    /**
     * Get the competition associated with the sponsor.
     */
    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }
}
