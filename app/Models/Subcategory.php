<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'subcategory_name',
        'category_id',
        'admin_id', // Add admin_id here
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->subcategory_name = strtolower($model->subcategory_name);
        });

        static::updating(function ($model) {
            $model->subcategory_name = strtolower($model->subcategory_name);
        });
    }

    public function subsubcategories()
    {
        return $this->hasMany(Subsubcategory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
