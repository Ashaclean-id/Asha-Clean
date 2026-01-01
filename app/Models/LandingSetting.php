<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingSetting extends Model
{
    use HasFactory;

    // INI KUNCINYA MIN! 
    // Kalau ini tidak ada, kolom baru (whatsapp_number) tidak akan bisa disimpan.
    protected $guarded = []; 
}