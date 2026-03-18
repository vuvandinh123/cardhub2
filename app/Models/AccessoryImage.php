<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessoryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'accessory_id',
        'image_url',
        'is_primary',
        'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function accessory()
    {
        return $this->belongsTo(Accessory::class);
    }
}

