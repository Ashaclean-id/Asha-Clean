<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePage extends Model
{
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
