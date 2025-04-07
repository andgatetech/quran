<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    // Optional: define table name if it's not plural of the model name
    // protected $table = 'documents';

    // Optional: if you want to disable timestamps
    // public $timestamps = false;

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'name',
        'office_name',
        'subscription_type',
        'from_date',
        'to_date',
    ];
}
