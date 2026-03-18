<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessoryCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'thumbnail',
        'parent_id',
        'is_active',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function parent()
    {
        return $this->belongsTo(AccessoryCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(AccessoryCategory::class, 'parent_id');
    }

    public function accessories()
    {
        return $this->hasMany(Accessory::class, 'accessory_category_id');
    }
}

