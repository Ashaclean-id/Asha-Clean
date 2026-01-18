<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTool extends Model
{
    protected $table = 'service_tools';

    protected $fillable = [
        'service_page_id',
        'name',
        'description',
        'icon',
    ];

    public function service()
    {
        return $this->belongsTo(ServicePage::class, 'service_page_id');
    }
}
