<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accessory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'accessory_category_id',
        'car_id',
        'sku',
        'price',
        'quantity',
        'is_active',
        'thumbnail',
        'description',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(AccessoryCategory::class, 'accessory_category_id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function images()
    {
        return $this->hasMany(AccessoryImage::class)->orderBy('sort_order');
    }

    public function primaryImage()
    {
        return $this->hasOne(AccessoryImage::class)->where('is_primary', true);
    }
}

