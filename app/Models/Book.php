<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_isbn',
        'book_name',
        'book_author',
        'book_price',
        'book_publication',
        'book_condition',
        'book_quantity',
        'category_id',
        'subcategory_id',
        'subsubcategory_id',
        'book_pic',
        'owner_email',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function subsubcategory()
    {
        return $this->belongsTo(Subsubcategory::class);
    }

    // Owner relationship (based on email)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_email', 'email');
    }
}
