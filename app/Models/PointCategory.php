<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointCategory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'total_points', 'deduction_amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

