<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    protected $guarded = []; // Ensures no attributes are mass-assigned

    public $incrementing = true; // To auto-increment ID

    protected $table = 'hosts'; // Define the table name

    // You can add validation logic or other helper methods here
}
