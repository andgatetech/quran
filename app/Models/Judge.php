<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Judge extends Authenticatable
{
    /**
     * The table associated with the model.
     */
    protected $table = 'judges';

    /**
     * The primary key type.
     */
    protected $keyType = 'int';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = true;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = ['id'];

    /**
     * Hidden attributes for arrays.
     */
    protected $hidden = ['password'];

    /**
     * Relationships
     */

    /**
     * Get the competition that the judge belongs to.
     */
}
