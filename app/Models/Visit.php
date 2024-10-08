<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'phone', 'entry_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
