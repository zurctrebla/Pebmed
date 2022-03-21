<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduling extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'scheduling'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
