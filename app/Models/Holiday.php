<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = ['name', 'date'];

        // If you want to ensure the date is always cast to a Carbon instance
        protected $casts = [
            'date' => 'date',
        ];

}
