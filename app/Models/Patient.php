<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'phone', 'email', 'dob', 'gender', 'height', 'weight'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
