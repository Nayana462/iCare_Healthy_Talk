<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorCategories extends Model
{
    use HasFactory;
    protected $table = 'doctor_categories';
      protected $fillable = [
        'doctor_id',
        'cat_id',
    ];

     protected $dates = [
        'created_at',
        'updated_at',
    ];
}
