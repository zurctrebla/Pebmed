<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['scheduling_id', 'note'];

    public function scheduling()
    {
        return $this->belongsTo(Scheduling::class);
    }
}
