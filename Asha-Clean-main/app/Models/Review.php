<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relasi ke Layanan (agar kita tahu dia mereview layanan apa)
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}