<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServicePage extends Model
{
    use HasFactory;

    protected $guarded = []; // Agar semua kolom bisa diisi
    public function prices()
    {
        return $this->hasMany(ServicePrice::class);
    }

    protected $table = 'service_pages';

    protected $fillable = [
        'slug',
        'title',
        'description',
        'image',
    ];

    public function tools()
    {
        return $this->hasMany(ServiceTool::class, 'service_page_id');
    }
}
