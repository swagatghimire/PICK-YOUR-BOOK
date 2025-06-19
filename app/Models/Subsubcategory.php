<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsubcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'subsubcategory_name',
        'subcategory_id',
        'admin_id', // Add admin_id here
    ];

    public function setSubsubcategoryNameAttribute($value)
    {
        $this->attributes['subsubcategory_name'] = strtolower($value);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
